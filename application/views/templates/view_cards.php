<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

.slider.round {
  border-radius: 34px;
}
.slider.round:before {
  border-radius: 50%;
}
.swatch-box {
  float: left;
  margin-right: 5px;
  margin-bottom: 5px;
  border: 1px solid #222;
  text-align: center;
}
.color.swatch-box {
  width: 10%;
  padding: 15px;
}
#myTable_filter label{color: #716b6b;}
#myTable_filter input {border: none;border-bottom: 1px solid #ddd;}
#myTable_length label{color: #716b6b;}
#myTable{border: 0px;margin-bottom: 10px;}
.Polaris-DataTable__Table > thead > tr > th {
   border: 0px;
   padding: 15px;
   border-bottom: 1px solid #ddd;
   color: #716b6b;
}
.Polaris-DataTable__Table > tbody > tr > td {
   border: 0px;
   padding: 15px;
   border-bottom: 1px solid #ddd;
   color: #716b6b;
   width: 13%;
}
#myTable_wrapper{
  margin: 5%;
}
table.dataTable{margin: unset;}
</style>
<div class="Polaris-Card" style="margin-top:3%">
  <div class="">
    <div class="Polaris-DataTable">
      <div class="Polaris-DataTable__ScrollContainer">


        <table id="myTable" class="Polaris-DataTable__Table">
              <thead>
                <tr>
                  <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">
                    Card Before Image
                  </th>
                  <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">
                    Card After Image
                  </th>
                  <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">
                    Card Title
                  </th>
                  <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">
                    Card Price
                  </th>
                  <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">
                    Status
                  </th>
                  <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">
                    Action
                  </th>
                </tr>
              </thead>

              <tbody>
                <?php foreach ($Cards as $key => $box) { ?>
                  <tr class="Polaris-DataTable__TableRow">
                  <td style="text-align:center" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">
                    <a href="<?=$box->card_before_image?>" target="_blank">
                      <img style="height:50px;width:50px" src="<?=$box->card_before_image?>">
                    </a>
                  </td>
                  <td style="text-align:center" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">
                    <a href="<?=$box->card_after_image?>" target="_blank">
                      <img style="height:50px;width:50px" src="<?=$box->card_after_image?>">
                    </a>
                  </td>
                  <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">
                    <a target="_blank" href="https://<?=$shop?>/admin/products/<?=$box->shopify_product_id?>">
                      <?=$box->card_title?>
                    </a>
                  </td>
                  <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">
                    <?=$box->card_price?>
                  </td>
                  <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">
                        <label class="switch">
                          <input  data-id="<?=$box->id?>"  class="chkbs" type="checkbox" <?=(($box->status== 1) ? 'checked' : "")?>>
                          <span class="slider round"></span>
                        </label>
                  </td>
                  <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">
                        <a style="text-decoration:none;" href="<?=base_url()."Home/LoadEditCard?card_id=".$box->id."&shop=".$shop."&shop_id".$shop_id?>">
                          <i style="padding-right: 5px;font-size:25px;" class="fa fa-edit"></i>
                        </a>
                        <a class="del_btn" style="cursor:pointer;" data-id="<?=$box->id?>" >
                          <i style="color:red;font-size:25px;" class="fa fa-trash">
                          </i>
                        </a>
                  </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
      </div>
    </div>
  </div>
</div>




   <div class="Polaris-Modal-Dialog__Container undefined deleteModel" style="display:none;" data-polaris-layer="true" data-polaris-overlay="true">
      <div>
         <div role="dialog" aria-labelledby="modal-header12" tabindex="-1" class="Polaris-Modal-Dialog">
            <div class="Polaris-Modal-Dialog__Modal">
               <div class="Polaris-Modal-Header">
                  <div id="modal-header12" class="Polaris-Modal-Header__Title">
                     <h2 class="Polaris-DisplayText Polaris-DisplayText--sizeSmall">Delete box</h2>
                  </div>
                  <button class="Polaris-Modal-CloseButton Closedelete"  aria-label="Close">
                     <span class="Polaris-Icon Polaris-Icon--colorInkLighter Polaris-Icon--isColored">
                        <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                           <path d="M11.414 10l6.293-6.293a.999.999 0 1 0-1.414-1.414L10 8.586 3.707 2.293a.999.999 0 1 0-1.414 1.414L8.586 10l-6.293 6.293a.999.999 0 1 0 1.414 1.414L10 11.414l6.293 6.293a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414L11.414 10z" fill-rule="evenodd"></path>
                        </svg>
                     </span>
                  </button>
               </div>
               <div class="Polaris-Modal__BodyWrapper">
                  <div class="Polaris-Modal__Body Polaris-Scrollable Polaris-Scrollable--vertical" data-polaris-scrollable="true">
                     <section class="Polaris-Modal-Section">
                        <div class="Polaris-TextContainer">
                           <p>Are you sure to delete The Box ?</p>
                        </div>
                     </section>
                  </div>
               </div>
               <div class="Polaris-Modal-Footer">
                  <div class="Polaris-Modal-Footer__FooterContent">
                     <div class="Polaris-Stack Polaris-Stack--alignmentCenter">
                        <div class="Polaris-Stack__Item Polaris-Stack__Item--fill"></div>
                        <div class="Polaris-Stack__Item">
                           <div class="Polaris-ButtonGroup">
                              <div class="Polaris-ButtonGroup__Item">
                                      <button type="button" class="Polaris-Button Closedelete">
                                        <span class="Polaris-Button__Content">
                                          <span class="Polaris-Button__Text">
                                            Cancel
                                          </span>
                                      </span>
                                    </button>
                                </div>
                              <div class="Polaris-ButtonGroup__Item">
                                <button type="button" class="Polaris-Button Polaris-Button--destructive cofirmDelete">
                                  <span class="Polaris-Button__Content">
                                    <span class="Polaris-Button__Text">Yes Delete</span>
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
<div class="Polaris-Backdrop deleteModel" style="display:none;"></div>


<div>
  <div class="Polaris-Modal-Dialog__Container undefined BXLOADER" style="display:none;"  data-polaris-layer="true" data-polaris-overlay="true">
    <div>
      <div role="dialog" aria-labelledby="modal-header12" tabindex="-1" class="Polaris-Modal-Dialog">
        <div class="Polaris-Modal-Dialog__Modal">
          <div class="Polaris-Modal-Header">
            <div id="modal-header12" class="Polaris-Modal-Header__Title">
              <h2 class="Polaris-DisplayText Polaris-DisplayText--sizeSmall">Deleting</h2>
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
                  <p>Please Wait While Deleting</p>
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
$('.chkbs').on('change',function(){
    var NewStatus = 0;
    if($(this).prop('checked') == true){
       NewStatus = 1;
    }
    var UpDateURL ='<?=base_url()."Home/UpdateStatus?shop=".$shop."&shop_id=".$shop_id?>';
    $.ajax({
        type: 'POST',
        url: UpDateURL,
        data: {id : $(this).data('id'),status:NewStatus,table:'tbl_card'},
        dataType: 'json',
        success: function(response){
            ShopifyApp.flashNotice(response.msg);
             location.reload();
        }
    });
});
$('.Closedelete').on('click',function(){
  $('.deleteModel').hide();
})
$('.del_btn').on('click',function(){
    window.deleteId =  $(this).data('id');
  $('.deleteModel').show();
});

$('.cofirmDelete').on('click',function(){
  var DeleteURL  ='<?=base_url()."Home/DeleteFromApp?shop=".$shop."&shop_id=".$shop_id?>';
  $('.deleteModel').hide()
  $('.BXLOADER').show();
  $.ajax({
      type: 'POST',
      url: DeleteURL,
      data: {id:window.deleteId,table:'tbl_card'},
      dataType: 'json',
      success: function(response){
          $('.BXLOADER').hide();
          ShopifyApp.flashNotice(response.msg);
          location.reload();
      }
  });
});

  $(document).ready(function(){
    $('#myTable').DataTable( {
        "lengthChange": false,
        "ordering": false,
    });
  })
</script>
