<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
class StoreFront extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Global_model');
        $this->load->library('form_validation');
    }
    public function ProductsCount($shop)
    {
      $shopAccess=getShop_accessToken_byShop($shop);
      $this->load->library('Shopify', $shopAccess);
      return $this->shopify->call(['METHOD' => 'GET', 'URL' =>'/admin/products/count.json']);
    }


    public function BuildYourBox()
    {
        $shop = $_GET['shop'];
        $shop_id = shop_id($shop);
        $productCount = $this->ProductsCount($shop)->count;
        $boxes= $this->db->select('*')->from('tbl_box')->where(['shop_id'=>$shop_id,'status'=>1])->get()->result();
        $cards= $this->db->select('*')->from('tbl_card')->where(['shop_id'=>$shop_id,'status'=>1])->get()->result();
        ob_start();
        ?>
        <link href="<?=base_url()."assets/storefront/style.css"?>" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
        <script src="<?=base_url()."assets/storefront/moneyformat.js"?>"></script>
        <script>Shopify.money_format = "{{ shop.money_format }}";</script>
        <div class="loading">Loading&#8230;</div>
        <style>
        .selectedCard{
          border: 1px solid black;
        }
        .vwbar__arrow--next3{
          background: #4285f4;
          color: #fff;
          padding: 15px 20px;
          margin-left: 10px;
        }
        </style>
        <script>var ExcludeProducts=[];</script>
          <div class="VWbox__container" id="vwc" data-count="<?=$productCount?>">
           <div class="VWbox VWbox__main-vwProd-page">
              <div class="vwbar__container">
                 <div class="vwbar">
                    <div class="VWSteps">
                       <div class="VWSteps_inner">
                          <ul class="VWstepper VWstepper-horizontal">
                             <li class="Step_1 active">
                                <a href="#!">
                                   <span class="circle">1 </span>
                                   <span class="label">First step </span>
                                   <div class="icon_img"><img src="<?=base_url()."assets/storefront/step1.png"?>"></div>
                                </a>
                             </li>
                             <li class="Step_2">
                                <a href="#!">
                                   <span class="circle">2</span>
                                   <span class="label">Second step</span>
                                   <div class="icon_img"><img src="<?=base_url()."assets/storefront/step2.png"?>"></div>
                                </a>
                             </li>
                             <li class="Step_3">
                                <a href="#!">
                                   <span class="circle">3</span>
                                   <span class="label">Third step</span>
                                   <div class="icon_img">
                                     <img src="<?=base_url()."assets/storefront/step3.png"?>"></div>
                                </a>
                             </li>
                          </ul>
                       </div>
                    </div>
                 </div>
                 <div class="vwbar__description">
                         <div class="vwbar__arrows">
                             <button class="vwbar__arrow vwbar__arrow--prev vwbar__arrow--disabled">
                                 Prev
                             </button>
                             <button class="vwbar__arrow vwbar__arrow--prev2" style="display: none;">
                                 Prev
                             </button>
                             <button class="vwbar__arrow vwbar__arrow--next vwbar__arrow--disabled">
                                 Next
                             </button>
                             <button class="vwbar__arrow vwbar__arrow--next2" style="display: none;">
                                 Next
                             </button>
                              <button class="vwbar__arrow vwbar__arrow--next3" style="display: none;">
                                 Add To cart
                             </button>
                         </div>
                         <h3>
                             Select the design that's perfect for your giftee.
                         </h3>
                         <p>
                             Once you've chosen a design, you can start selecting their gifts!
                         </p>
                </div>
              </div>
              <div class="VWbox__main vwbox_main">


                <div class="vwmobileview-tabcart" >
                   <div id="vwflip" class="vwflip-row">
                      <h5 class="vwcart-headindmob">
                        <span class="vw-drawer-item-total">
                        Your Happy Box Subtotal: <span class="bxsubtotal"></span>
                      </span><span class="itemcount"></span>
                    </h5>
                   </div>
                     <div id="vwpanel" class="vwflip-box" style="display: none;">
                      <div class="vw-pannelmob-inner">
                       <div class="vwdrawer-inner">
                       <div class="bxContents">
                       </div>
                     </div>
                   </div>
                  </div>
                </div>



                 <div class="VWbox__page VWboxtab__page vwboxtabone-active VWbox__page--mainvwProds VWTABS" id="BoxSelection">
                    <ul class="VWbox__main-vwProds">
                       <?php
                          foreach ($boxes as $box) {
                              $variants = explode(',',$box->shopify_variant_ids);
                              $bxProducts= $this->db->select('*')->from('box_products')->where(['bx_id'=>$box->id])->get()->result();
                              $productJson = json_decode($box->product_json);
                             ?>
                       <li>
                         <script>ExcludeProducts.push('<?=$box->shopify_product_id?>');</script>
                          <div class="vwProd vwProd--main">
                             <img class="vwProd__image lazy" data-original="<?=$productJson->images[0]->src?>">
                             <button data-pid="<?=$box->shopify_product_id?>"  data-variant="<?=$variants[0]?>"    data-box-image="<?=$box->bx_before_image?>"     data-title="<?=$box->bx_title?>"  data-price="<?=$box->bx_price*100?>" data-json="<?=urlencode(json_encode($box))?>"   data-products="<?=urlencode(json_encode($bxProducts))?>" type="button"     class="vwProd__button SelectBox"  >Start Building</button>
                             <div class="vwProd__image vwProd__image--alt"
                             style='background-image: url("<?=$productJson->images[1]->src?>");'
                             >
                             </div>
                          </div>
                       </li>
                       <?php }
                          ?>
                    </ul>
                 </div>
                 <div class="VWbox__page VWboxtab__page VWbox__page--addonvwProds VWTABS" id="GiftSelection"  style="display: none;">
                    <div class="VWFilter__row" style="display:none;">
                       <div class="VWFilter__VWFilters">
                          <div class="VWFilter__wrapper">
                             <select class="VWFilter Ptags">
                             </select>
                          </div>
                       </div>
                       <span class="VWFilter__count GiftsFiltered">Showing 4 gifts</span>
                    </div>
                    <div class="vw-wrap-item-drawer">
                       <ul class="VWbox__addon-vwProds SelectableProducts">

                       </ul>
                    </div>
                 </div>
                 <div class="VWBox VWboxtab__page VWBox--cardvwProds VWTABS" id="CardSelection" style="display: none;" >
                    <div class="VWFilter__row">
                       <div class="VWFilter__VWFilters">
                          <div class="VWFilter__wrapper">
                             <select class="VWFilter" style="display:none;">
                                 {% for tag in collections.all.tags %}
                                   {% if tag !='OPTIONS_HIDDEN_PRODUCT' or tag !='Recommendations disabled' %}
                                     <option value="{{ tag | handle }}">{{ tag }}</option>
                                   {% endif%}
                                 {% endfor %}
                             </select>
                          </div>
                       </div>
                       <span class="VWFilter__count">Showing <?=count($cards);?> Cards</span>
                    </div>
                    <div class="vw-wrap-item-drawer">
                       <div class="vwbox-card">
                          <ul class="VWBox-vwProds">
                            <?php foreach ($cards as $card) {
                                $variants = explode(',',$card->shopify_variant_ids);
                                  ?>
                                   <script>ExcludeProducts.push('<?=$card->shopify_product_id?>');</script>
                                  <li>
                                    <div class="vwProd vwProd--card cardId<?=$card->shopify_product_id?>">
                                      <div class="vwProd__hover-container">
                                        <div class="vwProd__image-container">
                                          <img class="vwProd__image" src="<?=$card->card_before_image?>">
                                          <div class="vwProd__image vwProd__image--alt" style='background-image: url("<?=$card->card_after_image?>");'>
                                          </div>
                                        </div>
                                        <button  data-pid="<?=$card->shopify_product_id?>"   data-box-image="<?=$card->card_before_image?>"     data-box-after="<?=$card->card_after_image?>"    data-title="<?=$card->card_title?>"   data-price="<?=$card->card_price*100?>"   data-variant="<?=$variants[0]?>"      class="vwProd__button select_card" type="button" >Select Card</button>
                                      </div>
                                      <p class="vwProd__title"><?=$card->card_title?></p>
                                        {%- assign gift_price = "<?=($card->card_price*100); ?>"-%}
                                        <span class="vwProd__price">{{gift_price | money }}</span>
                                        <div class="vwProd vwProd--card">
                                      </div>
                                    </div>
                                  </li>
                            <?php }?>
                          </ul>
                       </div>
                    </div>
                 </div>

                 <div id="vwscrollsidebar">
                 <div id="vw-mySidenav" class="vwsidenav" style="display: none;">
                    <div class="vwdrawer-inner">
                       <h2 class="vw-drawer-title"> Your Happy Box</h2>
                       <p class="vw-drawer-item-total">Subtotal:<span class="bxsubtotal"></span></p>
                       <div class="bxContents">
                       </div>
                       <button style="margin-top: 11%;display:none;" type="button" class="btn addtoCartBox">Add To Cart</button>
                    </div>
                 </div>
                </div>
              </div>
           </div>
        </div>



        <div class="Custom_popup" style="display: none;">
         <div class="Custom_popup_body" style="margin-top:5%">
            <div class="VWPopup_Inner_content">
               <div class="close__">
                 <i class="fas fa-times"></i>
               </div>
               <div class="VWPopup_image_container">
                  <img class="VWpopup_image" src="https://amkwebsolutions.com/shopify-app/gift_wrap_app/assets/images/1589120713377.png"/>
               </div>
               <div class="VWpopup_text">
                  <h3 class="VWpopup_heading">
                     <img alt="" class="VWpopup_step_image" src="<?=base_url()."assets/storefront/step3.png"?>" >
                     <span>Write your card</span>
                  </h3>
                  <p class="VWpop_body">
                     Your message will be handwritten by our team. Please make sure you wrote everything as you'd like it to appear.
                     Don't forget to sign your card!
                  </p>
                  <span>Characters remaining: <span class="remaing_chars">100</span></span>
                  <textarea class="VWpop_up_text_area" cols="30" maxlength="100" name="message" placeholder="Up to 100 characters" rows="3"></textarea>
                  <div class="VWpopup_input_contain">
                     <input class="VWpopUpCheckbox" id="VWpop_upBlankCard" name="BlankCard" type="checkbox">
                     <label for="VWpop_upBlankCard">Click here if you want your card blank</label>
                  </div>
                  <button type="button" class="VWpopUp_button">Back</button>
                  <button type="button" class="VWpop_up_save" >Save</button>
               </div>
            </div>
         </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js" type="text/javascript"></script>
        <script>
          function CheckIfAdded(pid){
            if(localStorage.getItem("BoxContents")){
              var OldArray = JSON.parse(localStorage.getItem("BoxContents"));
                for (var bx = 0; bx < OldArray.length; bx++) {
                  if(OldArray[bx].pid == pid){
                  return {sr_no : bx,box : OldArray[bx]};
                }
              }
            }
          }

        $("img.lazy").lazyload();

          function ReturnAddonHTML(Product){
            var Check = CheckIfAdded(Product.id);
            var HTML ="";
            HTML +='<li>';
            HTML +='<div class="vwProd vwProd--addon">';
            HTML +='<div class="vwProd__hover-container container'+Product.id+'" >';
            HTML +='<div class="vwProd__image-container '+(Check ? 'vw-itm-img-active' : "")+'">';
            HTML +='<span class="vwProd__quantity-added"  style="'+((!Check) ? "display:none;" : "")+'">'+(Check ? Check.box.qty : "")+'</span>';
            HTML +='<img class="vwProd__image" src="'+Product.images[0].src+'">';
            HTML +='<div class="vwProd__image vwProd__image--alt" style="background-image: url('+Product.images[0].src+');">';
            HTML +='</div>';
            HTML +='</img>';
            HTML +='<div class="vwitm-qty-box" style="'+((!Check) ? "display:none;" : "")+'">';
            HTML +='<div class="vwitem__quantity vw-item-qty-active">';
            HTML +='<button  type="button" class="vwitem__quantity-btn minus" data-pid="'+Product.id+'">-</button>';
            HTML +='<span class="vwitem__quantity-status">'+(Check ? Check.box.qty : "")+' in box</span>';
            HTML +='<button  type="button" class="vwitem__quantity-btn plus" data-pid="'+Product.id+'">+</button>';
            HTML +='</div>';
            HTML +='</div>';
            HTML +='</div>';
            HTML +='<div class="vwProd__button-container">';
            HTML +='<button style="'+((Check) ? "display:none;" : "")+'"  data-pid="'+Product.id+'"  data-title="'+Product.title+'"  data-price="'+(parseInt(Product.variants[0].price)*100)+'" data-variant="'+Product.variants[0].id+'" data-box-image="'+Product.images[0].src+'" type="button" class="vwProd__add-btn">  Add To Box</button>';
            HTML +='</div>';
            HTML +='</div>';
            HTML +='</div>';
            HTML +='<p class="vwProd__title">'+Product.title+'</p>';
            HTML +='<span class="vwProd__price">'+Shopify.formatMoney(Product.variants[0].price,Shopify.money_format)+'</span>';
            HTML +='</div>';
            HTML +='</li>';
            return HTML;
          }
          $(document).on('change','.Ptags',function(){
              var SelectedTag = $(this).val();
              AddProductsToHomePage(SelectedTag);
          });

         $(document).on('click','.SelectBox',function(){
              $('.SelectBox').html('Start Building');
              $('.loading').show();
               var datas = ['pid','variant','box-image','title','price'],
                   BxData = JSON.parse(decodeURIComponent($(this).data('json'))),
                   ItemObject = {};
                switch (BxData.gift_selection_basis){
                  case 'product':
                    var BxProducts = JSON.parse(decodeURIComponent($(this).data('products')));
                    SelectBoxProducts(BxProducts)
                    break;
                  case 'collection':
                    ShowProductOnTheBasisOfCollection(BxData.select_collection);
                    break;
                  case 'tag':
                    CreateTagsHtml(BxData.select_tags.split(','))
                    break;
                  default:

                }
               var bx_contents_based_on_product = parseInt(BxData.bx_contents_based_on_product);
               var bx_contents_based_on_bx_amt = parseInt(BxData.bx_contents_based_on_bx_amt);
               if(bx_contents_based_on_product == 1){
                 window.productCount = parseInt(BxData.bx_max_no_products)
               }else{
                  window.productCount = null;
               }
               if(bx_contents_based_on_bx_amt == 1){
                 window.bxAmt = parseInt(BxData.bx_max_amt)
               }else{
                  window.bxAmt = null;
               }
               for (var key = 0; key < datas.length; key++){
                 ItemObject[datas[key]] = $(this).data(datas[key]);
               }
               ItemObject['productType'] = 'box';
               ItemObject['qty'] = 1;
              if(!localStorage.getItem("BoxContents")){
                PushItemsInBox([],ItemObject);
              }else{
                if(CheckIfBoxAdded()){
                  if(CheckIfBoxAdded().box != ItemObject.pid){
                    var OldArray = JSON.parse(localStorage.getItem("BoxContents"));
                    OldArray[CheckIfBoxAdded().sr_no] = ItemObject;
                    localStorage.setItem("BoxContents",JSON.stringify(OldArray));
                  }
                }else{
                  var OldArray = JSON.parse(localStorage.getItem("BoxContents"));
                  PushItemsInBox(OldArray,ItemObject);
                }
              }
          $(this).html('Selected')
          $('#BoxSelection').hide();
          $('#GiftSelection,#vw-mySidenav').show();
          RenderDrawerItems();
          $('#vwscrollsidebar').show();
        });

          function GenerateOtherHtml(BxData,$otherProducts) {
            switch (BxData.gift_selection_basis){
              case 'product':
                SelectBoxProducts($otherProducts)
                break;
              case 'collection':
                ShowProductOnTheBasisOfCollection(BxData.select_collection);
                break;
              case 'tag':
                CreateTagsHtml(BxData.select_tags.split(','))
                break;
              default:
            }
          }
         if(localStorage.getItem("BoxContents")){
            $getStep = JSON.parse(localStorage.getItem("step"));
            $pid = CheckIfBoxAdded().box.pid;
            window.remove = JSON.parse(localStorage.getItem('line_id'));
            var BxData = JSON.parse(decodeURIComponent($('[data-pid='+$pid+']').data('json')));
            $otherProducts = JSON.parse(decodeURIComponent($('[data-pid='+$pid+']').data('products')));
               switch ($getStep) {
                 case 1:
                  $('[data-pid='+$pid+']').text("selected");
                   break;
                 case 2:
                    $('[data-pid='+$pid+']').click();
                    $('.vwbar__arrow--prev,.vwbar__arrow--next2').removeClass('vwbar__arrow--disabled');
                    $('.vwbar__arrow--next').hide();
                    $('.vwbar__arrow--next2').show();
                   break;
                 case 3:
                  $('.VWTABS').hide();
                  $('#CardSelection,#vw-mySidenav').show();
                  $('.vwbar__arrow--prev,.vwbar__arrow--next').hide();
                  $('.vwbar__arrow--prev2,.vwbar__arrow--next3').show();
                  RenderDrawerItems();
                   break;
                 default:
               }
                $('.loading').hide();
         }else{
           localStorage.removeItem("BoxContents");
         }


          function CheckIfBoxAdded(){
            if(localStorage.getItem("BoxContents")){
              var OldArray = JSON.parse(localStorage.getItem("BoxContents"));
                for (var bx = 0; bx < OldArray.length; bx++) {
                  if(OldArray[bx].productType == 'box'){
                    return {sr_no : bx,box : OldArray[bx]};
                }
              }
            }
          }
          function PushItemsInBox(bxArray,obj){
            bxArray.push(obj);
            localStorage.setItem("BoxContents",JSON.stringify(bxArray));
          }

          function ReturnHtmlForBoxDrawer(product){
              var TotalForItem = product.price*product.qty;
              var Items ='<div class="vw-boxitems">';
              if(product.productType !='box' &&  product.productType !='card' ){
                Items+='<div class="vw-itemremove-btn" data-pid="'+product.pid+'"><i class="fas fa-times"></i></div>';
              }
              Items+='<div class="vw-gift-item-img">';
              Items+='<img src="'+product['box-image']+'" class="gift-boxselectedvw-img">';
              Items+='</div>';
              Items+='<div class="vw-giftitem-title">';
              Items+='<p class="vw-gift-item-title">'+product.title+'</p>';
              if(product.productType != 'card'){
                Items+='<p class="vw-giftitem-qty">Qty: <span class="vw-qty">'+product.qty+'</span></p>';
              }
              Items+='<span class="vw-giftitem-price">'+Shopify.formatMoney(TotalForItem,Shopify.money_format)+'</span>';
              if(product.productType == 'card'){
                Items+='<button class="BuildSummary__edit editcard">Edit</button>';
              }
              Items+='</div>';
              Items+='</div>';
              return Items;
          }



          function RenderDrawerItems(){
            var NewArray = JSON.parse(localStorage.getItem("BoxContents"));
            $html = "";
            $allTotal = 0;
            $cardCount = 0;
            for (var bx = 0; bx < NewArray.length; bx++) {
              $html+=ReturnHtmlForBoxDrawer(NewArray[bx]);
               $allTotal = $allTotal + (NewArray[bx].price*NewArray[bx].qty);
               if(NewArray[bx].productType == 'card'){
                 $cardCount =  $cardCount +1
               }
            }
            $('.bxContents').html($html);
            $('.vw-drawer-item-total .bxsubtotal').html(Shopify.formatMoney($allTotal,Shopify.money_format));
            $('.itemcount').html('( items '+NewArray.length+')');
            $('.addtoCartBox').hide()
            if($cardCount > 0){
              $('.addtoCartBox').show()
            }

            if(CheckIfCardAdded()){
              $cardAdded =CheckIfCardAdded().box
              $('.vwProd--card').removeClass('selectedCard')
              $('.select_card').text('select card')
              $('.cardId'+$cardAdded.pid).addClass('selectedCard');
              $('.cardId'+$cardAdded.pid).find('.select_card').text('selected card');
            }
          }
            function addAllItemsNew(array){
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
                    localStorage.removeItem("BoxContents");
                    window.location.href = '/apps/builder/cart';
                }
              };
              Shopify.moveAlong();
            }

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


            function RemoveItemsFromcart(array,$newArray){
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
                  localStorage.removeItem("step");
                  localStorage.removeItem("lines");
                  addAllItemsNew($newArray);
                }
              };
              Shopify.moveAlong();
            }

            function AddBuildedBoxToCart($addObj){
              $.ajax({
                type: 'POST',
                url: '/cart/add.js',
                dataType: 'json',
                data: $addObj,
                success: function(res){
                  $('.loading').hide();
                  localStorage.removeItem("BoxContents");
                  localStorage.removeItem("step");
                  localStorage.removeItem("lines");
                  window.location.href = '/apps/builder/cart';
                }
              });
            }

         $(document).on('click','.addtoCartBox',function(){
           $('.loading').show();
            $bxobject={};
            var NewArray = JSON.parse(localStorage.getItem("BoxContents")),BXID = Math.floor(100000 + Math.random() * 900000),AllItems = [];
            for (var bx = 0; bx < NewArray.length; bx++){
              AllItems.push(NewArray[bx]);
            }
            $bxobject[BXID]={'products':AllItems};
            var SaveURL = '<?=base_url()."Subscription/CreateShopifyBoxProductForCustomer?shop=".$shop?>';
            $.ajax({
              type: 'POST',
              url: SaveURL,
              dataType: 'json',
              data: {cartData:JSON.stringify($bxobject)},
              success: function(res){
                if(res.data.hasOwnProperty(BXID)){
                  $variantId = res.data[BXID].variants[0];
                  $bxContents=$bxobject[BXID].products;
                  $Items = "",$variants = "",$images="",$Props={},$msg="",$pid="",$prices="",$types="";
                  for (var p = 0; p < NewArray.length; p++){
                     $prd = NewArray[p];
                     if(p > 0){
                       $Items+=','+$prd.title+' x  '+$prd.qty;
                       $images+=','+$prd['box-image'];
                       $pid+=','+$prd['pid'];
                       $prices+=','+$prd['price'];
                       $types+=','+$prd['productType'];
                       $variants+=','+$prd.variant+'_'+$prd.qty;
                     }else{
                       $types+=$prd['productType'];
                       $prices+=$prd['price'];
                       $pid+=$prd['pid'];
                       $variants+=$prd.variant+'_'+$prd.qty;
                       $Items+=$prd.title+'  x '+$prd.qty;
                       $images+=$prd['box-image'];
                     }
                     if($prd.productType =='card'){
                       $msg = $prd.msg
                     }
                  }
                  $Props['items'] =$Items;
                  $Props['_images'] =$images;
                  $Props['_bxnumber'] =BXID;
                  $Props['_variants'] =$variants;
                  $Props['_msg'] =$msg;
                  $Props['_pids'] =$pid;
                  $Props['_prices'] = $prices;
                  $Props['_types'] = $types;
                  $addObj = { id :$variantId,quantity : 1 , properties : $Props };
                  if(window.remove){
                    $removeId=window.remove;
                    $upd = 'updates['+$removeId+']=0';
                      $.ajax({
                        type: 'POST',
                        url: '/cart/update.js',
                        dataType: 'json',
                        data:$upd,
                        success: function(crt){
                          AddBuildedBoxToCart($addObj);
                        }
                      })
                  }else{
                      AddBuildedBoxToCart($addObj);
                  }
                }
              }
            })


         });
         $(document).on('click','.vw-itemremove-btn',function(){
            var Check = CheckIfAdded($(this).data('pid'));
            $Parent = $('.container'+$(this).data('pid'));
            var OldArray = JSON.parse(localStorage.getItem("BoxContents"));
            delete OldArray[Check.sr_no];
            OldArray = OldArray.filter(function (el){
              return el != null;
            });
            localStorage.setItem("BoxContents",JSON.stringify(OldArray));
            $Parent.find('.vwitm-qty-box').hide();
            $Parent.find('.vwProd__add-btn').show();
            $Parent.removeClass('vw-itm-img-active');
            $Parent.find('.vwProd__quantity-added').html("").hide();
            RenderDrawerItems();
         });

         $(document).on('click','.vwitem__quantity-btn',function(){
           var Check = CheckIfAdded($(this).data('pid'));
           $oldQty = Check.box.qty;
           if($(this).hasClass('minus')){
             $newQty = $oldQty-1;
           }else{
             $newQty = $oldQty+1;
           }
           var OldArray = JSON.parse(localStorage.getItem("BoxContents"));
           if($newQty > 0){
               var NewObject = Check.box;
               NewObject['qty'] = $newQty;
               OldArray[Check.sr_no] = NewObject;
               var PID = $(this).data('pid');
                $allTotal = 0,$giftsCount=0;
                $bxArray = JSON.parse(localStorage.getItem("BoxContents"));
                for (var bx = 0; bx < $bxArray.length; bx++) {
                    if($bxArray[bx].productType == 'gift' && $bxArray[bx].pid != PID){
                      $allTotal = $allTotal+($bxArray[bx].qty*$bxArray[bx].price);
                      $giftsCount = $giftsCount+$bxArray[bx].qty
                    }
                }
              $conditionCheck = CheckConditions();
              $CheckCartAmonut = $allTotal + ($newQty * NewObject.price);
              $CheckCartCount = $giftsCount + $newQty;
              var CheckAmt = window.bxAmt*100;
              var CheckCount = window.productCount;
              var disable = false;
             if($conditionCheck.check){
                switch ($conditionCheck.condition){
                  case 'product':
                     if($CheckCartCount > CheckCount){
                       disable = true;
                     }
                    break;
                  case 'amt':
                     if($CheckCartAmonut > CheckAmt){
                         disable = true;
                     }
                    break;
                   case 'both':
                     if($CheckCartCount > CheckCount  || $CheckCartAmonut > CheckAmt){
                       disable = true;
                     }
                   break;
                  default:
                }
              }
            if(!disable){
              localStorage.setItem("BoxContents",JSON.stringify(OldArray));
              $(this).parents('.vwProd__hover-container').find('.vwitem__quantity-status').html( $newQty+' in box');
              $(this).parents('.vwProd__hover-container').find('.vwProd__quantity-added').html($newQty).show();
            }else{
               swal("Limit Reached", "Product Limit For the  Box", "error");
              return false;
            }

           }else{
             delete OldArray[Check.sr_no];
             OldArray = OldArray.filter(function (el){
               return el != null;
             });
             localStorage.setItem("BoxContents",JSON.stringify(OldArray));
             $(this).parents('.vwitm-qty-box').hide();
             $(this).parents('.vwProd__hover-container').find('.vwProd__add-btn').show();
             $(this).parents('.vwProd__hover-container').removeClass('vw-itm-img-active');
             $(this).parents('.vwProd__hover-container').find('.vwProd__quantity-added').html("").hide();
           }
            RenderDrawerItems();
         });

          function ReturnCheckedData(){
           var NewArray = JSON.parse(localStorage.getItem("BoxContents"));
           $allTotal = 0,$giftsCount=0;
            for (var bx = 0; bx < NewArray.length; bx++) {
                if(NewArray[bx].productType == 'gift'){
                  $allTotal = $allTotal+(NewArray[bx].qty*NewArray[bx].price);
                  $giftsCount = $giftsCount+NewArray[bx].qty
                }
            }
            return {'total':$allTotal,'count':$giftsCount};
          }

          function CheckAddDisabled(ItemPrice){
              var Check = CheckConditions(),
                  disable = false,
                  CheckAmt = window.bxAmt*100,
                  CheckCount = window.productCount;
              if(Check.check){
                switch (Check.condition){
                  case 'product':
                     var ProductCount = (ReturnCheckedData().count+1);
                     if(ProductCount > CheckCount){
                       disable = true;
                     }
                    break;
                  case 'amt':
                     var CartTotal = ReturnCheckedData().total + ItemPrice;
                     if(CartTotal > CheckAmt){
                         disable = true;
                     }
                    break;
                   case 'both':
                     var CartTotal = ReturnCheckedData().total + ItemPrice;
                     var ProductCount = (ReturnCheckedData().count+1);
                     if(ProductCount > CheckCount  || CartTotal > CheckAmt){
                       disable = true;
                     }
                   break;
                  default:
                }
              }
            return disable;
          }
         $(document).on('click','.vwProd__add-btn',function(){
           var datas = ['pid','variant','box-image','title','price'],ItemObject = {};
           for (var key = 0; key < datas.length; key++) {
             ItemObject[datas[key]] = $(this).data(datas[key]);
           }
           ItemObject['productType'] = 'gift';
           ItemObject['qty'] = 1;
           var disable = CheckAddDisabled(ItemObject.price);
           var Check = CheckConditions();
           if(!disable){
             var OldArray = JSON.parse(localStorage.getItem("BoxContents"));
             PushItemsInBox(OldArray,ItemObject);
             RenderDrawerItems();
             var Check = CheckIfAdded(ItemObject.pid);
             $(this).parents('.vwProd__hover-container').find('.vwProd__quantity-added').html(Check.box.qty).show();
             $(this).parents('.vwProd__hover-container').addClass('vw-itm-img-active');
             $(this).parents('.vwProd__hover-container').find('.vwitm-qty-box').show();
             $(this).parents('.vwProd__hover-container').find('.vwitem__quantity-status').html( Check.box.qty+' in box');
             $(this).hide();
           }else{
             swal("Limit Reached", "Product Limit For the  Box", "error");
             return false;
           }

         });

         function CheckConditions() {
           var Check = {check:false}
            if(window.productCount !== null && window.bxAmt !== null){
              Check = {check:true,condition:'both'}
            }
            if (window.productCount !== null && window.bxAmt == null ) {
              Check['condition'] = 'product';
              Check['check'] = true;
            }
            if (window.bxAmt !== null && window.productCount == null ) {
                Check['condition'] = 'amt';
                Check['check'] = true;
            }
          return Check;
         }

         function AddProductsToHomePage(CheckTag){
           var SeletableHTML ="";
           var FilteredCount = 0;
           for (var pindex = 0; pindex < window.AllProducts.length; pindex++) {
             var Product = window.AllProducts[pindex];
               if(Product.tags.indexOf(CheckTag) >=0){
                 FilteredCount = FilteredCount+1;
                 SeletableHTML+=ReturnAddonHTML(Product);
               }
           }
           $('.GiftsFiltered').html('Showing '+FilteredCount+' Gifts');
           $('.SelectableProducts').html(SeletableHTML);
         }

         function AddProductBasedOnColletion(){
           var SeletableHTML ="";
           var FilteredCount = 0;
           for (var pindex = 0; pindex < window.AllProducts.length; pindex++){
             var Product = window.AllProducts[pindex];
              if(ExcludeProducts.indexOf(Product.id.toString()) < 0){
                FilteredCount = FilteredCount+1;
                if(window.tags){
                  var CheckTag = $('.Ptags').val()
                  if(Product.tags.indexOf(CheckTag) >=0){
                    SeletableHTML+=ReturnAddonHTML(Product);
                  }
                }else{
                  SeletableHTML+=ReturnAddonHTML(Product);
                }
              }
           }
           $('.GiftsFiltered').html('Showing '+FilteredCount+' Gifts');
           $('.SelectableProducts').html(SeletableHTML);
           $('.loading').hide();
         }
         function ShowMyCollection(collection){
           var MaxPageNo =$("#vwc").data('count');
           var MinPageNo =1,Pages=[];
           for (var page = MinPageNo; page <= MaxPageNo; page++){
             Pages.push(page);
           }
           var array = Pages;
           window.AllProducts = [];
          if(array.length >0){
            Shopify.queue = array;
            Shopify.moveAlong = function() {
              if (Shopify.queue.length) {
                var request = Shopify.queue.shift();
                var searchURL = '/collections/'+collection+'/products.json?page='+request+'&limit=50';
                $.ajax({
                  type: 'GET',
                  url:searchURL,
                  dataType: 'json',
                  success: function(res){
                    if(res.products.length >0){
                      for (var pindex = 0; pindex < res.products.length; pindex++) {
                         var Product = res.products[pindex];
                         window.AllProducts.push(Product);
                      }
                      Shopify.moveAlong();
                    }else{
                      AddProductBasedOnColletion();
                    }
                  },
                });
              }else{
                AddProductBasedOnColletion();
              }
            };
            Shopify.moveAlong();
          }
        }


         function ShowProductOnTheBasisOfCollection(collection){
           ShowMyCollection(collection);
         }
         function SelectBoxProducts(products){
            window.AllProducts = [];
            for (var pindex = 0; pindex < products.length; pindex++) {
              var product = products[pindex];
              window.AllProducts.push(JSON.parse(product.product_json));
            }
            AddProductBasedOnColletion();
         }

         function CreateTagsHtml(tags) {
           var select_tags ="";
           for (var pindex = 0; pindex < tags.length; pindex++) {
             var tag = tags[pindex];
             var Selected = ((pindex == 0)  ?  'selected'  : "");
             select_tags+='<option value="'+tag+'" '+Selected+'>'+tag+'</option>';
           }
           window.tags = true;
            $('.Ptags').html(select_tags);
            ShowMyCollection('all');
            $('.VWFilter__row').show();
         }

        $(".close__, .VWpopUp_button").click(function(){
            $(".Custom_popup").hide();
        });


        $("#vwflip").click(function(){
          $("#vwpanel").slideToggle("slow");
        });



          $(document).on('click','.vwbar__arrow--next3',function(){
            if(CheckIfCardAdded()){
              $('.addtoCartBox').click()
            }else{
              swal("Empty Card", "Add Card To proceed", "error");
             return false;
            }
          })
        $("button.vwbar__arrow.vwbar__arrow--next").click(function() {
            $(".VWbox__page--addonvwProds").show();
            $(".VWbox__page--mainvwProds").hide();
            $("button.vwbar__arrow.vwbar__arrow--prev").removeClass("vwbar__arrow--disabled");
            $(".Step_2").addClass("active");
            $(".Step_1").removeClass("active");
            $(this).hide();
            $(".vwbar__arrow--next2").show();
            RenderDrawerItems();
            $('#vwscrollsidebar').show();

        });
        $(".vwbar__arrow--next2").click(function(){
            $(".Step_3").addClass("active");
            $(".Step_2").removeClass("active");
            $(".vwbar__arrow--prev, .VWbox__page--addonvwProds").hide();
            $(".vwbar__arrow--prev2, .VWBox.VWBox--cardvwProds").show();
            $(this).hide();
            $('.vwbar__arrow--next3').show();
        });
        $(".vwbar__arrow--prev2").click(function() {
            $(".Step_3").removeClass("active");
            $(".Step_2").addClass("active");
            $(this).hide();
            $(".vwbar__arrow--prev, .vwbar__arrow--next, .VWbox__page--addonvwProds").show();
            $(".vwbar__arrow--next2, .VWBox.VWBox--cardvwProds,.vwbar__arrow--next3").hide();
        });
        $("button.vwbar__arrow.vwbar__arrow--prev").click(function(){
            $('#vwscrollsidebar').hide();
          	var addGift = "Select the design that's perfect for your giftee.";
          	var para = "Once you've chosen a design, you can start selecting their gifts!"
            $(this).addClass("vwbar__arrow--disabled");
            $(".VWbox__page--mainvwProds").show();
            $(".VWbox__page--addonvwProds").hide();
            $(".Step_2, .Step_3").removeClass("active")
            $(".Step_1").addClass("active");
            $(".vwbar__arrow--next2,.vwbar__arrow--next3").hide();
            $(".vwbar__arrow--next").show();
            $(".vwbar__description h3").html(addGift);
            $(".vwbar__description p").html(para);
        });

        $(".vwProd.vwProd--main").click(function(){
        	var select = "selected";
        	var sart = "start building";
        	$(".vwProd.vwProd--main").removeClass("vwProd--selected");
        	$(".vwProd.vwProd--main").find(".vwProd__button").html(sart);
        	$(this).addClass("vwProd--selected");
        	$(this).find(".vwProd__button").html(select);
        	$("button.vwbar__arrow.vwbar__arrow--next").click();
        	$("button.vwbar__arrow.vwbar__arrow--next").removeClass("vwbar__arrow--disabled");
        });

        $(".vwProd.vwProd--main, button.vwbar__arrow.vwbar__arrow--next").click(function(){
            var addGift = "Add a gift U know they will love";
            var para = "There's definitely no minimum, but we'll tell you when your Happy Box is full."
            $(".vwbar__description h3").html(addGift);
            $(".vwbar__description p").html(para);
        	});

        $(document).on('click','.select_card',function(){
            var btn = "Edit"
            var btn2 = "Select Card"
            $(".VWBox-vwProds li .vwProd--card").removeClass("vwProd--selected");
            $(this).addClass("vwProd--selected");
            $(".VWBox-vwProds li .vwProd--card").find(".vwProd__button").html(btn2);
            $(this).find(".vwProd__button").html(btn);
            var datas = ['pid','variant','box-image','title','price','box-after'],ItemObject = {};
            for (var key = 0; key < datas.length; key++){
              ItemObject[datas[key]] = $(this).data(datas[key]);
            }
            ItemObject['productType'] = 'card';
            ItemObject['qty'] = 1;
            window.card = ItemObject;
            $(".Custom_popup").show();
            $('.VWpopup_image').attr('src',ItemObject['box-after']);
            if(CheckIfCardAdded()){
              $cardAdded =CheckIfCardAdded().box
              $('.VWpop_up_text_area').val($cardAdded.msg);
              ShowRemaningWords()
            }
        });
        function ShowRemaningWords(){
          $remaing_chars = 100 - $('.VWpop_up_text_area').val().length;
          $('.remaing_chars').html($remaing_chars);
        }

      $(document).on('keyup keypress','.VWpop_up_text_area',function(e) {
        ShowRemaningWords();
      });


        function CheckIfCardAdded(){
            var OldArray = JSON.parse(localStorage.getItem("BoxContents"));
              for (var bx = 0; bx < OldArray.length; bx++) {
                if(OldArray[bx].productType == 'card'){
                  return {sr_no : bx,box : OldArray[bx]}
              }
            }
        }

        $(document).on('click','.editcard',function(){
          var ItemObject = CheckIfCardAdded().box;
          window.card = ItemObject;
          $(".Custom_popup").show();
          $('.VWpopup_image').attr('src',ItemObject['box-after']);
          $('.VWpop_up_text_area').val(ItemObject['msg']);
          ShowRemaningWords();
        });

        $(document).on('click','.VWpop_up_save',function(){
            var ItemObject = window.card;
            if($("#VWpop_upBlankCard").prop('checked') == false){
              ItemObject['msg'] = $('.VWpop_up_text_area').val();
            }
            if(CheckIfCardAdded()){
              if(CheckIfBoxAdded().box != ItemObject.pid){
                var OldArray = JSON.parse(localStorage.getItem("BoxContents"));
                delete OldArray[CheckIfCardAdded().sr_no];
                OldArray = OldArray.filter(function (el) {
                  return el != null;
                });
                PushItemsInBox(OldArray,ItemObject);
              }else{
                var OldArray = JSON.parse(localStorage.getItem("BoxContents"));
                OldArray[CheckIfCardAdded().sr_no] = ItemObject;
                localStorage.setItem("BoxContents",JSON.stringify(OldArray));
              }
            }else{
              var OldArray = JSON.parse(localStorage.getItem("BoxContents"));
              PushItemsInBox(OldArray,ItemObject);
            }
            $('.VWpop_up_text_area').val("");
            RenderDrawerItems();
            $(".Custom_popup").hide();
        })
        $(document).on('change','#VWpop_upBlankCard',function(){
          $('.VWpop_up_text_area').show();
          if($(this).prop('checked') == true){
            $('.VWpop_up_text_area').hide();
            $('.VWpop_up_text_area').val("");
          }
        });
        </script>
        <?php
        $html = ob_get_clean();
       return $this->output->set_content_type('application/liquid')->set_status_header(200)->set_output($html);
    }

    public function Test($value='')
    {
        echo "Hello";
    }


  }
