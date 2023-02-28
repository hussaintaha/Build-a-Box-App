<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

class Subscription extends CI_Controller
{
    public $recharge_key;
    public $ruleSetId;
    public function __construct() {
        parent::__construct();
        $this->load->model('Global_model');
        $this->load->library('form_validation');
        $this->recharge_key ='2d7cdb1ac2d3c665b5095d9c0ead4b6e4b94b5978f17b6c0b79f3b4b';
        $this->ruleSetId ='264578';
    }



    public function Shopjson($shop){
      $shopAccess=getShop_accessToken_byShop($shop);
      $this->load->library('Shopify', $shopAccess);
      return $this->shopify->call(['METHOD' => 'GET', 'URL' =>'/admin/shop.json']);
    }

    public function CreateShopifyBoxProductForCustomer()
    {
      $shop = $_GET['shop'];
      $cart = json_decode($_POST['cartData']);
      $vendor = $this->Shopjson($shop)->shop->name;
      $shopAccess=getShop_accessToken_byShop($shop);
      $this->load->library('Shopify', $shopAccess);
      $CreatedProducts = array();
      $return=array();
      foreach ($cart as $key => $crt){
            $createProduct = [
              "product"=> [
                "title"=> "Box #".$key." :".$crt->products[0]->title,
                "vendor" => $vendor,
                "product_type"=> "HIDDEN_BOX_PRODUCT",
              ]
            ];
            $boxTotal = 0;
            foreach ($crt->products as $ct => $itm) {
              $itm = (array)$itm;
              $createProduct["product"]["images"][]=['src'=>$itm['box-image']];
              $boxTotal+=$itm['price'] * $itm['qty'];
            }
            $product = $this->shopify->call(['METHOD' => 'POST', 'URL' =>'/admin/products.json','DATA'=>$createProduct]);
            $ShopifyProduct = $product->product;
            $variants=array();
            foreach ($ShopifyProduct->variants as $variant){
              $variants[] = $variant->id;
              $update = ["variant" => ["id" => $variant->id,"inventory_policy"=>"continue","sku"=>"BXP11","price" => ($boxTotal/100)]];
              $this->shopify->call(['METHOD' => 'PUT', 'URL' =>'/admin/variants/'.$variant->id.'.json','DATA'=>$update]);
            }
        $return[$key] = ['pid'=>$ShopifyProduct->id,'variants'=>$variants];
      }
      echo json_encode(['code'=>200,'data'=>$return]);
    }

    public function CreateSubscriptionProduct()
    {
      $shop = $_GET['shop'];
      $cart = json_decode($_POST['cartData']);
      $vendor = $this->Shopjson($shop)->shop->name;
      $shopAccess=getShop_accessToken_byShop($shop);
      $this->load->library('Shopify', $shopAccess);

      $CreatedProducts = array();
      $VariantData=array();
      $return=array();
      foreach ($cart as $key => $crt){
            $createProduct = [
              "product"=> [
                "title"=> "Box #".$key." :".$crt->products[0]->title,
                "vendor" => $vendor,
                "product_type"=> "HIDDEN_BOX_PRODUCT",
              ]
            ];
            $boxTotal = 0;
            foreach ($crt->products as $ct => $itm) {
              $itm = (array)$itm;
              $createProduct["product"]["images"][]=['src'=>$itm['box-image']];
              $boxTotal+=$itm['price'] * $itm['qty'];
            }
            $product = $this->shopify->call(['METHOD' => 'POST', 'URL' =>'/admin/products.json','DATA'=>$createProduct]);
            $ShopifyProduct = $product->product;
            $variants=array();
            foreach ($ShopifyProduct->variants as $variant){
              $variants[] = $variant->id;
              $update = ["variant" => ["id" => $variant->id,"inventory_policy"=>"continue","sku"=>"BXP11","price" => ($boxTotal/100)]];
              $this->shopify->call(['METHOD' => 'PUT', 'URL' =>'/admin/variants/'.$variant->id.'.json','DATA'=>$update]);
            }
            $VariantData[$ShopifyProduct->id] = $variants;
            // $putData = ["product"=> ["id"=> $ShopifyProduct->id,"published"=> false]];
            // $this->shopify->call(['METHOD' => 'PUT', 'URL' =>'/admin/products/'.$ShopifyProduct->id.'.json','DATA'=>$putData]);
            $CreatedProducts[]=$ShopifyProduct->id;
            $return[$key] = ['pid'=>$ShopifyProduct->id,'variants'=>$variants];
            //$thi->CreateProductInRecharge($ShopifyProduct->id);
      }

      echo json_encode(['code'=>200,'data'=>$return,'pids'=>$CreatedProducts]);
    }



    public function FindMappingVariant()
    {
        $shop = $_GET['shop'];
        $cart = json_decode($_POST['cartData']);
        $shopAccess=getShop_accessToken_byShop($shop);
        $this->load->library('Shopify', $shopAccess);
        $return = array();
        foreach ($cart as  $crt){
          $metafields = $this->shopify->call(['METHOD' => 'GET', 'URL' =>'/admin/products/'.$crt.'/metafields.json']);
          foreach ($metafields->metafields as $meta) {
            if($meta->key == 'original_to_hidden_variant_map'){
              $decodedMeta = json_decode($meta->value);
              foreach ($decodedMeta as $json) {
                if(isset($json->discount_variant_id)){
                  $amppingVarinat = $json->discount_variant_id;
                  $return[$crt] = $amppingVarinat;
                }
              }
            }
          }
        }
      echo json_encode(['code'=>200,'data'=>$return]);
    }



      public function CreateProductInRecharge($pid)
      {
          $ApiKey = $this->recharge_key;
          $curl = curl_init();
          $NewJson = [
                "shopify_product_id"=> $pid,
                "collection_id" =>$this->ruleSetId,
                "subscription_defaults"=> [
                    "charge_interval_frequency"=> 1,
                    "order_interval_frequency_options"=> ["1"],
                    "order_interval_unit"=> "month",
                    "storefront_purchase_options"=> "subscription_and_onetime"
                ]
            ];
          curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rechargeapps.com/products",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>json_encode($NewJson),
            CURLOPT_HTTPHEADER => array(
              "x-recharge-access-token: ".$ApiKey,
              "content-type: application/json",
            ),
          ));
          $response = curl_exec($curl);
          curl_close($curl);
      }

      public function CreateProductInRecharge2()
      {
          $products = json_decode($_POST['products']);
          foreach ($products as $key => $pid) {
          $ApiKey = $this->recharge_key;
          $curl = curl_init();
          $NewJson = [
                "shopify_product_id"=> $pid,
                "collection_id" =>$this->ruleSetId,
                "subscription_defaults"=> [
                    "charge_interval_frequency"=> 1,
                    "order_interval_frequency_options"=> ["1"],
                    "order_interval_unit"=> "month",
                    "storefront_purchase_options"=> "subscription_and_onetime"
                ]
            ];
          curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rechargeapps.com/products",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>json_encode($NewJson),
            CURLOPT_HTTPHEADER => array(
              "x-recharge-access-token: ".$ApiKey,
              "content-type: application/json",
            ),
          ));
          $response = curl_exec($curl);
          curl_close($curl);
        }
        echo json_encode(['code'=>200,'pids'=>$products]);
      }

      public function AttachSingleProductToRuleSet()
      {
        $pid = $_GET['pid'];
        $this->CreateProductInRecharge($pid);
        echo json_encode(['code'=>200,'set_id'=>$this->ruleSetId]);
      }

    public function CreateReulset()
    {

          $ApiKey = $this->recharge_key;
          $curl = curl_init();
          curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rechargeapps.com/shop",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "x-recharge-access-token: ".$ApiKey,
              "content-type: application/json",
            ),
          ));

          $response = curl_exec($curl);
          curl_close($curl);
          $jsonrresponse = json_decode($response);
          if(isset($jsonrresponse->error)){
            $error = $jsonrresponse->error;
            echo $error;
          }else{
            echo "<pre>";
            print_r($jsonrresponse);
            echo "</pre>";

          }
    }







  }
