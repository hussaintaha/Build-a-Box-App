<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

class WebhookController extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Global_model');
        $this->load->library('form_validation');
    }

    public function ProductDeleteWebhook()
    {
        $json = file_get_contents('php://input');
        $json_decode = json_decode($json);
        $pid = $json_decode->id;
        $shop = $_SERVER['HTTP_X_SHOPIFY_SHOP_DOMAIN'];
        $shop_id = shop_id($shop);
        $where = ['shopify_product_id'=> $pid,'shop_id'=>$shop_id];
        $isBox = $this->db->where($where)->count_all_results('tbl_box');
        // $this->db->query("insert into test set data='".$json."',shop='".$isBox."'");
        if($isBox > 0){
          $delete = $this->db-> where($where)->delete('tbl_box');
          http_response_code(200);
          exit;
        }
        $isCard = $this->db->where($where)->count_all_results('tbl_card');
        if($isCard > 0){
          $delete = $this->db-> where($where)->delete('tbl_card');
          http_response_code(200);
          exit;
        }
    }

// bx_colors
    public function ProductUpdateWebhook()
    {

        $json = file_get_contents('php://input');
        $json_decode = json_decode($json);
        $pid = $json_decode->id;
        $shop = $_SERVER['HTTP_X_SHOPIFY_SHOP_DOMAIN'];
        $shop_id = shop_id($shop);
        $where = ['shopify_product_id'=> $pid,'shop_id'=>$shop_id];
        $ShopifyProduct = $json_decode;
        $variants=array();
        $colors = array();
        foreach ($ShopifyProduct->variants as  $variant) {
          $variants[] = $variant->id;
          $colors[] = $variant->option1;
        }
        $isBox = $this->db->where($where)->count_all_results('tbl_box');
        // $this->db->query("insert into test set data='".$json."',shop='".$isBox."'");
        if($isBox > 0){
          $saveArray=[
            'bx_title'=>$ShopifyProduct->title,
            'shopify_product_id'=>$ShopifyProduct->id,
            'bx_colors'=>implode(',',$colors),
            'shopify_variant_ids'=>implode(',',$variants),
            'shopify_product_handle'=> $ShopifyProduct->handle,
            'product_json'=> $json,
          ];
          $insert = $this->db->where($where)->update('tbl_box',$saveArray);
          http_response_code(200);
          exit;
        }

        $isCard = $this->db->where($where)->count_all_results('tbl_card');
        if($isCard > 0){
          $saveArray=[
            'card_title'=>$ShopifyProduct->title,
            'shopify_product_id'=>$ShopifyProduct->id,
            'shopify_variant_ids'=>implode(',',$variants),
            'shopify_product_handle'=> $ShopifyProduct->handle,
            'product_json'=> $json,
          ];
          $insert = $this->db->where($where)->update('tbl_card',$saveArray);
          http_response_code(200);
          exit;
        }

    }





  }
