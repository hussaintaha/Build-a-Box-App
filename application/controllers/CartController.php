<?php
   defined('BASEPATH') or exit('No direct script access allowed');
   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Methods: GET, POST');

   class CartController extends CI_Controller
   {
       public function __construct() {
           parent::__construct();
           $this->load->model('Global_model');
           $this->load->library('form_validation');
       }


       public function MyCart()
       {
           $shop = $_GET['shop'];
           $shop_id = shop_id($shop);
           ob_start();
                 ?>
              <link href="<?=base_url()."assets/storefront/style.css"?>" rel="stylesheet" type="text/css">
              <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
              <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" ></script>
              <script src="<?=base_url()."assets/storefront/moneyformat.js"?>"></script>
              <script>Shopify.money_format = "{{ shop.money_format }}";</script>
              <div class="loading">Loading&#8230;</div>
            <h2 class="vwheader-cart">My cart</h2>
            <div class="vw-gift-box-cart">
              {% if cart.item_count > 0 %}
               <div class="vwcart-innermain-wrapper">
                    <div class="vw-heading-itemlist">
                       <div class="left">Product</div>
                       <div class="right">Total</div>
                    </div>

                    <script>
                    var LinesByBxNumber={};
                    </script>
                    {% for item in cart.items %}
                        <script>
                          $box=[];
                        </script>
                      {% for property in item.properties %}
                        {% if property.first == '_bxnumber' %}
                            {% assign bnumber = property.last %}
                        {% endif %}

                        {% if property.first == 'items' %}
                            {% assign gifts = property.last | split:',' %}
                        {% endif %}

                        {% if property.first == '_images' %}
                            {% assign images = property.last | split:',' %}
                        {% endif %}

                        {% if property.first == '_msg' %}
                            {% assign msg = property.last  %}
                        {% endif %}

                        {% if property.first == '_variants' %}
                            {% assign variants = property.last | split:',' %}
                        {% endif %}

                        {% if property.first == '_pids' %}
                            {% assign pids = property.last | split:',' %}
                        {% endif %}
                        {% if property.first == '_prices' %}
                            {% assign prices = property.last | split:',' %}
                        {% endif %}
                        {% if property.first == '_types' %}
                            {% assign types = property.last | split:',' %}
                        {% endif %}

                      {% endfor %}

                      {% for gift in gifts %}
                          {% assign ng = forloop.index | minus: 1%}
                         <script>
                         $variantsDetails ="{{variants[ng]}}".split('_');
                         $gt ='{{gift}}'.split(' x');
                         $itemObj={};
                         $itemObj['pid'] = "{{pids[ng]}}";
                         $itemObj['variant'] = $variantsDetails[0];
                         $itemObj['box-image'] = "{{images[ng]}}";
                         $itemObj['title'] = $gt[0];
                         $itemObj['price'] = parseInt("{{prices[ng]}}");
                         $itemObj['productType'] = "{{types[ng]}}";
                         $itemObj['qty'] =  parseInt($variantsDetails[1]);
                         {% if forloop.last == true %}
                            $itemObj['msg'] = '{{msg}}'
                         {% endif %}
                         $box.push($itemObj);
                         </script>
                      {% endfor %}
                      <script>
                        LinesByBxNumber['{{bnumber}}'] = {products:$box,variant:'{{item.id}}'};
                      </script>

                      <div class="vwcart-inner">
                         <div class="vwcart-image">
                            <img src="{{ item.image | img_url: 'medium'  }}" class="vwgift-boxcart-item">
                            <div data-bx-number="{{bnumber}}"  data-line="{{forloop.index}}" class="clearvw-item removeBox">&#215;</div>
                         </div>


                         <div class="vwcart-items">
                            <div class="vwinner-vwcart">

                                <!--Main Product Title -->
                                <div class="vw-cart-gift-box">
                                   <div class="vw-left">
                                      <h5 class="vwcart-titles">BOX
                                         <a href="javascript(0);" data-bx-number="{{bnumber}}" class="box-link"  data-currentstep="1">swap box design &gt;</a>
                                      </h5>
                                      <p class="vw-boxid">{{item.product.title}}</p>
                                      <p class="vw-cart-qty">Qty: <span>{{item.quantity}}</span></p>
                                   </div>
                                   <div class="vw-right">
                                      <p class="cart-tems-total">{{item.price | money}}</p>
                                   </div>
                                </div>

                                <!--Box Gifts-->
                                <div class="vwitem-cart-gift">
                                   <h5 class="vwcart-titles">GIFTS
                                      <a data-bx-number="{{bnumber}}" href="javascript(0);" class="box-link"  data-currentstep="2" >add/remove items &gt;</a>
                                   </h5>
                                   {% for gift in gifts %}
                                      {% if forloop.first == false  and forloop.last == false %}
                                          {% assign gt = gift | split:'x'%}
                                            {% assign gindex = forloop.index | minus: 1%}
                                             <div class="vw-cart-item">
                                                <div class="vw-left">
                                                   <img src="{{images[gindex]}}" class="vwgift-boxitems">
                                                </div>
                                                <div class="vw-right">
                                                   <p class="vw-crat-title">{{gt[0]}}</p>
                                                   <p class="vw-item-cart-qty">Qty:<span>{{gt[1]}}</span></p>
                                                </div>
                                             </div>
                                         {% endif %}
                                    {% endfor %}
                                </div>


                                <!-- Gift Card -->
                                <div class="vwitem-cart-item">
                                   <h5 class="vwcart-titles">CARD
                                      <a data-bx-number="{{bnumber}}" href="javascript(0);"  class="box-link"  data-currentstep="3">edit message or swap card &gt;</a>
                                   </h5>
                                   {% for gift in gifts %}
                                      {% if forloop.last == true %}
                                          {% assign gt = gift | split:'x'%}
                                            {% assign gindex = forloop.index | minus: 1%}
                                              <div class="vw-cart-Card">
                                                 <div class="vw-left">
                                                    <img src="{{images[gindex]}}" class="vwgift-boxitems">
                                                 </div>
                                                 <div class="vw-right">
                                                    <p class="vw-crat-title">{{gt[0]}}</p>
                                                    <p class="vw-item-cart-qty">Qty:<span>{{gt[1]}}</span></p>
                                                    <div class="vw-cart-message">
                                                       <p class="vw-card-message">Message: <span>{{msg}}</span></p>
                                                    </div>
                                                 </div>
                                              </div>
                                            {% endif %}
                                    {% endfor %}
                                </div>

                            </div>
                          </div>
                       </div>
                       <?php if(CurrentActiveCheckout($shop_id) > 0){ ?>
                         <h2> Select Subscription Interval</h2>
                         <div style="width: 100%;display: flex;">
                          <div style="width:50%">
                               <p>Interval Type</p>
                             <select class="{{bnumber}}interval_type">
                               <option value="day">Days</option>
                               <option value="week">Week</option>
                               <option value="month">Month</option>
                             </select>
                         </div>
                         <div>
                           <p>Interval Frequency</p>
                           <input type="number" value="1" class="{{bnumber}}frequency_number">
                         </div>
                       </div>
                       <?php }?>

                    {% endfor %}



               </div>
               <div class="vwtotal-cart">
                  <div class="subtotal-wv-inner">
                     <div class="vw-sub-totalbox">
                        <div class="cart-wraper-vw">
                           <div class="vwsubtotal-text">
                              <p>Subtotal</p>
                           </div>
                           <div class="vw-subtotal-amount">
                              <p>{{cart.total_price | money}}</p>
                           </div>
                        </div>
                        <div class="vwsubtotal-rtr">
                           <p>Shipping & taxes calculated at checkout</p>
                        </div>
                     </div>
                     <a href="javascript(0);" class="vw-checkout-btn"> check out </a>
                  </div>
               </div>
               {% else %}

                  <h2>Empty Cart</h2>

                  <a href="/collections/all" class="btn">Continue Shopping</a>

                 {% endif%}
            </div>
        <script>
           $CurrentCheckout = parseInt('<?=CurrentActiveCheckout($shop_id)?>');
             function httpGet(theUrl){
               var xmlHttp = new XMLHttpRequest();
               xmlHttp.open("GET", theUrl, false);
               xmlHttp.send(null);
               return xmlHttp.responseText;
             }
             function ReturnLineIdFromKey($key){
               var CartDataGet = JSON.parse(httpGet('/cart.json'));
                 for(var it = 0; it < CartDataGet.items.length ; it++){
                     if(CartDataGet.items[it].key == $key){
                       return it+1;
                     }
                 }
             }
             $(document).on('click','.box-link',function(evt){
               evt.preventDefault();
               $step = $(this).data('currentstep');
               $bxNubmer = $(this).data('bx-number');
               if($step == 1){
                 swal({
                   title: "Are you sure?",
                   text: "If you want to change the box then all the gifts inside box will get removed first",
                   icon: "warning",
                   buttons: true,
                   dangerMode: true,
                   }).then((willDelete) => {
                       if (willDelete) {
                           $allLines = LinesByBxNumber[$bxNubmer].products;
                           for (var i = 0; i < $allLines.length; i++) {
                             if($allLines[i].productType == 'gift'){
                                 delete $allLines[i];
                             }
                           }
                           $allLines = $allLines.filter(function (el){
                             return el != null;
                           });
                         localStorage.setItem("BoxContents",JSON.stringify($allLines));
                         localStorage.setItem("step",JSON.stringify($step));
                         localStorage.setItem("line_id",JSON.stringify(LinesByBxNumber[$bxNubmer].variant));
                         window.location.href = '/apps/builder/build-your-box';
                       }
                   });
               }else{
                 $allLines = LinesByBxNumber[$bxNubmer].products;
                 localStorage.setItem("BoxContents",JSON.stringify($allLines));
                 localStorage.setItem("step",JSON.stringify($step));
                 localStorage.setItem("line_id",JSON.stringify(LinesByBxNumber[$bxNubmer].variant));
                 window.location.href = '/apps/builder/build-your-box';
               }
             })
             function RemoveItemsFromcart(array){
               Shopify.queue = array;
               Shopify.moveAlong = function() {
                 if (Shopify.queue.length) {
                   var request = Shopify.queue.shift();
                   $.ajax({
                     type: 'POST',
                     url: '/cart/change.js',
                     dataType: 'json',
                     data: {quantity:0,line : ReturnLineIdFromKey(request) },
                     success: function(res){
                       Shopify.moveAlong();
                     },error: function(){
                       if (Shopify.queue.length){
                         Shopify.moveAlong()
                       }
                     }
                   });
                 }else{
                     $('.loading').hide();
                     swal("Removed", "Your Box Contents Removed From Cart", "success");
                     window.location.href = '/apps/builder/cart';
                 }
               };
               Shopify.moveAlong();
             }


             $(document).on('click','.clearvw-item',function(){
               if($(this).hasClass('removeBox')){
                 swal({
                   title: "Are you sure?",
                   text: "Once removed, Box Items will not be able to available longer in the cart",
                   icon: "warning",
                   buttons: true,
                   dangerMode: true,
                 }).then((willDelete) => {
                   if (willDelete) {
                     $('.loading').show();
                     $line = $(this).data('line');
                     $.ajax({
                         type: 'POST',
                         url: '/cart/change.js',
                         dataType: 'json',
                         data: {quantity:0,line :$line },
                         success: function(res){
                           swal("Removed", "Item Removed From cart", "success");
                           window.location.href = '/apps/builder/cart';
                         }
                       })
                   }
                 });
               }
             });



             function ReturnCheckoutURL(){
              var ga_linker = "";
              var myshopify_domain = window.Shopify.shop;
              var customer_param = '{% if customer %}customer_id={{customer.id}}&customer_email={{customer.email}}{% endif %}';
              var CartDataGet = JSON.parse(httpGet('/cart.json'));
              var token =  CartDataGet.token;
              return  "https://checkout.rechargeapps.com/r/checkout?myshopify_domain=" + myshopify_domain + "&cart_token=" + token + "&" + ga_linker + "&" + customer_param;
             }


             function AddArrayItem(array){
               Shopify.queue = array;
               Shopify.moveAlong = function() {
                 if (Shopify.queue.length) {
                   var request = Shopify.queue.shift();
                   $.ajax({
                     type: 'POST',
                     url: '/cart/add.js',
                     dataType: 'json',
                     data: request,
                     success: function(res){
                       Shopify.moveAlong();
                     },error: function(){
                       if (Shopify.queue.length){
                         Shopify.moveAlong()
                       }
                     }
                   });
                 }else{
                    $('.loading').hide();
                     switch ($CurrentCheckout){
                       case 0:
                        window.location.href = '/checkout';
                         break;
                       case 1:
                        window.location.href = '/apps/builder/checkout';
                         break;
                       case 2:
                        window.location.href = ReturnCheckoutURL();
                         break;
                       default:
                       window.location.href = '/checkout';
                     }
                 }
               };
               Shopify.moveAlong();
             }

            function FindVariantsToBeAdded(mainProducts){
                var SaveURL = '<?=base_url()."Subscription/FindMappingVariant?shop=".$shop?>';
                $.ajax({
                  type: 'POST',
                  url: SaveURL,
                  dataType: 'json',
                  data: {cartData:JSON.stringify(mainProducts)},
                  success: function(res){
                    var AddArray=[];
                    for(p in res.data){
                      var Data = {id :res.data[p],quantity :1 , properties : {"shipping_interval_unit_type": "month","shipping_interval_frequency": "1"}};
                      AddArray.push(Data);
                    }

                      $.ajax({
                      type: 'GET',
                      url: '/cart/clear.js',
                      'dataType' : 'json',
                      success: function(crt){
                          AddArrayItem(AddArray);
                        }
                      });
                  }
                });
             }


             function SyncOrder(page,array){
                 var totalPage=array.length;
                if(totalPage >0){
                  setTimeout(function(){
                    SYNC(array[page],page,totalPage,array)
                  }, 3000);
                }
             }

             function SYNC($url,page,totalPage,array){
                 if(page < totalPage){
                    $.ajax({
                     type : 'GET',
                     url:  $url,
                     success: function(data){
                       page++;
                       SyncOrder(page,array);
                     }
                    });
                  }else{
                    console.log(window.main_products,"Find Recharge Variants")
                    setTimeout(function(){
                      FindVariantsToBeAdded(window.main_products);
                    },(window.main_products.length * 3000))
                  }
             }


             function SubscribeIndividual(array,$products){
                var page = 0,totalPage=array.length;
                 SyncOrder(page,array);
                 window.main_products = $products;
             }
             function SubscribeProducts(mainProducts){
               $newURL = '<?=base_url()."Subscription/AttachSingleProductToRuleSet?shop=".$shop?>';
               $atttachURLS =[];
               for ($p = 0; $p < mainProducts.length; $p++){
                  $atttachURLS.push($newURL+'&pid='+mainProducts[$p]);
               }
               SubscribeIndividual($atttachURLS,mainProducts);
             }



             function RechargeCheckoutFunction() {
               $('.loading').show();
                var SaveURL = '<?=base_url()."Subscription/CreateSubscriptionProduct?shop=".$shop?>';
                $.ajax({
                  type: 'POST',
                  url: SaveURL,
                  dataType: 'json',
                  data: {cartData:JSON.stringify(LinesByBxNumber)},
                  success: function(res){
                    setTimeout(function(){
                      SubscribeProducts(res.pids)
                    },(res.pids.length * 1500))
                  }
                });
             }




             function CreateStripeSubscription(){
                 window.location.href = '/apps/builder/checkout';
             }
             $('.vw-checkout-btn').on('click',function(evt){
               evt.preventDefault();
               switch ($CurrentCheckout) {
                 case 0:
                  window.location.href = "/checkout";
                   break;
                 case 1:
                  CreateStripeSubscription();
                   break;
                 case 2:
                  // RechargeCheckoutFunction();
                   break;
                 default:

               }
             });
        </script>
        <?php
          $html = ob_get_clean();
          return $this->output->set_content_type('application/liquid')->set_status_header(200)->set_output($html);
        }
}
