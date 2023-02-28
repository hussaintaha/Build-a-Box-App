<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

class ShopifyUser extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Global_model');
        $this->load->library('form_validation');
    }


    public function UserDahboard()
    {
        $shop = $_GET['shop'];
        $shop_id = shop_id($shop);
        ob_start();
        ?>
        <link href="<?=base_url()."assets/storefront/style.css"?>" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
        <script src="<?=base_url()."assets/storefront/moneyformat.js"?>"></script>
        <script>Shopify.money_format = "{{ shop.money_format }}";</script>
          <style>
        .accordion {
        	background-color: #eee;
        	color: #444;
        	cursor: pointer;
        	padding: 18px;
        	width: 100%;
        	border: none;
        	text-align: left;
        	outline: none;
        	font-size: 20px;
        	transition: 0.4s;
        	margin-top: 2%;
        	font-weight: 600;
        }

          .active, .accordion:hover {
            background-color: #ccc;
          }

          .accordion:after {
            content: '\002B';
            color: #777;
            font-weight: bold;
            float: right;
            margin-left: 5px;
          }

          .active:after {
            content: "\2212";
          }

          .panel {
            padding: 0 18px;
            background-color: white;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
          }
          .MainDiv{
            margin-left: 6%;
            margin-right: 6%;
          }
          .subscription-details-container{
            float: right;
          }
          .flex-column-half {
            flex: 0 0 50% !important;
          }
          .flex-column {
            min-width: 0 !important;
            padding-right: 50px !important;
          }
          .subscription-details-block-container {
            display: flex !important;
            margin-top: 15px !important;
          }
          .subscription-details-block {
            margin-bottom: 15px !important;
          }
          .subscription-details-block > p:first-child {
            font-weight: bold !important;
          }
          .subscription-details-block > p {
            line-height: 1.0em !important;
          }
          .subscription-details-block > p {
            line-height: 1.0em !important;
            margin-bottom: 5px !important;
          }
          .subscription-container p, .subscription-container table, .subscription-container li {
            margin: 0 !important;
            padding: 0 !important;
          }
          .subscription-details-block-container .subscription-product-list-item {
            display: flex !important;
          }
          .subscription-details-block > p {
            line-height: 1.0em  !important;
          }
            .subscription-button.msp__link {
              color: red !important;
              font: inherit !important;
              cursor: pointer !important;
            }
          </style>

            <div class="MainDiv">
                <h2 style="text-align: center;font-size: 30px;color: red;">My Build Your Box subscription</h2>
                <div class="vw-subscriptions">
                </div>
          </div>

          <script>
          $shopURL = '{{shop.url}}';
          if(!window.ShopifyAnalytics.meta.page.customerId){
            $acountURL = $shopURL+'/account/login?checkout_url=https://testmayookh.myshopify.com/apps/builder/my-dashboard';
              swal({
                title: "Not Logged in",
                text: "Please Login To Access your Dashboard",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              }).then((willDelete) => {
              if (willDelete) {
                window.location.href = $acountURL;
              } else {
                  window.location.href = $acountURL;
              }
            });

          }
          function AppendEvent() {
            var acc = document.getElementsByClassName("accordion");
            var i;
            for (i = 0; i < acc.length; i++) {
              acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                  panel.style.maxHeight = null;
                } else {
                  panel.style.maxHeight = panel.scrollHeight + "px";
                }
              });
            }
          }
        var CustomerId = '{{customer.id}}';
        var Shop_id  = "<?=$shop_id?>";
        var SubscriptionURL = '<?=base_url()."ShopifyUser/SubscriptionsByCustomerId"?>';
        $.ajax({
          type: 'GET',
          url: SubscriptionURL,
          dataType: 'html',
          data: {customer_id:CustomerId,shop_id:Shop_id},
          success: function(res){
            $('.vw-subscriptions').html(res);
            AppendEvent();
          }
        });

        $(document).on('click','.CancellSubscription',function(){
          $subsctiptionId = $(this).data('subscription-id');
          swal({
            title: "Are you sure?",
            text: "If You Cancel the Subscription",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          }).then((willDelete) => {
            if (willDelete) {
              var SubscriptionURL = '<?=base_url()."ShopifyUser/CancelSusbscription?shop=$shop"?>';
              $.ajax({
                type: 'POST',
                url: SubscriptionURL,
                dataType: 'json',
                data: {subscription_id:$subsctiptionId},
                success: function(res){
                  swal("Cancelled", res.msg, "success");
                   location.reload();
                }
              });
            }
          });
        })
         </script>
        <?php
        $html = ob_get_clean();
       return $this->output->set_content_type('application/liquid')->set_status_header(200)->set_output($html);
    }

    public function CancelSusbscription()
    {
        $shop = $_GET['shop'];
        $stripeSKey = stripeKey($shop);
        \Stripe\Stripe::setApiKey($stripeSKey);
        $subscription_id = $_POST['subscription_id'];
        try {
          $sub   = \Stripe\Subscription::retrieve($subscription_id);
          $sub->cancel();
          $insert = $this->db->where(['stripe_subscription_id'=>$subscription_id])->update('tbl_stripe_subscription',['status'=>0]);
          $return =['code'=>200,'msg'=>"Subscription Cancelled Successfully"];
        } catch (\Exception $e) {
          $return =['code'=>100,'msg'=>"Something went Wrong Please Try Later"];
        }
        echo json_encode($return);
    }

    public function SubscriptionsByCustomerId()
    {
      $customer_id = $_GET['customer_id'];
      $shop_id = $_GET['shop_id'];
      $subscriptions  = $this->db->select('*')->where(['shop_id' => $shop_id,'shopiy_customer_id'=>$customer_id])->get('tbl_stripe_subscription')->result();
      foreach ($subscriptions as $k=>$subscription) {
          $items  = $this->db->select('order_json')->where(['tbl_subscription_id' => $subscription->id])->get('subscription_item_details')->row();
          $json_decode = json_decode($items->order_json);
            $draft_order = $json_decode->draft_order;
            $shippingAddress = $draft_order->shipping_address;

            foreach ($draft_order->line_items as  $line) {
              if(strpos($line->title, $subscription->bx_number) !== false){
                $item = $line;
              }
            }
            $contnet="";
            foreach ($item->properties as $prop) {
              if($prop->name == 'items'){
                $contnets = $prop->value;
              }
            }

            $status = (($subscription->status == 1) ?  'Active' : 'Cancelled');
            $dateString = '+'.$subscription->interval_frequency." ".$subscription->interval_type;
            $nextDate = date('M-d-Y', strtotime($dateString, strtotime($subscription->start_date)));
            $contnets = explode(',',$contnets);
            ob_start();
        ?>

          <button class="accordion"> Subscription <?=($k+1)?></button>
          <div class="panel">
              <div class="subscription-details-container">
                   <h3>
                     <span class="ro-translation ro-translation-subscription_title_one_product">
                       <?=$item->title?>
                     </span>
                   </h3>
                   <div class="next-order-date__container">
                     <b>
                       <span class="ro-translation ro-translation-next_order_date">Next Order Date</span>
                     </b>
                     <?=$nextDate;?>
                    <span  style="display:none;" class="text-button" role="presentation">&nbsp;
                       <span class="ro-translation ro-translation-change_order_date">Change date</span>
                   </span>
                 </div>
                  <span  style="display:none;" class="ro-translation ro-translation-order_prepaid_detail">
                      10 of 12 prepaid orders have been fulfilled.
                  </span>
                  <span  style="display:none;" class="ro-translation ro-translation-order_prepaid_renew_yes">
                      Will automatically renew once completed.
                  </span>
                  <span  style="display:none;" class="text-button" role="presentation">
                    <span class="ro-translation ro-translation-edit_button_text">Edit</span>
                  </span>
                   <div class="subscription-details-block-container">
                      <div class="flex-column flex-column-half">
                         <div class="subscription-details-block">
                            <p><span class="ro-translation ro-translation-products_list_heading">Box Contents</span></p>

                              <?php foreach ($contnets as $content) { ?>
                                  <p class="subscription-product-list-item">
                                    <span class="ro-translation ro-translation-product_without_variant_title">
                                    <?=$content?>
                                    </span>&nbsp;
                                  </p>
                              <?php }?>
                         </div>
                         <div class="subscription-details-block">
                            <p><span class="ro-translation ro-translation-shipping_info_heading">Shipping information</span></p>
                            <p><?=$shippingAddress->first_name?>  <?=$shippingAddress->last_name?> </p>
                            <p><?=$shippingAddress->address1?></p>
                            <p><?=$shippingAddress->city?> , <?=$shippingAddress->zip?></p>
                            <p><?=$shippingAddress->province?></p>
                            <p><?=$shippingAddress->country?></p>
                         </div>
                      </div>
                      <div class="flex-column flex-column-half">
                         <div class="subscription-details-block">
                            <p><span class="ro-translation ro-translation-order_frequency_heading">Order frequency</span></p>
                            <div>
                               <div>
                                 <span class="ro-translation ro-translation-order_frequency">Every <?=$subscription->interval_frequency?> <?=$subscription->interval_type?>(s)
                                 </span>
                                  &nbsp;
                                 <span style="display:none;" role="presentation" class="text-button">
                                   <span class="ro-translation ro-translation-change_frequency">
                                     Change frequency
                                   </span>
                                 </span>
                                 </div>
                            </div>
                         </div>
                         <div class="subscription-details-block">
                            <p>
                              <span class="ro-translation ro-translation-subscription_status_heading">
                                Subscription Status :
                              </span>
                            </p>
                            <span class="ro-translation ro-translation-active_subscription_status">
                              <?=$status?>
                            </span>
                              <?php
                              if($subscription->status == 1){ ?>
                                <button type="button" class="subscription-button msp__link">
                                  <span data-subscription-id="<?=$subscription->stripe_subscription_id?>" class="ro-translation ro-translation-pause_subscription_button_text CancellSubscription">
                                    Cancel Subscription</span>
                                  </button>
                            <?php  }
                              ?>
                         </div>
                      </div>
                   </div>
                </div>
          </div>
      <?php }
        $html = ob_get_clean();
        echo $html;
    }


  }
