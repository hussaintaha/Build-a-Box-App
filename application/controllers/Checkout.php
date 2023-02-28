<?php
   defined('BASEPATH') or exit('No direct script access allowed');
   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Methods: GET, POST');

   class Checkout extends CI_Controller
   {
       public function __construct() {
           parent::__construct();
           $this->load->model('Global_model');
           $this->load->library('form_validation');
       }

       public function CartClear()
       {
         ob_start();
         ?>
        <script>
          var Cookies = ["discount_code", "discountPriceValue", "shippingPrice", "presentPage", "shippingHtml", "shippingCountry", "shippingState", "totalPrice", "totalPriceInput", "shippingId", "cart_currency"];
          for (i = 0; i < Cookies.length; i++) del_cookie(Cookies[i]);

          function del_cookie(i) {
            document.cookie = i + "= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
          }
          var http = new XMLHttpRequest,
          url = "/cart/clear.js",
          params = {};

          function getUrlVars() {
          var t = {};
            window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(r, a, e) {
              t[a] = e
            });
          return t
          }

          function getUrlParam(t, r) {
            var a = r;
            return window.location.href.indexOf(t) > -1 && (a = getUrlVars()[t]), a
          }
          http.open("POST", url, !0), http.onreadystatechange = function() {
            if (4 == http.readyState && 200 == http.status) {
            var t = getUrlParam("order_status_url", "/");
            window.location.href = t
            }
          }, http.send(params);
        </script>
        <style>body{display:none;}</style>

        <?php
          $html = ob_get_clean();
          return $this->output->set_content_type('application/liquid')->set_status_header(200)->set_output($html);
        }
       public function Checkout()
       {
           $shop = $_GET['shop'];
           $shop_id = shop_id($shop);
           $rootDir = $_SERVER["DOCUMENT_ROOT"];
           $customerInfo = $rootDir."/build-a-box/assets/checkout/liquid_files/checkout_CustomerInfo.liquid";
           $orderSummary = $rootDir."/build-a-box/assets/checkout/liquid_files/checkOut_OrderSummary.liquid";
           $shippingMethod = $rootDir."/build-a-box/assets/checkout/liquid_files/checkout_ShippingMethode.liquid";
           $paymentMethod = $rootDir."/build-a-box/assets/checkout/liquid_files/checkOut_paymentMethode.liquid";
           ob_start();
           ?>
          {% layout none%}
          <!DOCTYPE html>
          <html class="no-js js linux firefox desktop page--no-banner page--logo-main page--show card-fields cors svg opacity placeholder no-touchevents displaytable display-table generatedcontent cssanimations flexbox no-flexboxtweener anyflexbox shopemoji floating-labels gr__kzofsweden_com">
             <head>
                <meta charset="utf-8">
                <title>Checkout - {{shop.name}}</title>
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <link rel="shortcut icon" href="<?=base_url()."assets/storefront/logo.png"?>" type="image/png">
                <link rel="sitemap" type="application/xml" title="Sitemap" href="/sitemap.xml" />
                <link href="<?=base_url()."assets/checkout/css/shopify-checkout.css"?>" rel="stylesheet" type="text/css">
                <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                <link href="<?=base_url()."assets/checkout/css/checkout-page.css"?>" rel="stylesheet" type="text/css">
                <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
                {{ content_for_header }}
                <script src="<?=base_url()."assets/storefront/moneyformat.js"?>"></script>
                <script>
                   function setCookie(cname, cvalue) {
                     document.cookie = cname + "=" + cvalue;
                   }
                   function getCookie(cookieName) {
                     var name = cookieName + "=";
                     var allCookieArray = document.cookie.split(';');
                     for (var i = 0; i < allCookieArray.length; i++) {
                       var temp = allCookieArray[i].trim();
                       if (temp.indexOf(name) == 0) return temp.substring(name.length, temp.length);
                     }
                     return "";
                   }

                   Shopify.money_format = "{{ shop.money_format }}";
                   window.cart_items = '{{ cart.item_count}}';
                   window.page_handle = '{{ page.handle}}';
                   window.template_name = '{{ template.name }}';
                   Shopify.cart = {{ cart | json}};
                   localStorage.cart = JSON.stringify(Shopify.cart);
                   localStorage.shipping_country = '{{ customer.default_address.country}}';
                   setCookie('shippingCountry', localStorage.shipping_country);
                   {% if customer %}setCookie('login', 'true');{% else %}setCookie('login', 'false');{% endif %}
                   localStorage.province = '{{address.province}}';
                   var BaseURL = '<?=base_url()?>';
                </script>
             </head>
             <body id="checkout" class="{% if customer %}customer-logged-in {% endif %}template-{{ template | replace: '.', ' ' | truncatewords: 1, '' | handle }} flexbox-wrapper{% unless settings.animations_enabled %} animations-disabled{% endunless %}">
                <div id="main-body">
                   <div class="notification-bar custom-font" style="height:40px; padding:10px;">
                      <div id="google_translate_element"></div>
                   </div>
                   <div class="shopify-section">
                      <div id="root" class="loading" style="display:none;">
                         <div class="loading-inner" style="--top-bar-background:#00848e; --top-bar-color:#f9fafb; --top-bar-background-lighter:#1d9ba4;"><img src="data:image/svg+xml;base64,PHN2ZyB2aWV3Qm94PSIwIDAgNDQgNDQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTE1LjU0MiAxLjQ4N0EyMS41MDcgMjEuNTA3IDAgMCAwIC41IDIyYzAgMTEuODc0IDkuNjI2IDIxLjUgMjEuNSAyMS41IDkuODQ3IDAgMTguMzY0LTYuNjc1IDIwLjgwOS0xNi4wNzJhMS41IDEuNSAwIDAgMC0yLjkwNC0uNzU2QzM3LjgwMyAzNC43NTUgMzAuNDczIDQwLjUgMjIgNDAuNSAxMS43ODMgNDAuNSAzLjUgMzIuMjE3IDMuNSAyMmMwLTguMTM3IDUuMy0xNS4yNDcgMTIuOTQyLTE3LjY1YTEuNSAxLjUgMCAxIDAtLjktMi44NjN6IiBmaWxsPSIjOTE5RUFCIi8+PC9zdmc+Cg==" alt="" class="Polaris-Spinner Polaris-Spinner--colorTeal Polaris-Spinner--sizeLarge" draggable="false" role="status"></div>
                      </div>
                      <div class="banner" data-header="">
                         <div class="wrap">
                            <a class="logo logo--center" href="https://{{shop.domain}}">
                            <img alt="KZ of Sweden" class="logo__image logo__image--medium"     src="<?=base_url()."assets/storefront/logo.png"?>">
                            </a>
                            <h1 class="visually-hidden">Payment method</h1>
                         </div>
                      </div>
                      <button class="order-summary-toggle order-summary-toggle--show " data-trekkie-id="order_summary_toggle" aria-expanded="true" aria-controls="order-summary" data-drawer-toggle="[data-order-summary]">
                         <span class="wrap">
                            <span class="order-summary-toggle__inner">
                               <span class="order-summary-toggle__icon-wrapper">
                                  <svg width="20" height="19" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle__icon">
                                     <path d="M17.178 13.088H5.453c-.454 0-.91-.364-.91-.818L3.727 1.818H0V0h4.544c.455 0 .91.364.91.818l.09 1.272h13.45c.274 0 .547.09.73.364.18.182.27.454.18.727l-1.817 9.18c-.09.455-.455.728-.91.728zM6.27 11.27h10.09l1.454-7.362H5.634l.637 7.362zm.092 7.715c1.004 0 1.818-.813 1.818-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817zm9.18 0c1.004 0 1.817-.813 1.817-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817z"></path>
                                  </svg>
                               </span>
                               <span class="order-summary-toggle__text order-summary-toggle__text--show">
                                  <span>Show order summary</span>
                                  <svg width="11" height="6" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle__dropdown" fill="#000">
                                     <path d="M.504 1.813l4.358 3.845.496.438.496-.438 4.642-4.096L9.504.438 4.862 4.534h.992L1.496.69.504 1.812z"></path>
                                  </svg>
                               </span>
                               <span class="order-summary-toggle__text order-summary-toggle__text--hide">
                                  <span>Hide order summary</span>
                                  <svg width="11" height="7" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle__dropdown" fill="#000">
                                     <path d="M6.138.876L5.642.438l-.496.438L.504 4.972l.992 1.124L6.138 2l-.496.436 3.862 3.408.992-1.122L6.138.876z"></path>
                                  </svg>
                               </span>
                               <span class="order-summary-toggle__total-recap total-recap" data-order-summary-section="toggle-total-recap">
                               <span class="total-recap__final-price" id="total-final-price" data-checkout-payment-due-target="9800">{{ cart.total_price| money }}</span>
                               </span>
                            </span>
                         </span>
                      </button>
                      <div class="content" data-content="">
                         <div class="wrap">
                            <div class="main" role="main">
                               <div class="main__header">
                                  <a class="logo logo--center" href="https://{{shop.domain}}">
                                  <img alt="KZ of Sweden" class="logo__image logo__image--medium"
                                   src="<?=base_url()."assets/storefront/logo.png"?>">

                                  </a>
                                  <ul class="breadcrumb breadcrumb--center">
                                     <li class="breadcrumb__item breadcrumb__item--completed">
                                        <a class="breadcrumb__link" data-trekkie-id="breadcrumb_cart_link"
                                           href="/cart"
                                           >Cart</a>
                                        <svg class="icon-svg icon-svg--color-adaptive-light icon-svg--size-10 breadcrumb__chevron-icon" aria-hidden="true" focusable="false">
                                           <use xlink:href="#chevron-right"></use>
                                        </svg>
                                     </li>
                                     <li class="breadcrumb__item breadcrumb__item--current">
                                        <span class="breadcrumb__text" aria-current="step">Customer information</span>
                                        <svg class="icon-svg icon-svg--color-adaptive-light icon-svg--size-10 breadcrumb__chevron-icon" aria-hidden="true" focusable="false">
                                           <use xlink:href="#chevron-right"></use>
                                        </svg>
                                     </li>
                                     <li class="breadcrumb__item breadcrumb__item--completed">
                                        <span class="breadcrumb__text" aria-current="step">Shipping method</span>
                                        <svg class="icon-svg icon-svg--color-adaptive-light icon-svg--size-10 breadcrumb__chevron-icon" aria-hidden="true" focusable="false">
                                           <use xlink:href="#chevron-right"></use>
                                        </svg>
                                     </li>
                                     <li class="breadcrumb__item breadcrumb__item--blank">
                                        <span class="breadcrumb__text" aria-current="step">Payment method</span>
                                     </li>
                                  </ul>
                                  <div class="shown-if-js" data-alternative-payments=""></div>
                               </div>
                               <div class="main__content">
                                  {{ shop.currency.symbol}}
                                  <div class = "customer_info">
                                    <?php include $customerInfo; ?>

                                  </div>
                                  <div class = "shipping_method" style="display:none">
                                    <?php include $shippingMethod; ?>
                                  </div>
                                  <div class = "payment_method" style="display:none" >
                                    <?php include $paymentMethod; ?>
                                  </div>
                               </div>
                               <div class="main__footer">
                                  <div role="contentinfo" aria-label="Footer">
                                     <p class="copyright-text">
                                        All rights reserved {{shop.name}}
                                     </p>
                                  </div>
                               </div>
                            </div>
                            <?php  include $orderSummary ?>
                         </div>
                      </div>
                   </div>
                </div>
                <script src="<?=base_url()."assets/checkout/js/main.js"?>"></script>
                <script src="<?=base_url()."assets/checkout/js/countries.js"?>"></script>
                <script  src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                <input class="visually-hidden shop_domain"  type="hidden" value="{{shop.permanent_domain}}" />
                <script  src="https://js.stripe.com/v3/"></script>
             </body>
          </html>
          <?php
          $html = ob_get_clean();
          return $this->output->set_content_type('application/liquid')->set_status_header(200)->set_output($html);
          }


        public function GetCountyList(){
            $countries = $this->Global_model->GetCountries();
            $options   = '<option value="">Select Country</option>';
            foreach ($countries as $country) {
              $options .= '<option data-val="' . $country->name . '" data-id="' . $country->id . '" value="' . $country->name . '">' . $country->name . '</option>';
            }
            echo $options;
        }

  public function checkPaymentStatus(){
      $shop1 = $_GET['shop'];
      if ($_POST['orderId'] && $_POST['shop'] && $_POST['source']) {
        // $shop1       = $_POST['shop'];
        $shopAccess = getShop_accessToken_byShop($shop1);
        $token = $this->load->library('Shopify', $shopAccess);
        $stripeSKey = stripeKey($_POST['shop']);
        \Stripe\Stripe::setApiKey($stripeSKey);
        $paymentStatus = \Stripe\Token::retrieve($_POST['source']);
        if ($_POST['type'] == 'token') {
          $this->stripe_payment($_POST);
        }elseif($_POST['type'] == 'source') {
          if($paymentStatus['redirect']['status'] == 'succeeded'){
            $this->stripe_payment($_POST);
          }else{
              $this->shopify->call(['METHOD' => 'DELETE', 'URL' => '/admin/draft_orders/'.$_POST['orderId'].'.json'], true);
              echo json_encode([
                'status'  => false,
                'message' => 'Something went wrong',
                'code' => 201,
                'redirect_url' => 'https://'.$_POST['shop'].'/apps/builder/checkout?status=payment_failed&page=payment_method'
              ]);
          }
        }
      }
    }

    public function CreatePlans()
    {
      $shop = "testmayookh.myshopify.com";
      $stripeSKey = stripeKey($shop);
      \Stripe\Stripe::setApiKey($stripeSKey);

      try {
          $PlanArray = [
            'amount' => 2000,
            'currency' => 'INR',
            'interval' => 'week',
            'interval_count' => '2',
            'product' => ['name' =>"Demo Product"]
          ];
          // $PlanArray = [
          //   'amount' => 2000,
          //   'currency' => 'INR',
          //   'interval' => 'day',
          //   'interval_count' => '5',
          //   'product' => ['name' =>"Demo Product"]
          // ];
        $plan = \Stripe\Plan::create($PlanArray);
        print_r($plan);
      } catch (\Exception $e) {

        echo "<pre>";
        print_r($e);
        echo "</pre>";
      }


       echo "hello";
       exit;
    }

    public function stripe_payment($data){
       $shopAccess = getShop_accessToken_byShop($data['shop']);
       $token = $this->load->library('Shopify', $shopAccess);
         if($data['amount'] > 0){
             $amountTocapture = $data['amount'];
           }else{
             $amountTocapture = 100;
           }

         try {
               $DraftDetails = $this->shopify->call(['METHOD' => 'GET', 'URL' => '/admin/draft_orders/'.$data['orderId'].'.json'], true);
               $shopifyCustomer = $DraftDetails->draft_order->customer;
               $stripeCustomerArray =[
                   'email' =>  $shopifyCustomer->email,
                   'name' => $shopifyCustomer->first_name." ".$shopifyCustomer->first_name,
                   'source' => $data['source'],
               ];
               $StripeCustomer = \Stripe\Customer::create($stripeCustomerArray);
               $CID = $StripeCustomer->id;
               $otherTotal =0;
               foreach ($DraftDetails->draft_order->line_items as $k => $line) {
                 if (isset($line->properties) && count((array) $line->properties) > 0){
                       foreach ($line->properties as $prop) {
                         if($prop->name == '_variants'){
                           $metaData = $prop->value;
                         }
                         if($prop->name == '_bxnumber'){
                           $bxNUmber = $prop->value;
                         }
                         if($prop->name == 'frequency_type'){
                           $frequency_type = $prop->value;
                         }
                         if($prop->name == 'frequency_number'){
                           $interval_count = $prop->value;
                         }
                       }
                       $PlanArray = [
                         'amount' => (int)$line->price*100,
                         'currency' => $data['currency'],
                         'interval' => $frequency_type,
                         'interval_count' => $interval_count,
                         'product' => ['name' => $line->title]
                       ];
                     $plan = \Stripe\Plan::create($PlanArray);
                     $subArray = [
                       'customer' => $CID,
                       'items' => [['plan' => $plan->id]],
                       'metadata' =>['items'=>$metaData,'bxnumber'=>$bxNUmber,'shopify_customer_id'=>$shopifyCustomer->id],
                     ];
                     $subscription = \Stripe\Subscription::create($subArray);
                     $post_data = [
                       'start_date'=>date('Y-m-d'),
                       'interval_type'=>$frequency_type,
                       'interval_frequency'=>$interval_count,
                       'bx_number'=>$bxNUmber,
                       'shop_id'=>shop_id($data['shop']),
                       'stripe_plan_id'=>$plan->id,
                       'stripe_subscription_id'=>$subscription->id,
                       'shopiy_customer_id'=>$shopifyCustomer->id,
                       'stripe_cutomer_id'=>$CID,
                       'status'=>1
                     ];
                     $this->db->insert('tbl_stripe_subscription', $post_data);
                     $insert_id = $this->db->insert_id();
                     $SubSaveArray =[];
                     foreach ($line->properties as $prop) {
                       if($prop->name == '_variants'){
                         $vars = explode(',',$prop->value);
                         foreach ($vars as  $dt) {
                           $ITEM = explode('_',$dt);
                           $SubSaveArray [] = ['tbl_subscription_id'=>$insert_id,'variant_id'=>$ITEM[0],'qty'=>$ITEM[1],'order_json'=>json_encode($DraftDetails)];
                         }
                       }
                     }
                     $this->db->insert_batch('subscription_item_details', $SubSaveArray);
                 }else{
                   $otherTotal = $otherTotal + ((int)$line->price*100) * $line->quantity;
                 }
               }
               echo json_encode(array(
                 'status'  => true,
                 'message' => 'SCA checked',
                 'code' => 200,
                 'amt' => $amountTocapture,
               ));
         } catch (Exception $e) {
           $this->shopify->call(['METHOD' => 'DELETE', 'URL' => '/admin/draft_orders/'.$data['orderId'].'.json'], true);
           echo json_encode(array(
             'status'  => false,
             'message' => 'Something went wrong',
             'code' => 201,
             'redirect_url'=>'https://'.$data['shop'].'/apps/builder/checkout?status=payment_failed&page=payment_method'
           ));
         }
       }

       public function createOrder(){
           $shop = $_GET['shop'];
           $orderid = $_POST['order_id'];
           $res = array(
                   'status'  => true,
                   'code' => 200,
                   'message' => 'Order created'
                 );
           $shopAccess = getShop_accessToken_byShop($shop);
           $token = $this->load->library('Shopify', $shopAccess);
           $order = array(
             'draft_order' => array(
               'id' => $orderid,
               'status' => 'completed'
             ),
           );
           $updateData = $this->shopify->call(['METHOD' => 'PUT', 'URL' => '/admin/draft_orders/'.$orderid.'/complete.json'], true);
           if ($updateData) {
             $orderId = $updateData->draft_order->order_id;
             $order = $this->shopify->call(['METHOD' => 'GET', 'URL' => '/admin/orders/'.$orderId.'.json'], true);
             if ($order) {
               $orderId = $order->order->id;
               $orderName = $order->order->name;
               $draftId = $updateData->draft_order->id;
               $this->Global_model->updateOrder($orderId,$orderName,$draftId);
               $redirect_url = 'https://'.$shop.'/apps/builder/clear-cart?order_status_url='.$order->order->order_status_url;
               $res['redirect_url'] = $redirect_url;
             }
           }else{
             $this->shopify->call(['METHOD' => 'DELETE', 'URL' => '/admin/draft_orders/'.$orderId.'.json'], true);
             $redirect_url = 'https://'.$shop.'/apps/builder/checkout?status=payment_failed&page=payment_method';
             $res['redirect_url'] = $redirect_url;
             $res['message'] = 'Something went wrong';
             $res['code'] = 201;
           }

           echo json_encode($res);
         }

         public function properties($array)
         {
             $retu_array = array();
             foreach ($array as $key => $value) {
                 $retu_array[] = ['name' => $key, 'value' => $value];
             }
             return $retu_array;
         }



            public function createDraftOrder()
              {
                $shop = $_GET['shop'];
                $shopAccess = getShop_accessToken_byShop($shop);
                $token = $this->load->library('Shopify', $shopAccess);
                $cart_data = json_decode($_POST['cart_data']);

                $shipping_method = urldecode($_POST['customer_data']['shipping_method']);
                parse_str($shipping_method,$shippingMethod);

                $string_shipping_address = urldecode($_POST['customer_data']['customer_info']);
                parse_str($string_shipping_address,$shippingdata);

                $shipping_addr = $shippingdata['checkout']['shipping_address'];
                foreach ($shipping_addr as $key => $val) {
                  $shipping_addr[$key] = (isset($shipping_addr[$key]) ? $val : '');
                }

                $string_billing_address = urldecode($_POST['customer_data']['billing_address']);
                parse_str($string_billing_address,$billingdata);
                $billing_addr = $billingdata['checkout']['billing_address'];

                if (!empty($billing_addr['address1'])) {
                  foreach ($billing_addr as $key => $val) {
                    $billing_addr[$key] = (isset($billing_addr[$key]) ? $val : '');
                  }
                }else{
                  $billing_addr = $shipping_addr;
                }

                $lineArray = array();
                foreach ($cart_data->items as $value) {
                  if(count($value->discounts) > 0){
                    $line_discount =   array(
                        'title' => $value->discounts[0]->title,
                        'description' => 'Discount code',
                        'value' => ($value->discounts[0]->amount/100),
                        'value_type' => 'fixed_amount' ,
                        'amount' => ($value->discounts[0]->amount/100)
                    );
                    $line =array('variant_id' => $value->variant_id,'quantity' => $value->quantity,'applied_discount' => $line_discount);
                  }else{
                    $line =array('variant_id' => $value->variant_id,'quantity' => $value->quantity);
                  }


                  $get_properties = array();
                  if (isset($value->properties) && count((array) $value->properties) > 0) {
                      $line['properties'] = $this->properties($value->properties);
                  }
                  $lineArray[] =  $line;
                }

                $draft_order = array(
                   "draft_order" => array(
                       "line_items" => $lineArray,
                       "shipping_address" => $shipping_addr,
                       "billing_address" => $billing_addr,
                       "note" => $billingdata['payment_gateway'],
                       "email" => $shippingdata['checkout']['email'],
                       "note_attributes" =>array(
                         array(
                             'name' => 'Payment Method',
                             'value' => $billingdata['payment_gateway']
                           )
                         )
                     )
                 );

                 if (isset($_POST['discountPrice'],$_POST['coupenCode']) && !empty($_POST['discountPrice']) && !empty($_POST['coupenCode'])) {
                     $draft_order["draft_order"]["applied_discount"] = array(
                       'title' => $_POST['coupenCode'],
                       'description' => 'Discount code',
                       'value' => $_POST['discountPrice'] ,
                       'value_type' => 'fixed_amount' ,
                       'amount' => $_POST['discountPrice']
                     );
                 }

                 if (isset($shippingMethod['shipping_rate'],$_POST['shippingPrice'])) {
                   $draft_order["draft_order"]["shipping_line"] = array(
                       'title' => $shippingMethod['shipping_rate'],
                       'custom' => true,
                       'price' =>$_POST['shippingPrice'],
                     );
                 }
                 $response=[];
                 try {
                     $DraftOrder = $this->shopify->call(['METHOD' => 'POST', 'URL' => '/admin/draft_orders.json', 'DATA' => $draft_order], true);
                     if (isset($DraftOrder->draft_order)) {
                       $this->Global_model->InsertDraftOrder($DraftOrder->draft_order);
                       $response = ['status' => true,'code' => 200,'draft_order' => $DraftOrder];
                     }else{
                       $response = ['status' => false,'code' => 100, 'msg' => 'Something went wrong try again.'];
                     }
                 }catch (\Exception $e) {
                     $body = $e->getJsonBody();
                     $err  = $body['error'];
                     $response = ['status' => false,'code' => 100, 'msg' => $err['message']];
                 }
                 echo json_encode($response);
              }


        public function GetStateList()
        {
            $lists   = $this->Global_model->GetParamList($_GET['country_id']);
            $options   = '<option value="">Select State</option>';
            foreach ($lists as $list) {
            $options .= '<option data-val="' . $list->name . '" data-id="' . $list->id . '" value="' . $list->name . '">' . $list->name . '</option>';
            }
            echo $options;
        }

        public function getData(){
           $shop = $_GET['shop'];
           $stripeData = $this->Global_model->get_stripe_key(shop_id($shop));
           $data['stripe_key'] = ($stripeData->mode == 0 ? $stripeData->test_p_key : $stripeData->live_p_key );
           $data['name'] = $stripeData->user_name;
           $data['email'] = $stripeData->user_email;
           $data['base_url'] = base_url();
           $countries = $this->Global_model->GetCountries();
           $options   = '<option value="">Select Country</option>';
           foreach ($countries as $country) {
               $options .= '<option data-val="' . $country->name . '" data-id="' . $country->id . '" value="' . $country->name . '">' . $country->name . '</option>';
           }
           $data['countries'] = $options;
           $data['provider_data'] = $this->Global_model->activePaymentMethod();
           echo json_encode($data);
       }
}
