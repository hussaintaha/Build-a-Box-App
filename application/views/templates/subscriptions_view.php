<div style="margin-top: 2%;width: 100%;" class="Polaris-Card">
   <div>
      <div class="Polaris-Tabs__Wrapper">
         <ul role="tablist" class="Polaris-Tabs">
            <li class="Polaris-Tabs__TabContainer">
               <button id="all-customers" role="tab" type="button" tabindex="0" class="Polaris-Tabs__Tab Polaris-Tabs__Tab--selected" aria-selected="true" aria-controls="all-customers-content" aria-label="All customers">
               <span class="Polaris-Tabs__Title">Currently Active</span>
               </button>
            </li>
            <li class="Polaris-Tabs__TabContainer">
               <button id="accepts-marketing" role="tab" type="button" tabindex="-1" class="Polaris-Tabs__Tab" aria-selected="false" aria-controls="accepts-marketing-content">
               <span class="Polaris-Tabs__Title">CGB(Custom Gift Box) Subscription</span>
               </button>
            </li>
            <li style="display:none;" class="Polaris-Tabs__TabContainer">
               <button id="repeat-customers" role="tab" type="button" tabindex="-1" class="Polaris-Tabs__Tab" aria-selected="false" aria-controls="repeat-customers-content">
               <span class="Polaris-Tabs__Title">Recharge Subscription</span>
               </button>
            </li>
            <li class="Polaris-Tabs__DisclosureTab">
               <div>
                  <button type="button" class="Polaris-Tabs__DisclosureActivator" aria-label="More tabs" tabindex="0" aria-controls="Polarispopover6" aria-owns="Polarispopover6" aria-expanded="false">
                     <span class="Polaris-Tabs__Title">
                        <span class="Polaris-Icon">
                           <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                              <path d="M6 10a2 2 0 1 1-4.001-.001A2 2 0 0 1 6 10zm6 0a2 2 0 1 1-4.001-.001A2 2 0 0 1 12 10zm6 0a2 2 0 1 1-4.001-.001A2 2 0 0 1 18 10z" fill-rule="evenodd" />
                           </svg>
                        </span>
                     </span>
                  </button>
               </div>
            </li>
         </ul>
      </div>
      <div class="Polaris-Tabs__Panel" id="all-customers-content"  role="tabpanel" aria-labelledby="all-customers" tabindex="-1"
         >
         <div class="Polaris-Card__Section">
              <div class="Polaris-ResourceList__ResourceListWrapper">
                <div class="Polaris-Card__Section">

                    <ul class="Polaris-ResourceList" aria-live="polite">
                       <li class="Polaris-ResourceList__ItemWrapper">
                          <div class="Polaris-ResourceItem" data-href="customers/341">
                             <a aria-describedby="341" aria-label="View details for Mae Jemison" class="Polaris-ResourceItem__Link" tabindex="0" id="ResourceListItemOverlay3" href="#" data-polaris-unstyled="true"></a>
                             <div class="Polaris-ResourceItem__Container" id="341">
                                <div class="Polaris-ResourceItem__Content">
                                   <h3>
                                     <span class="Polaris-TextStyle--variationStrong">Shopify Checkout</span>
                                     <?php
                                     if(CurrentActiveCheckout($shop_id) == 0){ ?>
                                       <button  data-type="Shopify Checkout" data-checkout="0" style="float:right" type="button" class="Polaris-Button Polaris-Button--destructive activate">
                                         <span class="Polaris-Button__Content">
                                           <span class="Polaris-Button__Text">Disable</span>
                                         </span>
                                       </button>
                                     <?php }else{ ?>
                                       <button  data-type="Shopify Checkout" data-checkout="0" style="float:right;" type="button" class="Polaris-Button Polaris-Button--primary activate">
                                         <span class="Polaris-Button__Content">
                                           <span class="Polaris-Button__Text">Enable</span>
                                         </span>
                                       </button>

                                     <?php }
                                     ?>

                                   </h3>
                                </div>
                             </div>
                          </div>
                       </li>
                       <li class="Polaris-ResourceList__ItemWrapper">
                          <div class="Polaris-ResourceItem" data-href="customers/341">
                             <a aria-describedby="341" aria-label="View details for Mae Jemison" class="Polaris-ResourceItem__Link" tabindex="0" id="ResourceListItemOverlay3" href="#" data-polaris-unstyled="true"></a>
                             <div class="Polaris-ResourceItem__Container" id="341">
                                <div class="Polaris-ResourceItem__Content">
                                   <h3>
                                     <span class="Polaris-TextStyle--variationStrong">CGB Checkout</span>
                                     <?php
                                     if(CurrentActiveCheckout($shop_id) == 1){ ?>
                                       <button  data-type="BOB Checkout"  data-checkout="1" style="float:right;" type="button" class="Polaris-Button Polaris-Button--destructive activate">
                                         <span class="Polaris-Button__Content">
                                           <span class="Polaris-Button__Text">Disable</span>
                                         </span>
                                       </button>
                                     <?php }else{ ?>
                                       <button  data-type="BOB Checkout"  data-checkout="1" style="float:right;" type="button" class="Polaris-Button Polaris-Button--primary activate">
                                         <span class="Polaris-Button__Content">
                                           <span class="Polaris-Button__Text">Enable</span>
                                         </span>
                                       </button>
                                     <?php }?>
                                   </h3>
                                </div>
                             </div>
                          </div>
                       </li>
                       <li style="display:none;" class="Polaris-ResourceList__ItemWrapper">
                          <div class="Polaris-ResourceItem" data-href="customers/341">
                             <a aria-describedby="341" aria-label="View details for Mae Jemison" class="Polaris-ResourceItem__Link" tabindex="0" id="ResourceListItemOverlay3" href="#" data-polaris-unstyled="true"></a>
                             <div class="Polaris-ResourceItem__Container" id="341">
                                <div class="Polaris-ResourceItem__Content">
                                   <h3>
                                     <span class="Polaris-TextStyle--variationStrong">Recharge Subscription</span>
                                     <?php
                                     if(CurrentActiveCheckout($shop_id) == 2){ ?>
                                       <button  data-type="Recharge Subscription" data-checkout="2" style="float:right;" type="button" class="Polaris-Button Polaris-Button--destructive activate">
                                         <span class="Polaris-Button__Content">
                                           <span class="Polaris-Button__Text">Disable</span>
                                         </span>
                                       </button>
                                     <?php }else{ ?>
                                       <button  data-type="Recharge Subscription" data-checkout="2" style="float:right;" type="button" class="Polaris-Button Polaris-Button--primary activate">
                                         <span class="Polaris-Button__Content">
                                           <span class="Polaris-Button__Text">Enable</span>
                                         </span>
                                       </button>
                                     <?php }?>

                                   </h3>
                                </div>
                             </div>
                          </div>
                       </li>
                    </ul>
                 </div>
         </div>
      </div>
    </div>
      <div class="Polaris-Tabs__Panel Polaris-Tabs__Panel--hidden" id="accepts-marketing-content"
         role="tabpanel" aria-labelledby="accepts-marketing" tabindex="-1" >
         <div class="Polaris-Card__Section">
            <div class="Polaris-Card__SectionHeader">
               <h3 aria-label="All" class="Polaris-Subheading">Stripe Settings</h3>
            </div>

            <?php
            $StripeDetails = GetStripeKeys($shop_id);
            //print_r($StripeDetails);

            ?>
            <form class="stripeForm">
                <!-- <div class="Polaris-Labelled__LabelWrapper">
                   <div class="Polaris-Label">
                     <label id="PolarisTextField2Label" for="PolarisTextField1" class="Polaris-Label__Text">Test Publish Key</label>
                   </div>
                </div>
                <div class="Polaris-Connected">
                   <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                      <div class="Polaris-TextField Polaris-TextField--hasValue">
                         <input id="PolarisTextField1"
                         class="Polaris-TextField__Input"
                         aria-labelledby="PolarisTextField2Label"
                          aria-invalid="false"
                          aria-multiline="false"
                          name="test_p_key"
                          value="<?=(($StripeDetails) ? $StripeDetails->test_p_key: "")?>">
                         <div class="Polaris-TextField__Backdrop"></div>
                      </div>
                   </div>
                </div>
                <div class="Polaris-Labelled__LabelWrapper">
                   <div class="Polaris-Label">
                     <label id="PolarisTextField2Label" for="PolarisTextField2" class="Polaris-Label__Text">Test Secret Key</label>
                   </div>
                </div>
                <div class="Polaris-Connected">
                   <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                      <div class="Polaris-TextField Polaris-TextField--hasValue">
                         <input id="PolarisTextField2" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField2Label"
                          aria-invalid="false" aria-multiline="false" name="test_s_key" value="<?=(($StripeDetails) ? $StripeDetails->test_s_key: "")?>">
                         <div class="Polaris-TextField__Backdrop"></div>
                      </div>
                   </div>
                </div> -->
                <div class="Polaris-Labelled__LabelWrapper">
                   <div class="Polaris-Label">
                     <label id="PolarisTextField2Label" for="PolarisTextField3" class="Polaris-Label__Text">Live Publish  Key</label>
                   </div>
                </div>
                <div class="Polaris-Connected">
                   <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                      <div class="Polaris-TextField Polaris-TextField--hasValue">
                         <input id="PolarisTextField3" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField2Label"
                          aria-invalid="false" aria-multiline="false"  name="live_p_key" value="<?=(($StripeDetails) ? $StripeDetails->live_p_key: "")?>">
                         <div class="Polaris-TextField__Backdrop"></div>
                      </div>
                   </div>
                </div>
                <div class="Polaris-Labelled__LabelWrapper">
                   <div class="Polaris-Label">
                     <label id="PolarisTextField2Label" for="PolarisTextField4" class="Polaris-Label__Text">Live Secret Key</label>
                   </div>
                </div>
                <div class="Polaris-Connected">
                   <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                      <div class="Polaris-TextField Polaris-TextField--hasValue">
                         <input id="PolarisTextField4" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField2Label"
                          aria-invalid="false" aria-multiline="false"  name="live_s_key" value="<?=(($StripeDetails) ? $StripeDetails->live_s_key: "")?>">
                         <div class="Polaris-TextField__Backdrop"></div>
                      </div>
                   </div>
                </div>
                <button  style="margin-top: 2%;float: right;margin-bottom: 2%;" type="submit" class="Polaris-Button Polaris-Button--primary">
                  <span class="Polaris-Button__Content">
                    <span class="Polaris-Button__Text">Save Keys</span>
                  </span>
                </button>
              </form>


                <div class="Polaris-EmptyState__Section">
                   <div class="Polaris-EmptyState__DetailsContainer">
                     <div class="Polaris-EmptyState__Details">
                       <div class="Polaris-TextContainer">
                         <p class="Polaris-DisplayText Polaris-DisplayText--sizeMedium">Generate Stripe API credentials.</p>
                         <div class="Polaris-EmptyState__Content">
                           <p>Generate Publishable key and Secret key from your stripe dashboard and enter these keys into the APP.</p>
                         </div>
                       </div>
                       <div class="Polaris-EmptyState__Actions">
                         <div class="Polaris-Stack Polaris-Stack--alignmentCenter">
                           <div class="Polaris-Stack__Item">
                             <a target="_blank" href="https://stripe.com/docs/keys">
                               <button type="button" class="Polaris-Button Polaris-Button--primary Polaris-Button--sizeLarge">
                                 <span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Learn How</span></span></button>
                               </a>
                             </div>
                           <div class="Polaris-Stack__Item"></div>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
                 <div class="Polaris-EmptyState__ImageContainer" style="padding-top:20px">
                   <a target="_blank" href="<?=asset_url2('stripe.gif','images')?>">
                     <img src="<?=asset_url2('stripe.gif','images')?>" role="presentation" alt="" class="Polaris-EmptyState__Image">
                   </a>
                 </div>
         </div>
      </div>

      <div class="Polaris-Tabs__Panel Polaris-Tabs__Panel--hidden" id="repeat-customers-content" role="tabpanel" aria-labelledby="repeat-customers" tabindex="-1" >
         <div class="Polaris-Card__Section">
            <div class="Polaris-Card__SectionHeader">
               <h3 aria-label="All" class="Polaris-Subheading">Recharge API Settings</h3>
            </div>
              <form class="RechrageForm">
                <div class="Polaris-Labelled__LabelWrapper">
                 <div class="Polaris-Label"><label id="PolarisTextField2Label" for="PolarisTextField5" class="Polaris-Label__Text">Recharge API Token</label></div>
               </div>
               <div class="Polaris-Connected">
                 <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                   <div class="Polaris-TextField Polaris-TextField--hasValue">
                     <input id="PolarisTextField2"
                     class="Polaris-TextField__Input"
                     name="recharge_token"
                     aria-labelledby="PolarisTextField2Label"
                     aria-invalid="false" aria-multiline="false" value="<?=(GetRechargeKey($shop_id) ? GetRechargeKey($shop_id) : "")?>" >
                     <div class="Polaris-TextField__Backdrop"></div>
                   </div>
                 </div>
               </div>
               <button  style="margin-top: 2%;float: right;margin-bottom: 2%;" type="submit" class="Polaris-Button Polaris-Button--primary">
                 <span class="Polaris-Button__Content">
                   <span class="Polaris-Button__Text">Save Keys</span>
                 </span>
               </button>
                    <div class="Polaris-TextContainer">
                    <h2 class="Polaris-Heading">Get Your Recharge Keys</h2>
                      <p>How To get Recharge API Keys <a  target="_blank" href="https://support.rechargepayments.com/hc/en-us/articles/360008829993-ReCharge-API-">Get My keys</a></p>
                    </div>

             </form>
         </div>
      </div>
   </div>
</div>
<script>
   $(document).on('submit','.RechrageForm',function(evt){
     evt.preventDefault();
     $submit=true;
     $(this).find('.Polaris-TextField__Input').each(function(ind,txbx){
         if($(txbx).val() == ""){
           $(txbx).css("border","1px solid red");
           $submit = false;
         } else {
           $(txbx).css("border","1px solid #c1ccd3");
         }
     });
     if($submit){
         var ActionURL ='<?=base_url()."Home/SaveRechargeToken?shop=".$shop."&shop_id=".$shop_id?>';
         $.ajax({
           type: 'POST',
           url: ActionURL,
           data: $(this).serialize(),
           dataType: 'json',
           success: function(response) {
             if(response.code == 200) {
               ShopifyApp.flashNotice(response.msg);
             } else {
               ShopifyApp.flashError(response.msg);
             }
             location.reload();
           }
         })
     }
   })
   $(document).on('submit','.stripeForm',function(evt){
     evt.preventDefault();
     $submit=true;
     $(this).find('.Polaris-TextField__Input').each(function(ind,txbx){
         if($(txbx).val() == ""){
           $(txbx).css("border","1px solid red");
           $submit = false;
         } else {
           $(txbx).css("border","1px solid #c1ccd3");
         }
     });
     if($submit){
         var ActionURL ='<?=base_url()."Home/SaveStripeKeys?shop=".$shop."&shop_id=".$shop_id?>';
         $.ajax({
           type: 'POST',
           url: ActionURL,
           data: $(this).serialize(),
           dataType: 'json',
           success: function(response) {
             if(response.code == 200) {
               ShopifyApp.flashNotice(response.msg);
             } else {
               ShopifyApp.flashError(response.msg);
             }
             location.reload();
           }
         })
     }

   })
   $(document).on('click','.activate',function(){
     $checkout = $(this).data('checkout');
     $type = $(this).data('type');
     $message = 'Are You sure to Activate '+$type+' For Custom Gift Box Page';
     $action = 'enable';
     if($(this).hasClass('Polaris-Button--destructive')){
       $action = 'disable';
       $message = 'Are You sure to Deactivate '+$type+' For Custom Gift Box Page';
     }
      $confirm =  confirm($message);
      if ($confirm) {
        var ActionURL ='<?=base_url()."Home/SaveCheckout?shop=".$shop."&shop_id=".$shop_id?>';
        $.ajax({
          type: 'POST',
          url: ActionURL,
          data: {status:$checkout,action:$action},
          dataType: 'json',
          success: function(response) {
            if(response.code == 200) {
              ShopifyApp.flashNotice(response.msg);
            } else {
              ShopifyApp.flashError(response.msg);
            }
            location.reload();
          }
        })
      }
   });


   $('.Polaris-Tabs__Tab').on('click',function(){
     $('.Polaris-Tabs__Tab').removeClass('Polaris-Tabs__Tab--selected');
     $('.Polaris-Tabs__Tab').attr('aria-selected',false);
     $(this).attr('aria-selected',true);
     $(this).addClass('Polaris-Tabs__Tab--selected');
     $tabToShow = $(this).attr('aria-controls');
     $(".Polaris-Tabs__Panel").addClass('Polaris-Tabs__Panel--hidden');
     $("#"+$tabToShow).removeClass('Polaris-Tabs__Panel--hidden');
   })
</script>
