<div class="Polaris-Layout__AnnotatedSection">
   <div class="Polaris-Layout__AnnotationWrapper">
      <div class="Polaris-Layout__Annotation">
         <div class="Polaris-TextContainer">
            <h2 class="Polaris-Heading">Card Details</h2>
            <div class="Polaris-Layout__AnnotationDescription">
               <p>Message Card Basic Details.</p>


            </div>
         </div>
      </div>

      <div class="Polaris-Layout__AnnotationContent">
          <form id="bxform1" class="individualForm">

            <input type="hidden" value="<?=$card_Data->id?>" name="bx_id">

         <div class="Polaris-Card">
            <div class="Polaris-Card__Section">
               <div class="Polaris-FormLayout">
                  <div class="Polaris-FormLayout__Item">
                     <div class="">
                        <div class="Polaris-Labelled__LabelWrapper">
                           <div class="Polaris-Label">
                              <label id="PolarisTextField1Label" for="PolarisTextField1" class="Polaris-Label__Text">
                                    Card Name
                              </label>
                           </div>
                        </div>
                        <div class="Polaris-Connected">
                           <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                              <div class="Polaris-TextField Polaris-TextField--hasValue">
                                 <input value="<?=$card_Data->card_title?>"
                                 id="PolarisTextField1" class="Polaris-TextField__Input txt-input"  type="text" name="bx_title"     >
                                 <div class="Polaris-TextField__Backdrop"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="Polaris-FormLayout__Item">
                     <div  style="width:100%;display: flex;">
                        <div style="width:50%;">
                           <fieldset class="Polaris-ChoiceList" id="PolarisChoiceList14" aria-invalid="false">
                                  <legend class="Polaris-ChoiceList__Title">Include Card Price</legend>
                                  <label class="Polaris-Choice" for="PolarisRadioButton35">
                                      <span class="Polaris-Choice__Control">
                                          <span class="Polaris-RadioButton">
                                              <input id="PolarisRadioButton35"
                                              name="inc_box_price" type="radio"
                                              <?=(($card_Data->card_include_price == 'yes') ? 'checked' : "")?>
                                              class="Polaris-RadioButton__Input box_price" value="yes"    >
                                              <span class="Polaris-RadioButton__Backdrop"></span>
                                              <span class="Polaris-RadioButton__Icon"></span>
                                          </span>
                                      </span>
                                      <span class="Polaris-Choice__Label">Yes</span>
                                  </label>
                                <label class="Polaris-Choice" for="PolarisRadioButton36">
                                    <span class="Polaris-Choice__Control">
                                        <span class="Polaris-RadioButton">
                                            <input id="PolarisRadioButton36"   name="inc_box_price" type="radio"  class="Polaris-RadioButton__Input box_price" value="no"    >
                                            <span class="Polaris-RadioButton__Backdrop"></span>
                                            <span class="Polaris-RadioButton__Icon"></span>
                                        </span>
                                    </span>
                                    <span class="Polaris-Choice__Label">No</span>
                                </label>
                           </fieldset>
                        </div>
                        <div style="width:50%;" id="show_price">
                           <div class="Polaris-Labelled__LabelWrapper">
                              <div class="Polaris-Label">
                                 <label id="PolarisTextField2Label" for="PolarisTextField2" class="Polaris-Label__Text">
                                    Card Price
                                 </label>
                              </div>
                           </div>
                           <div class="Polaris-Connected">
                              <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                 <div class="Polaris-TextField Polaris-TextField--hasValue">
                                    <input onkeypress="validateText(event)" name="bx_price"
                                      id="PolarisTextField2" value="<?=$card_Data->card_price?>"
                                     class="Polaris-TextField__Input txt-input" type="text"  >
                                    <div class="Polaris-TextField__Backdrop"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
       </form>
      </div>
   </div>
</div>


<!-- BOx Images Section-->
<div class="Polaris-Layout__AnnotatedSection">
   <div class="Polaris-Layout__AnnotationWrapper">
      <div class="Polaris-Layout__Annotation">
         <div class="Polaris-TextContainer">
            <h2 class="Polaris-Heading">Card Images</h2>
            <div class="Polaris-Layout__AnnotationDescription">
               <p>Upload Card Images(Visible on Storefront).</p>
            </div>
         </div>
      </div>
      <div class="Polaris-Layout__AnnotationContent">
          <form id="bxform2" class="individualForm">
         <div class="Polaris-Card">
            <div class="Polaris-Card__Section">
               <div class="Polaris-FormLayout">
                 <div class="UPDLoader" style="display:none;text-align:center;margin-top:3%">
                   <span class="Polaris-Spinner Polaris-Spinner--colorTeal Polaris-Spinner--sizeLarge"><svg viewBox="0 0 44 44" xmlns="http://www.w3.org/2000/svg">
                   <path d="M15.542 1.487A21.507 21.507 0 00.5 22c0 11.874 9.626 21.5 21.5 21.5 9.847 0 18.364-6.675 20.809-16.072a1.5 1.5 0 00-2.904-.756C37.803 34.755 30.473 40.5 22 40.5 11.783 40.5 3.5 32.217 3.5 22c0-8.137 5.3-15.247 12.942-17.65a1.5 1.5 0 10-.9-2.863z"></path>
                   </svg></span><span role="status"><span class="Polaris-VisuallyHidden">Spinner example</span></span>
                 </div>

                  <div class="Polaris-FormLayout__Item">
                       <div class="">
                          <div class="Polaris-Labelled__LabelWrapper">
                             <div class="Polaris-Label">
                                <label  style="color: red;font-size: 25px;display:none;" class="Polaris-Label__Text imageError">
                                    Please Upload Befor And After Image
                                </label>
                                <label id="PolarisTextField1Label" for="PolarisTextField1" class="Polaris-Label__Text">
                                    Before Image
                                </label>
                             </div>
                          </div>
                          <img width="100" class="thumb" height="100" src="<?=base_url('assets/images/no-image.png') ?>" alt="">
                              <span class="afterUpload" >
                                    <img width="100" height="100" src="<?=base_url('assets/images/double-arrow.png') ?>" alt="">
                                    <img width="100" id="loadImage" class="thumb" height="100" src="<?=$card_Data->card_before_image?>" alt="">
                              </span>

                       </div>
                     <div class="">
                        <div class="Polaris-Labelled__LabelWrapper">
                           <div class="Polaris-Label">
                                <label id="PolarisTextField2Label" for="PolarisTextField2" class="Polaris-Label__Text">Choose Images</label>
                           </div>
                        </div>
                        <div class="Polaris-Connected" style="width: 48.5%;">
                           <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                              <div class="Polaris-TextField Polaris-TextField--hasValue">
                                 <input id="PolarisTextField2" onchange="readURL(this)"
                                 data-select = "before_image" type="file" class="Polaris-TextField__Input"  accept="image/png, image/jpeg"   >
                                 <div class="Polaris-TextField__Backdrop"></div>


                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="Polaris-FormLayout__Item">
                     <div class="">
                        <div class="Polaris-Labelled__LabelWrapper">
                           <div class="Polaris-Label">
                              <label id="PolarisTextField1Label" for="PolarisTextField1" class="Polaris-Label__Text">
                                  After Image
                              </label>
                           </div>
                        </div>
                        <img width="100" class="thumb" height="100" src="<?=base_url('assets/images/no-image.png') ?>" alt="">
                        <span class="afterUpload">
                            <img width="100" height="100" src="<?=base_url('assets/images/double-arrow.png') ?>" alt="">
                            <img width="100" id="loadImage" class="thumb" height="100"  src="<?=$card_Data->card_after_image?>"alt="">
                        </span>
                     </div>
                     <div class="">
                        <div class="Polaris-Labelled__LabelWrapper">
                           <div class="Polaris-Label">
                              <label id="PolarisTextField3Label" for="PolarisTextField2" class="Polaris-Label__Text">Choose Images</label>
                           </div>
                        </div>
                        <div class="Polaris-Connected" style="width: 48.5%;">
                           <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                              <div class="Polaris-TextField Polaris-TextField--hasValue">
                                 <input  accept="image/png, image/jpeg"  id="PolarisTextField3" onchange="readURL(this)" data-select="after_image" type="file" class="Polaris-TextField__Input"  >

                                 <div class="Polaris-TextField__Backdrop"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <input type="hidden"  value="<?=$card_Data->card_after_image?>" name="after_image" class="after_image bxImages">
                     <input type="hidden"  value="<?=$card_Data->card_before_image?>" name="before_image" class="before_image bxImages">
                  </div>
               </div>
            </div>
         </div>
       </form>
      </div>
   </div>
</div>



<div class="Polaris-Layout__AnnotatedSection">
   <div class="Polaris-Layout__AnnotationWrapper">
      <div class="Polaris-Layout__Annotation">
         <div class="Polaris-TextContainer">
            <h2 class="Polaris-Heading"></h2>
            <div class="Polaris-Layout__AnnotationDescription">
            </div>
         </div>
      </div>
      <div class="Polaris-Layout__AnnotationContent">
         <div class="Polaris-Card">
            <div class="Polaris-Card__Section">
               <div class="Polaris-FormLayout">
                  <div class="Polaris-FormLayout__Item">
                     <div class="">
                        <div class="Polaris-Connected">
                           <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                              <div class="Polaris-TextField" style="float:right">
                                    <button type="button"  id="ButtonForSubmit" class="Polaris-Button Polaris-Button--primary">
                                          <span class="Polaris-Button__Content">
                                          <span class="Polaris-Button__Text">Update</span>
                                          </span>
                                    </button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<div>
  <div class="Polaris-Modal-Dialog__Container undefined BXLOADER" style="display:none;"  data-polaris-layer="true" data-polaris-overlay="true">
    <div>
      <div role="dialog" aria-labelledby="modal-header12" tabindex="-1" class="Polaris-Modal-Dialog">
        <div class="Polaris-Modal-Dialog__Modal">
          <div class="Polaris-Modal-Header">
            <div id="modal-header12" class="Polaris-Modal-Header__Title">
              <h2 class="Polaris-DisplayText Polaris-DisplayText--sizeSmall">Updating</h2>
            </div>
            <button class="Polaris-Modal-CloseButton" aria-label="Close" style="display:none;">
              <span class="Polaris-Icon Polaris-Icon--colorInkLighter Polaris-Icon--isColored">
                <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                  <path d="M11.414 10l6.293-6.293a.999.999 0 1 0-1.414-1.414L10 8.586 3.707 2.293a.999.999 0 1 0-1.414 1.414L8.586 10l-6.293 6.293a.999.999 0 1 0 1.414 1.414L10 11.414l6.293 6.293a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414L11.414 10z" fill-rule="evenodd">
                  </path>
                </svg>
              </span>
            </button>
          </div>
          <div class="Polaris-Modal__BodyWrapper">
            <div class="Polaris-Modal__Body Polaris-Scrollable Polaris-Scrollable--vertical" data-polaris-scrollable="true">
              <section class="Polaris-Modal-Section">
                <div class="Polaris-TextContainer">
                  <p class="successMsg">Please Wait While Updating Saving Card Details.</p>
                  <div  style="text-align:center">
                    <span class="Polaris-Spinner Polaris-Spinner--colorTeal Polaris-Spinner--sizeLarge"><svg viewBox="0 0 44 44" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.542 1.487A21.507 21.507 0 00.5 22c0 11.874 9.626 21.5 21.5 21.5 9.847 0 18.364-6.675 20.809-16.072a1.5 1.5 0 00-2.904-.756C37.803 34.755 30.473 40.5 22 40.5 11.783 40.5 3.5 32.217 3.5 22c0-8.137 5.3-15.247 12.942-17.65a1.5 1.5 0 10-.9-2.863z"></path>
                    </svg></span><span role="status"><span class="Polaris-VisuallyHidden">Spinner example</span></span>
                  </div>
                </div>
              </section>
            </div>
          </div>
          <div class="Polaris-Modal-Footer">
            <div class="Polaris-Modal-Footer__FooterContent">
              <div class="Polaris-Stack Polaris-Stack--alignmentCenter">
                <div class="Polaris-Stack__Item Polaris-Stack__Item--fill"></div>
                <div class="Polaris-Stack__Item">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="Polaris-Backdrop BXLOADER" style="display:none;"></div>

<script>


function readURL(input) {
  var UploadURL ='<?=base_url()."Home/UploadFiles?shop=".$shop."&shop_id=".$shop_id?>';
  if (input.files && input.files[0]) {
    var FileName = $(input).data('select')
    var file_data = input.files[0];
    var form_data = new FormData();
    form_data.append(FileName, file_data);
    $('.UPDLoader').show();
    $.ajax({
           url: UploadURL,
           type: "POST",
           data: form_data,
           contentType: false,
           cache: false,
           processData: false,
           dataType:'json',
           success: function(data) {
             $(input).parents('.Polaris-FormLayout__Item').find('.afterUpload').show();
             $('.'+data.key).val(data.src)
             $(input).parents('.Polaris-FormLayout__Item').find('#loadImage').attr('src',data.src);
             $('.UPDLoader').hide();
           }
       });
  }
}

  $('.chkbxs').on('change',function(){
    var ToggleDiv = $(this).data('show');
    $("#"+ToggleDiv).slideToggle();
  });

$("#ButtonForSubmit").click(function(){
    var ActionURL ='<?=base_url()."Home/SaveCreatedCard?shop=".$shop."&shop_id=".$shop_id?>';
    var Submit = true;
    $('.txt-input:visible').each(function(ind,txbx){
      if($(txbx).val() == ""){
        $(txbx).css("border","1px solid red");
          Submit = false;
        }else{
          $(txbx).css("border","1px solid #c1ccd3");
      }
    });
    var ImageError = false
    $('.bxImages').each(function(ind,txbx){
      if($(txbx).val() == ""){
        Submit = false;
        ImageError = true;
      }
    });
    if(ImageError){
      $('.imageError').fadeIn('1000').fadeOut('5000');
    }
    if(Submit){
      $('.BXLOADER').show();
      $.ajax({
          type: 'POST',
          url: ActionURL,
          data: $('#bxform1, #bxform2').serialize(),
          dataType: 'json',
          success: function(response){
            $('.BXLOADER').hide();
            if(response.code == 200){
              ShopifyApp.flashNotice(response.msg);
            }else{
              ShopifyApp.flashError(response.msg);
            }
            window.location.href = "<?=base_url()."Home/LoadCretedCardList?shop=".$shop."&shop_id=".$shop_id?>"
          }
      });
    }else{
        ShopifyApp.flashError("Please Fill All Requird Fields");
    }

})
</script>
