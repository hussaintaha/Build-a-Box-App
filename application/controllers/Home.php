<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: https://testmayookh.myshopify.com');
header('Access-Control-Allow-Methods: GET, POST');
class Home extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Global_model');
    $this->load->library('form_validation');
  }

  public function Shopjson($shop) {
    $shopAccess=getShop_accessToken_byShop($shop);
    $this->load->library('Shopify', $shopAccess);
    return $this->shopify->call(['METHOD' => 'GET', 'URL' =>'/admin/shop.json']);
  }

  public function ReturnBasicData($shop,$pageName) {
    $data =array();
    $data['shop']    = $shop;
    $data['PageName']    = $pageName;
    $data['shop_id'] = shop_id($shop);
    $data['ShopJson'] = $this->Shopjson($shop);
    return $data;
  }

  public function LoadEditPage() {
    if (!empty($_GET['shop'])){
      $data = $this->ReturnBasicData($_GET['shop'],'Edit Box Details');
      $data['bx_data'] = $this->db->select('*')->from('tbl_box')->where(['id'=>$_GET['bx_id']])->get()->row();
      $data['bx_data']->box_products = $this->db->select('*')->from('box_products')->where(['bx_id'=>$_GET['bx_id']])->get()->result();
      $this->load->load_admin('templates/edit_bx', $data);
    } else {
      $this->load->view('errors/shop-errors/shop-not-found');
    }
  }

  public function LoadEditCard() {
    if (!empty($_GET['shop'])){
      $data = $this->ReturnBasicData($_GET['shop'],'Edit Card Details');
      $data['card_Data'] = $this->db->select('*')->from('tbl_card')->where(['id'=>$_GET['card_id']])->get()->row();
      $this->load->load_admin('templates/edit_card', $data);
    } else {
      $this->load->view('errors/shop-errors/shop-not-found');
    }
  }

  public function check_webhook($shop, $mode)
  {
      $shop_id = getShopIdby_shop($shop);
      $chk     = $this->db->select('*')->where(['shop_id' => $shop_id, 'mode' => $mode])->get('stripe_webhook_endpoints')->row();
      if ($chk) {
          return false;
      } else {
          return true;
      }
  }

  public function CreateStripeWebhook($shop)
  {
      if (stripeKey($shop)) {
          $check_webhook = $this->check_webhook($shop, mode($shop));
          if ($check_webhook) {
              \Stripe\Stripe::setApiKey(stripeKey($shop));
              try {
                  $webhook = \Stripe\WebhookEndpoint::create([
                      "url"            => base_url()."CreateShopifyOrder?shop=".$shop,
                      "enabled_events" => ["invoice.payment_succeeded"],
                  ]);
                  $create = $this->Global_model->update_webhook($shop, mode($shop), $webhook->secret);
              } catch (Stripe_InvalidRequestError $e) {
                  $error = $e->getMessage();
              }
          }
      }
  }


  public function CreateShopifyWebhooks($shop)
  {
    $shop_id = shop_id($shop);
    $shopAccess=getShop_accessToken_byShop($shop);
    $this->load->library('Shopify', $shopAccess);
    $events = ['products/update'=>base_url()."product_update",'products/delete'=>base_url()."product_delete"];
     foreach ($events as $key => $event) {
       $where = ['event'=> $key,'shop_id'=>$shop_id];
       $isadded = $this->db->where($where)->count_all_results('webhooks');
         if($isadded == 0){
           $CreateArray = ["webhook"=> ["topic"=> $key,"address"=> $event,"format"=> "json"]];
           $webhook = $this->shopify->call(['METHOD' => 'POST', 'URL' =>'/admin/webhooks.json','DATA'=>$CreateArray]);
           $wb = $webhook->webhook;
           $insertArray = ['event'=>$key,'webhook_id'=>$wb->id,'shop_id'=>$shop_id];
           $this->db->insert('webhooks',$insertArray);
         }
     }
  }


  public function Dashboard() {
    if (!empty($_GET['shop'])) {
      $shop =  $_GET['shop'];
      $this->CreateShopifyWebhooks($shop);
      $this->CreateStripeWebhook($shop);
      $data = $this->ReturnBasicData($_GET['shop'],'Dashboard');
      $this->load->load_admin('templates/dashboard', $data);
    } else {
      $this->load->view('errors/shop-errors/shop-not-found');
    }
  }

  public function LoadSubscriptionHomePage($value='')
  {
    if (!empty($_GET['shop'])) {
      $data = $this->ReturnBasicData($_GET['shop'],'Integrations');
      $this->load->load_admin('templates/subscriptions_view', $data);
    } else {
      $this->load->view('errors/shop-errors/shop-not-found');
    }
  }

  public function LoadHelpPage($value='')
  {
    if (!empty($_GET['shop'])) {
      $data = $this->ReturnBasicData($_GET['shop'],'Instructions');
      $this->load->load_admin('templates/help_view', $data);
    } else {
      $this->load->view('errors/shop-errors/shop-not-found');
    }
  }

  public function SaveCheckout()
  {
    $chkId = 0;
    if($_POST['action'] == 'enable'){
      $chkId = $_POST['status'];
    }
    $update = $this->db->where(['shop_id'=>$_GET['shop_id']])->update('tbl_active_checkout',['current_checkout'=>$chkId]);
    if ($update) {
      $return = ['code'=>200,"msg"=>"Enabled Successfully"];
    } else {
      $return = ['code'=>200,"msg"=>"Something Went Wrong please Try After Sometime"];
    }
    echo json_encode($return);
  }

  public function SaveStripeKeys()
  {
    $save = $_POST;
    $save['mode'] = 1;
    $save['shop_id'] = $_GET['shop_id'];
    $save['provider'] = 'stripe';
    $OldBxStatus = $this->db->select('*')->from('stripe_key')->where(['shop_id'=>$_GET['shop_id']])->get()->row();
    if($OldBxStatus){
      $insert = $this->db->where(['shop_id'=>$_GET['shop_id']])->update('stripe_key', $save);
    }else{
      $insert = $this->Global_model->insertData('stripe_key',$save);
    }
    if ($insert) {
      $return = ['code'=>200,"msg"=>"Saved Successfully"];
    } else {
      $return = ['code'=>200,"msg"=>"Something Went Wrong please Try After Sometime"];
    }
    echo json_encode($return);
  }
  public function SaveRechargeToken()
  {
    $save = $_POST;
    $save['shop_id'] = $_GET['shop_id'];
    $OldBxStatus = $this->db->select('*')->from('recharge_api_keys')->where(['shop_id'=>$_GET['shop_id']])->get()->row();
    if($OldBxStatus){
      $insert = $this->db->where(['shop_id'=>$_GET['shop_id']])->update('recharge_api_keys', $save);
    }else{
      $insert = $this->Global_model->insertData('recharge_api_keys',$save);
    }
    if ($insert) {
      $return = ['code'=>200,"msg"=>"Recharge Token Saved"];
    } else {
      $return = ['code'=>200,"msg"=>"Something Went Wrong please Try After Sometime"];
    }
    echo json_encode($return);
  }
  public function LoadCreateBoxPage() {
    if (!empty($_GET['shop'])) {
      $data = $this->ReturnBasicData($_GET['shop'],'Create Box');
      $this->load->load_admin('templates/create_box', $data);
    } else {
      $this->load->view('errors/shop-errors/shop-not-found');
    }
  }

  public function LoadBoxView() {
    if (!empty($_GET['shop'])) {
      $data = $this->ReturnBasicData($_GET['shop'],'View Sample Boxes');
      $data['Boxes'] = $this->Global_model->GetBoxList(shop_id($_GET['shop']),'tbl_box');
      $this->load->load_admin('templates/box_view', $data);
    } else {
      $this->load->view('errors/shop-errors/shop-not-found');
    }
  }

  public function LoadCreateCardView() {
    if (!empty($_GET['shop'])) {
      $data = $this->ReturnBasicData($_GET['shop'],'Create Card');
      $this->load->load_admin('templates/create_card', $data);
    } else {
      $this->load->view('errors/shop-errors/shop-not-found');
    }
  }

  public function LoadCretedCardList() {
    if (!empty($_GET['shop'])) {
      $data = $this->ReturnBasicData($_GET['shop'],'View Created Cards');
      $data['Cards'] = $this->Global_model->GetBoxList(shop_id($_GET['shop']),'tbl_card');
      $this->load->load_admin('templates/view_cards', $data);
    } else {
      $this->load->view('errors/shop-errors/shop-not-found');
    }
  }

  public function UploadFiles() {
    $fileName = ((array_keys($_FILES)[0] == 'before_image') ? 'before_image' : 'after_image');
    $config['upload_path'] = 'assets/images';
    $config['allowed_types'] = 'jpeg|jpg|png';
    $imgExt = explode('.',$_FILES[$fileName]['name'])[1];
    $imageName = round(microtime(true) * 1000).'.'.$imgExt;
    $config['file_name'] = $imageName;
    $this->load->library('upload');
    $this->upload->initialize($config);
    $return =array();
    if($this->upload->do_upload($fileName)) {
      $uploadData = $this->upload->data();
      $before_image = base_url()."assets/images/".$uploadData['file_name'];
      $return=['key'=>$fileName,'src'=>$before_image];
    }
    echo json_encode($return);
  }

  public function DeleteProductFromShopify($table, $id, $shop) {
    $oldProductID = $this->db->select('shopify_product_id')->from($table)->where(['id'=>$id])->get()->row()->shopify_product_id;
    $shopAccess=getShop_accessToken_byShop($shop);
    $this->load->library('Shopify', $shopAccess);
    $delete = $this->shopify->call(['METHOD' => 'DELETE', 'URL' =>'/admin/products/'.$oldProductID.'.json']);
  }

  public function SaveBoxContentProducts($SelectedProducts,$shop,$bxid) {
    $shopAccess=getShop_accessToken_byShop($shop);
    $this->load->library('Shopify', $shopAccess);
    foreach ($SelectedProducts as $selbxp) {
      $ProductData = $this->shopify->call(['METHOD' => 'GET', 'URL' =>'/admin/products/'.$selbxp.'.json']);
      $saveArray[]=[
        'shopify_product_id'=>$ProductData->product->id,
        'product_json'=>json_encode($ProductData->product),
        'bx_id'=>$bxid
      ];
    }
    $this->db->insert_batch('box_products', $saveArray);
  }

  public function SaveBoxes() {
    $shop = $_GET['shop'];
    $shopAccess=getShop_accessToken_byShop($shop);
    $this->load->library('Shopify', $shopAccess);
    $after_image = ((!empty($_POST['after_image'])) ? $_POST['after_image'] : "" );
    $before_image = ((!empty($_POST['before_image'])) ? $_POST['before_image'] : "" );

    if(isset($_POST['bx_id'])) {
      $OldBxStatus = $this->db->select('status')->from('tbl_box')->where(['id'=>$_POST['bx_id']])->get()->row()->status;
      $this->db->where_in('bx_id', $_POST['bx_id'])->delete('box_products');
      $this->DeleteProductFromShopify('tbl_box', $_POST['bx_id'], $shop);
    }

    $createProduct = [
      "product"=> [
        "title"=> $_POST['bx_title'],
        "vendor" => $this->Shopjson($shop)->shop->name,
        "product_type"=> "HIDDEN_BOX_PRODUCT",
      ]
    ];
    $images = array();
    if(!empty($before_image)) {
      $createProduct["product"]["images"][]=['src'=>$before_image];
    }
    if(!empty($after_image)) {
      $createProduct["product"]["images"][]=['src'=>$after_image];
    }
    if(isset($_POST['Boxcolors']) && count($_POST['Boxcolors']) > 0) {
      $variants=array();
      $createProduct["product"]["options"] = [[ "name"=> "Color","values"=>$_POST['Boxcolors']]];
      foreach ($_POST['Boxcolors'] as $key => $color) {
        $createProduct["product"]["variants"][] = ['option1'=>$color];
      }
    }
    $product = $this->shopify->call(['METHOD' => 'POST', 'URL' =>'/admin/products.json','DATA'=>$createProduct]);
    $ShopifyProduct = $product->product;
    $variants=array();
    foreach ($ShopifyProduct->variants as $variant) {
      $variants[] = $variant->id;
      $update = ["variant" => ["id" => $variant->id,"inventory_policy"=>"continue","sku"=>"BXP11","price" => (($_POST['inc_box_price'] == 'yes') ? $_POST['bx_price'] : 0)]];
      $this->shopify->call(['METHOD' => 'PUT', 'URL' =>'/admin/variants/'.$variant->id.'.json','DATA'=>$update]);
    }

    $saveArray = [
      'bx_title'=>$_POST['bx_title'],
      'shopify_product_id'=>$ShopifyProduct->id,
      'shopify_variant_ids'=>implode(',',$variants),
      'bx_include_price'=> $_POST['inc_box_price'],
      'bx_price'=> (($_POST['inc_box_price'] == 'yes') ? $_POST['bx_price'] : 0),
      'bx_after_image'=> $after_image,
      'bx_before_image'=> $before_image,
      'bx_contents_based_on_product'=>((isset($_POST['productCount'])) ? 1 : 0),
      'bx_contents_based_on_bx_amt'=>((isset($_POST['BoxPrice'])) ? 1 : 0),
      'bx_max_no_products'=> ((isset($_POST['max_product'])) ? $_POST['max_product'] : 0),
      'bx_max_amt'=> ((isset($_POST['max_price'])) ? $_POST['max_price'] : 0),
      'gift_selection_basis' => $_POST['product_select'],
      'shop_id'=> $_GET['shop_id'],
      'shopify_product_handle'=> $ShopifyProduct->handle,
      'product_json'=> json_encode($product->product),
    ];

    if(isset($_POST['Boxcolors']) && count($_POST['Boxcolors']) > 0) {
      $saveArray['bx_colors'] = implode(',',$_POST['Boxcolors']);
    }

    if($_POST['product_select'] == 'collection') {
      $saveArray['select_collection'] = $_POST['collection_handle'];
      $saveArray['collection_data'] = $_POST['collection_data'];
    }

    if($_POST['product_select'] == 'tag') {
      $saveArray['select_tags'] = implode(',',$_POST['tags']);
    }

    if(isset($_POST['bx_id'])) {
      $saveArray['status'] = $OldBxStatus;
      $insert = $this->db->where(['id'=>$_POST['bx_id']])->update('tbl_box', $saveArray);
      if($_POST['product_select'] == 'product') {
        $this->SaveBoxContentProducts($_POST['bx_gift_products'],$shop,$_POST['bx_id']);
      }
    } else {
      $insert = $this->Global_model->insertData('tbl_box',$saveArray);
      if($_POST['product_select'] == 'product') {
        $this->SaveBoxContentProducts($_POST['bx_gift_products'],$shop,$insert);
      }
    }
    if ($insert) {
      $msg = "Box Created Successfully";
      if(isset($OldBxStatus)) {
        $msg = "BoX Details Updated SSuccessfully";
      }
      $return = ['code'=>200,"msg"=>$msg];
    } else {
      $return = ['code'=>200,"msg"=>"Something went Wrong please Try After Sometime"];
    }
    echo json_encode($return);
  }

  public function SaveCreatedCard() {
    $after_image = ((!empty($_POST['after_image'])) ? $_POST['after_image'] : "" );
    $before_image = ((!empty($_POST['before_image'])) ? $_POST['before_image'] : "" );
    $shop   = $_GET['shop'];
    if(isset($_POST['bx_id'])) {
      $OldBxStatus = $this->db->select('status')->from('tbl_card')->where(['id'=>$_POST['bx_id']])->get()->row()->status;
      $this->DeleteProductFromShopify('tbl_card',$_POST['bx_id'],$shop);
    }
    $shopAccess=getShop_accessToken_byShop($shop);
    $this->load->library('Shopify', $shopAccess);
    $createProduct = [
      "product"=> [
        "title"=> $_POST['bx_title'],
        "vendor" => $this->Shopjson($shop)->shop->name,
        "product_type"=> "HIDDEN_BOX_PRODUCT",
      ]
    ];

    if(!empty($before_image)) {
      $createProduct["product"]["images"][]=['src'=>$before_image];
    }

    if(!empty($after_image)) {
      $createProduct["product"]["images"][]=['src'=>$after_image];
    }
    $product = $this->shopify->call(['METHOD' => 'POST', 'URL' =>'/admin/products.json','DATA'=>$createProduct]);
    $ShopifyProduct = $product->product;
    $variants=array();
      foreach ($ShopifyProduct->variants as  $variant) {
        $variants[] = $variant->id;
        $update = ["variant" => ["id" => $variant->id,"inventory_policy"=>"continue","sku"=>"BXP11","price" => (($_POST['inc_box_price'] == 'yes') ? $_POST['bx_price'] : 0)]];
        $this->shopify->call(['METHOD' => 'PUT', 'URL' =>'/admin/variants/'.$variant->id.'.json','DATA'=>$update]);
      }

    $saveArray=[
      'card_title'=>$_POST['bx_title'],
      'shopify_product_id'=>$ShopifyProduct->id,
      'shopify_variant_ids'=>implode(',',$variants),
      'card_include_price'=> $_POST['inc_box_price'],
      'card_price'=> (($_POST['inc_box_price'] == 'yes') ? $_POST['bx_price'] : 0),
      'card_after_image'=> $after_image,
      'card_before_image'=> $before_image,
      'shop_id'=> $_GET['shop_id'],
      'shopify_product_handle'=> $ShopifyProduct->handle,
      'product_json'=> json_encode($product->product),
    ];
    if(isset($_POST['bx_id'])) {
      $saveArray['status'] = $OldBxStatus;
      $insert = $this->db->where(['id'=>$_POST['bx_id']])->update('tbl_card',$saveArray);
    } else {
      $insert = $this->Global_model->insertData('tbl_card',$saveArray);
    }
    if ($insert) {
      $msg = "Card  Created Successfully";
      if(isset($OldBxStatus)) {
        $msg = "Card Details Updated SSuccessfully";
      }
      $return = ['code'=>200,"msg"=>$msg];
    } else {
      $return = ['code'=>200,"msg"=>"Something went Wrong please Try After Sometime"];
    }
    echo json_encode($return);
  }

  public function UpdateStatus() {
    $update = $this->db->where(['id'=>$_POST['id']])->update($_POST['table'], ['status'=>$_POST['status']]);
    if ($update) {
      $return = ['code'=>200,"msg"=>"Status Updated Successfully"];
    } else {
      $return = ['code'=>200,"msg"=>"Something went Wrong please Try After Sometime"];
    }
    echo json_encode($return);
  }

  public function DelApp($id,$shop,$table) {
    $oldProductID = $this->db->select('shopify_product_id')->from($table)->where(['id'=>$id])->get()->row()->shopify_product_id;
    $shopAccess=getShop_accessToken_byShop($shop);
    $this->load->library('Shopify', $shopAccess);
    $delete = $this->shopify->call(['METHOD' => 'DELETE', 'URL' =>'/admin/products/'.$oldProductID.'.json']);
    $return = false;
    $update = $this->db->where(['id'=>$id])->delete($table);
    if($update) {
      $return = true;
    }
    return $return;
  }

  public function DeleteFromApp() {
    $update = $this->DelApp($_POST['id'],$_GET['shop'],$_POST['table']);
    if ($update) {
      $return = ['code'=>200,"msg"=>"Deleted Sceesfully"];
    } else {
      $return = ['code'=>200,"msg"=>"Something Went Wrong please Try After Sometime"];
    }
    echo json_encode($return);
  }

  public function ProductDeleteWebhook()
  {
    // $json = file_get_contents('php://input');
    // $json_decode = json_decode($json);
    // $shop = $_SERVER['HTTP_X_SHOPIFY_SHOP_DOMAIN'];
    // $this->db->query("insert into test set data='".$json."',shop='".$shop."'");
    http_response_code(200);
  }



}
