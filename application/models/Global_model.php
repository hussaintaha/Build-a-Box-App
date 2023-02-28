<?php

class Global_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /*********start comman function for all*******************/
    public function check_ShopExist($shop = NULL)
    {
        $query = $this->db->query("SELECT * FROM `shopify_stores` where  shop='" . $shop . "'");
        $rows  = $query->num_rows();
        if ($rows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update_Shop($data, $accessToken)
    {
        if ($accessToken) {
            $sql = "update  shopify_stores set code='" . $data['code'] . "', hmac='" . $data['code'] . "', token='" . $accessToken . "' where  shop='" . $data['shop'] . "' ";
            $this->db->query($sql);
        }
    }
    public function get_shop_details($shop = NULL)
    {
        $shop_details = $this->db->select('charge_id')->where('shop', $shop)->get('shopify_stores');
        if ($shop_details->num_rows() > 0) {
            return $shop_details->row();
        } else {
            return false;
        }
    }

    public function update_webhook($shop, $mode, $webhook_id)
    {
        $shop_id      = getShopIdby_shop($shop);
        $insert_array = array(
            "secret"  => $webhook_id,
            "mode"    => $mode,
            "shop_id" => $shop_id,
        );
        $query     = $this->db->insert('stripe_webhook_endpoints', $insert_array);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }


    public function add_newShop($data, $accessToken)
    {
      $details = array(
        'code'=>$data['code'],
        'hmac'=>$data['hmac'],
        'domain'=>$data['shop'],
        'shop'=>$data['shop'],
        'token'=>$accessToken
    );

        // $sql = "insert into shopify_stores set code='" . $data['code'] . "', hmac='" . $data['code'] . "', domain='" . $data['shop'] . "',shop='" . $data['shop'] . "', token='" . $accessToken . "' ";
        // $this->db->query($sql);

        $return = $this->db->insert('shopify_stores',$details);
        $insert_id = $this->db->insert_id();

         $sql = "insert into tbl_active_checkout set current_checkout = 0, shop_id = ".$insert_id;
         // print_r($sql);
         // exit;
        $this->db->query($sql);
        //return $insert_id;
    }
    public function UpdateShopDetails($where = array(), $data = array())
    {
        $this->db->where($where)->update('shopify_stores', $data);
        return $this->db->affected_rows();
    }
    public function insertData($table,$data)
    {
      $return = $this->db->insert($table,$data);
      $insert_id = $this->db->insert_id();
      return $insert_id;
    }
    public function getGiftList($shop_id){
      $data = $this->db->select('*')
                       ->from('tbl_gift_wrap')
                       ->where("shop_id = '$shop_id'")
                       ->get()->result();
      return $data;
    }
    public function GetBoxList($shop_id,$table){
      $data = $this->db->select('*')
                       ->from($table)
                       // ->from('tbl_box')
                       ->where("shop_id = '$shop_id'")
                       ->get()->result();
      return $data;
    }
    public function active($id)
    {
      $data = $this->db->query("update tbl_gift_wrap set status='activate' where id='".$id."'");
      return $data;
    }
    public function deactive($id)
    {
      $data = $this->db->query("update tbl_gift_wrap set status='deactivate' where id='".$id."'");
      return $data;
    }
    public function delete($id)
    {
      $data = $this->db->query("delete from tbl_gift_wrap where id='".$id."'");
      return $data;
    }


      public function GetCountries()
     {
         return $this->db->select('*')->get('countries')->result();
     }

     public function GetParamList($id)
     {
         return $this->db->select('*')->where('country_id', $id)->get('states')->result();
     }

     public function InsertDraftOrder($data){
         if (isset($data->id) && isset($data->name) ) {
             $sql = "insert into Orders set draftOrderId='" . $data->id. "', draftOrderName='" . $data->name . "',email='" . $data->email . "' ";
             $this->db->query($sql);
         }
     }

     public function get_stripe_key($shop_id = '')
     {
       return $this->db->select('*')->where('shop_id',$shop_id)->get('stripe_key')->row();
     }

     public function activePaymentMethod(){
       return $this->db->select('*')->where('status',1)->order_by('row_order','asc')->get('payment_providers')->result();
     }
      public function updateOrder($orderId,$orderName,$draftId){
        $sql = "update Orders set orderId='" . $orderId . "',orderName = '" . $orderName . "' where draftOrderId='" . $draftId . "' ";
        $this->db->query($sql);
      }
}
?>
