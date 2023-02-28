<?php
   defined('BASEPATH') or exit('No direct script access allowed');
   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Methods: GET, POST');

   class StripeWebhookController extends CI_Controller
   {
       public function __construct() {
           parent::__construct();
           $this->load->model('Global_model');
           $this->load->library('form_validation');
       }

       public function CreateOrderInShopify($payload,$shop)
       {
          $data = json_decode($payload);
          $shopAccess=getShop_accessToken_byShop($shop);
          $this->load->library('Shopify', $shopAccess);
          $customerEmail =$data->data->object->customer_email;
          if(isset($data->data->object->lines)){
            $ItemDetails = $data->data->object->lines;
            foreach ($ItemDetails->data as  $line){
              $lineItems=[];
              $metaData = $line->metadata;
              if(isset($metaData->items)){
                  $ShopifyItems = explode(',',$metaData->items);
                  foreach ($ShopifyItems as  $variant){
                    $dt = explode('_',$variant);
                    $lineItems[] = [ "variant_id" => $dt[0],"quantity"=> $dt[1]];
                  }
              }
              $order = ["order"=> ["email"=> $customerEmail,"fulfillment_status"=> "fulfilled","send_receipt"=> true,"send_fulfillment_receipt"=> true,"line_items"=> $lineItems]];
              $order = $this->shopify->call(['METHOD' => 'POST', 'URL' => '/admin/orders.json', 'DATA' => $order], true);
          }
        }
       }
       public function CreateShopifyOrder()
       {
          $shop = $_GET['shop'];
          $stripeSKey = stripeKey($shop);
          $endpoint_secret = EndpointSecret(mode($shop),shop_id($shop));

          // echo $endpoint_secret;
          // exit;
          \Stripe\Stripe::setApiKey($stripeSKey);
          $payload = @file_get_contents("php://input");
          $sig_header = $_SERVER["HTTP_STRIPE_SIGNATURE"];
          $data = json_decode($payload);
      		$event = null;
      	  try {
      	    $event = \Stripe\Webhook::constructEvent(
      	      $payload, $sig_header, $endpoint_secret
      	    );
            http_response_code(200);
            $this->CreateOrderInShopify($payload,$shop);
           exit();
      	  } catch(\UnexpectedValueException $e) {
      	    http_response_code(400);
      	    exit();
      	  } catch(\Stripe\Error\SignatureVerification $e) {
      	    http_response_code(400);
      	    exit();
      	  }
       }



  }
