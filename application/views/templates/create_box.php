<style>
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
  position: relative;
}
.color-box {
height: 32px;
width: 10%;
float: left;
margin-bottom: 10px;
}
span.close {
  color: #fff;
  position: absolute;
  top: -1px;
  right: -1px;
  background: #ff0017;
  width: 19px;
  font-size: 13px;
  line-height: 16px;
  text-align: center;
  margin: 0 auto;
  cursor: pointer;
}
.cutom-box-width {
  display: initial;
}
</style>
<div class="Polaris-Layout__AnnotatedSection">
   <div class="Polaris-Layout__AnnotationWrapper">
      <div class="Polaris-Layout__Annotation">
         <div class="Polaris-TextContainer">
            <h2 class="Polaris-Heading">Box details</h2>
            <div class="Polaris-Layout__AnnotationDescription">
               <p>Box Basic Details.</p>
            </div>
         </div>
      </div>

      <div class="Polaris-Layout__AnnotationContent">
          <form id="bxform1" class="individualForm">
         <div class="Polaris-Card">
            <div class="Polaris-Card__Section">
               <div class="Polaris-FormLayout">
                  <div class="Polaris-FormLayout__Item">
                     <div class="">
                        <div class="Polaris-Labelled__LabelWrapper">
                           <div class="Polaris-Label">
                              <label id="PolarisTextField1Label" for="PolarisTextField1" class="Polaris-Label__Text">
                                    Box Name
                              </label>
                           </div>
                        </div>
                        <div class="Polaris-Connected">
                           <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                              <div class="Polaris-TextField Polaris-TextField--hasValue">
                                 <input id="PolarisTextField1" class="Polaris-TextField__Input txt-input"  type="text" name="bx_title"     >
                                 <div class="Polaris-TextField__Backdrop"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="Polaris-FormLayout__Item">
                     <div  style="width:100%;display: flex;">
                        <div  style="width:20%;">
                           <div class="Polaris-Labelled__LabelWrapper">
                              <div class="Polaris-Label">
                                 <label id="PolarisTextField2Label" for="PolarisTextField2" class="Polaris-Label__Text">
                                    Box Colors
                                 </label>
                              </div>
                           </div>
                           <div class="Polaris-Connected">
                              <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                 <div class="Polaris-TextField Polaris-TextField--hasValue" style="width: 75%;">
                                    <input id="PolarisTextField2" class="Polaris-TextField__Input colorInput"
                                       type="color" style="cursor:pointer;"
                                       aria-labelledby="PolarisTextField2Label" aria-invalid="false" aria-multiline="false">
                                    <div class="Polaris-TextField__Backdrop"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div style="width:40%;">
                           <fieldset class="Polaris-ChoiceList" id="PolarisChoiceList14" aria-invalid="false">
                                  <legend class="Polaris-ChoiceList__Title">Include Box Price</legend>
                                  <label class="Polaris-Choice" for="PolarisRadioButton35">
                                      <span class="Polaris-Choice__Control">
                                          <span class="Polaris-RadioButton">
                                              <input id="PolarisRadioButton35"
                                              name="inc_box_price" type="radio" checked class="Polaris-RadioButton__Input box_price" value="yes"    >
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
                        <div style="width:40%;" id="show_price">
                           <div class="Polaris-Labelled__LabelWrapper">
                              <div class="Polaris-Label">
                                 <label id="PolarisTextField2Label" for="PolarisTextField2" class="Polaris-Label__Text">
                                    Box Price
                                 </label>
                              </div>
                           </div>
                           <div class="Polaris-Connected">
                              <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                 <div class="Polaris-TextField Polaris-TextField--hasValue">
                                    <input onkeypress="validateText(event)" name="bx_price"
                                      id="PolarisTextField2"
                                     class="Polaris-TextField__Input txt-input" type="text"  >
                                    <div class="Polaris-TextField__Backdrop"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="Polaris-FormLayout__Item">
                     <div class="Polaris-Connected">
                        <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                           <div class="Polaris-TextField Polaris-TextField--hasValue cutom-box-width">
                            <div class="colors">
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
            <h2 class="Polaris-Heading">Box Images</h2>
            <div class="Polaris-Layout__AnnotationDescription">
               <p>Upload Box Images(Visible on Storefront).</p>
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
                              <span class="afterUpload" style="display:none;">
                                    <img width="100" height="100" src="<?=base_url('assets/images/double-arrow.png') ?>" alt="">
                                    <img width="100" id="loadImage" class="thumb" height="100" src="<?=base_url('assets/images/no-image.png') ?>" alt="">
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

                                 <input type="hidden" name="before_image" class="before_image bxImages">
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
                        <span class="afterUpload" style="display:none;">
                            <img width="100" height="100" src="<?=base_url('assets/images/double-arrow.png') ?>" alt="">
                            <img width="100" id="loadImage" class="thumb" height="100" src="<?=base_url('assets/images/no-image.png') ?>" alt="">
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

                                 <input type="hidden" name="after_image" class="after_image before_image">
                                 <div class="Polaris-TextField__Backdrop"></div>
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


<!-- Box Conditions-->
<div class="Polaris-Layout__AnnotatedSection">
   <div class="Polaris-Layout__AnnotationWrapper">
      <div class="Polaris-Layout__Annotation">
         <div class="Polaris-TextContainer">
            <h2 class="Polaris-Heading">Box Contents</h2>
            <div class="Polaris-Layout__AnnotationDescription">
               <p>Add Limitations for contents added In the Box</p>
            </div>
         </div>
      </div>
      <div class="Polaris-Layout__AnnotationContent">
        <form id="bxform3" class="individualForm">
         <div class="Polaris-Card">
            <div class="Polaris-Card__Section">
               <div class="Polaris-FormLayout">
                  <div class="Polaris-FormLayout__Item">
                     <div class="">
                        <div class="Polaris-Labelled__LabelWrapper">
                           <div class="Polaris-Label">
                             <label  style="color:red; font-size:20px; display:none;" class="Polaris-Label__Text contentsError">
                               Please Select Box Contents Limit
                             </label>
                             <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Box Contents Limit</label>
                           </div>
                        </div>
                        <label class="Polaris-Choice" for="PolarisCheckbox2">
                            <span class="Polaris-Choice__Control">
                              <span class="Polaris-Checkbox">
                              <input id="PolarisCheckbox2" type="checkbox"  name="productCount" data-show="MaxProduct" class="Polaris-Checkbox__Input chkbxs">
                              <span class="Polaris-Checkbox__Backdrop"></span>
                                <span class="Polaris-Checkbox__Icon">
                                    <span class="Polaris-Icon">
                                      <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                        <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                      </svg>
                                    </span>
                                </span>
                              </span>
                          </span>
                          <span class="Polaris-Choice__Label">Product Count in The Box</span>
                        </label>
                        <label class="Polaris-Choice" for="PolarisCheckbox3">
                            <span class="Polaris-Choice__Control">
                              <span class="Polaris-Checkbox">
                              <input id="PolarisCheckbox3" data-show="MaxPrice" type="checkbox"
                                class="Polaris-Checkbox__Input chkbxs" name="BoxPrice"
                                >
                              <span class="Polaris-Checkbox__Backdrop"></span>
                                <span class="Polaris-Checkbox__Icon">
                                    <span class="Polaris-Icon">
                                      <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                        <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                      </svg>
                                    </span>
                                </span>
                              </span>
                          </span>
                          <span class="Polaris-Choice__Label">Box Total</span>
                        </label>
                     </div>
                  </div>
                  <div class="Polaris-FormLayout__Item" style="display:none;"  id="MaxProduct">
                     <div class="">
                        <div class="Polaris-Labelled__LabelWrapper">
                           <div class="Polaris-Label">
                              <label  for="MaxProductInput" class="Polaris-Label__Text">
                                Maximum Number Of Product
                              </label>
                           </div>
                        </div>
                        <div class="Polaris-Connected">
                           <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                              <div class="Polaris-TextField">
                                 <input onkeypress="validateText(event)"
                                 id="MaxProductInput" class="Polaris-TextField__Input txt-input"  name="max_product"   type="text">
                                 <div class="Polaris-TextField__Backdrop"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="Polaris-FormLayout__Item"  style="display:none;"  id="MaxPrice">
                     <div class="">
                        <div class="Polaris-Labelled__LabelWrapper">
                           <div class="Polaris-Label">
                              <label  for="MaxPriceInput" class="Polaris-Label__Text">Maximum Box price</label>
                           </div>
                        </div>
                        <div class="Polaris-Connected">
                           <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                              <div class="Polaris-TextField">
                                 <input id="MaxPriceInput" onkeypress="validateText(event)"
                                 name="max_price" class="Polaris-TextField__Input txt-input" type="text" >
                                 <div class="Polaris-TextField__Backdrop"></div>
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


<!-- Box Gifts Section -->
<div class="Polaris-Layout__AnnotatedSection">
   <div class="Polaris-Layout__AnnotationWrapper">
      <div class="Polaris-Layout__Annotation">
         <div class="Polaris-TextContainer">
            <h2 class="Polaris-Heading">Box Gifts Selection</h2>
            <div class="Polaris-Layout__AnnotationDescription">
               <p>Box Gifts are selected on the basis of</p>
            </div>
         </div>
      </div>
      <div class="Polaris-Layout__AnnotationContent">
        <form id="bxform4" class="individualForm">
         <div class="Polaris-Card">
            <div class="Polaris-Card__Section">
               <div class="Polaris-FormLayout">
                  <div class="Polaris-FormLayout__Item">
                     <div class="">

                        <div class="Polaris-Labelled__LabelWrapper">
                           <div class="Polaris-Label">
                             <label  style="color:red; font-size:20px; display:none;" class="Polaris-Label__Text giftError">
                               Please Select Gift Selection Basis
                             </label>
                             <label  style="color:red; font-size:20px; display:none;" class="Polaris-Label__Text giftContentError">
                               Please Select Collection/Products
                             </label>
                              <label id="PolarisTextField5Label" for="PolarisTextField4" class="Polaris-Label__Text">
                                Gift Selection Basis
                              </label>
                           </div>
                        </div>

                        <label class="Polaris-Choice" for="PolarisRadioButton41">
                            <span class="Polaris-Choice__Control">
                              <span class="Polaris-RadioButton">
                              <input id="PolarisRadioButton41"
                              type="radio"
                              name="product_select"
                              value="collection"
                              data-show="SelectCollection"
                              class="Polaris-RadioButton__Input rdbtns">
                              <span class="Polaris-RadioButton__Backdrop"></span>
                                <span class="Polaris-RadioButton__Icon">
                                    <span class="Polaris-Icon">
                                      <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                        <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                      </svg>
                                    </span>
                                </span>
                              </span>
                          </span>
                          <span class="Polaris-Choice__Label">Collection</span>
                        </label>

                        <label class="Polaris-Choice" for="PolarisRadioButton42">
                            <span class="Polaris-Choice__Control">
                              <span class="Polaris-RadioButton">
                              <input id="PolarisRadioButton42"
                              type="radio" name="product_select"
                              data-show="SelectProduct"
                              class="Polaris-RadioButton__Input rdbtns"
                              value="product"
                              >
                              <span class="Polaris-RadioButton__Backdrop"></span>
                                <span class="Polaris-RadioButton__Icon">
                                    <span class="Polaris-Icon">
                                      <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                        <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                      </svg>
                                    </span>
                                </span>
                              </span>
                          </span>
                          <span class="Polaris-Choice__Label">Products</span>
                        </label>

                        <label class="Polaris-Choice" for="PolarisRadioButton43">
                            <span class="Polaris-Choice__Control">
                              <span class="Polaris-RadioButton">
                              <input id="PolarisRadioButton43"
                               type="radio"
                               name="product_select"
                               data-show="SelectTags"
                               value="tag"
                               class="Polaris-RadioButton__Input rdbtns">
                              <span class="Polaris-RadioButton__Backdrop"></span>
                                <span class="Polaris-RadioButton__Icon">
                                    <span class="Polaris-Icon">
                                      <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                        <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.437.437 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                      </svg>
                                    </span>
                                </span>
                              </span>
                          </span>
                          <span class="Polaris-Choice__Label">Tags</span>
                        </label>

                     </div>
                  </div>



                  <div class="Polaris-FormLayout__Item productSelectors" style="display:none;" id="SelectCollection">
                     <div class="">
                        <div class="Polaris-Connected">
                             <div class="Polaris-DataTable">
                                <div class="Polaris-DataTable__ScrollContainer">
                                   <table class="Polaris-DataTable__Table">
                                      <thead>
                                         <tr>
                                            <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">
                                              Image
                                            </th>
                                            <td data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">
                                              Collection Title
                                            </td>
                                            <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">
                                              Action
                                            </th>
                                         </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                   </table>
                                </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="Polaris-FormLayout__Item productSelectors" style="display:none;" id="SelectProduct">
                     <div class="">
                        <div class="Polaris-Connected">
                            <div class="Polaris-DataTable">
                              <div class="Polaris-DataTable__ScrollContainer">
                                 <table class="Polaris-DataTable__Table">
                                    <thead>
                                       <tr>
                                          <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">Image</th>
                                          <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Product Title</th>
                                          <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Price</th>
                                          <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="Polaris-FormLayout__Item productSelectors"  style="display:none;"   id="SelectTags">
                     <div class="">
                        <div class="Polaris-Labelled__LabelWrapper">
                           <div class="Polaris-Label">
                              <label for="" class="Polaris-Label__Text">Tags in Comma Separated Form</label>
                           </div>
                        </div>
                        <div class="Polaris-Connected">
                           <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                              <div class="Polaris-TextField">
                                 <input  class="Polaris-TextField__Input tag_input" type="text">
                                 <div class="Polaris-TextField__Backdrop"></div>
                              </div>
                           </div>
                        </div>
                        <div class="tagsselected" style="margin-top: 3%;">
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
                                          <span class="Polaris-Button__Text">Save</span>
                                          </span>
                                    </button>
                                    <button style="display:none;" type="button" class="Polaris-Button Polaris-Button--disabled Polaris-Button--loading" disabled="" role="alert" aria-busy="true">
                                       <span class="Polaris-Button__Content">
                                          <span class="Polaris-Button__Spinner">
                                             <span class="Polaris-Spinner Polaris-Spinner--colorInkLightest Polaris-Spinner--sizeSmall">
                                                <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M7.229 1.173a9.25 9.25 0 1011.655 11.412 1.25 1.25 0 10-2.4-.698 6.75 6.75 0 11-8.506-8.329 1.25 1.25 0 10-.75-2.385z">
                                                   </path>
                                                </svg>
                                             </span>
                                             <span role="status">
                                             <span class="Polaris-VisuallyHidden">Loading</span></span>
                                          </span>
                                          <span class="Polaris-Button__Text">Save product</span>
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
              <h2 class="Polaris-DisplayText Polaris-DisplayText--sizeSmall">Saving</h2>
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
                  <p>Please Wait While Saving Box.</p>
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

function CreateProductsHtml(products) {
  var html = "";
  var shop = '<?=$shop?>';
  for (var i = 0; i < products.length; i++) {
    var product = products[i];
    html+='<tr class="Polaris-DataTable__TableRow" id="pr'+product.id+'">';
    html+='<th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">';
    html+='<input type="hidden" name="bx_gift_products[]" value="'+product.id+'">';
    html+='<a href="'+product.image.src+'" target="_blank"><span class="Polaris-Thumbnail Polaris-Thumbnail--sizeMedium">';
    html+='<img src="'+product.image.src+'" alt="'+product.image.alt+'" class="Polaris-Thumbnail__Image"></span></a></th>';
    html+='<td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"><a target="_blank" href="https://'+shop+'/admin/products/'+product.id+'">'+product.title+'</a></td>';
    html+='<td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">'+product.variants[0].price+'</td>';
    html+='<td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"><span style="cursor:pointer" class="removeCollection">&#215;</span></td>';
    html+='</tr>';
  }
  $("#SelectProduct").show();
  $("#SelectProduct table tbody").html(html);
}

$(".tag_input").on({
    focusout: function() {
        var txt = this.value.replace(/[^0-9a-zA-Z?/ ]/gi, "");
        if (txt) {
          var tag='<span class="Polaris-Tag" style="margin-right: 2%;">';
          tag+='<input type="hidden" name="tags[]" value="'+txt+'"><span title="'+txt+'" class="Polaris-Tag__TagText">'+txt+'</span>&nbsp;&nbsp;<span style="cursor:pointer" class="remove_tag">&#215;</span></span>';
          $('.tagsselected').append(tag);
        }
        this.value = "";
    },
    keyup: function(ev) {
        if (/(188|13)/.test(ev.which)) $(this).focusout();
    }
});


$(document).on('click','.remove_tag',function() {
    $(this).parents('.Polaris-Tag').remove();
});




$(document).on('click','.removeCollection',function(){
  $(this).closest('tr').remove();
});

function OpenProductPicker(){
  ShopifyApp.Modal.productPicker( {selectMultiple: true}, function(success, data) {
    if (!success) {
      return;
    }
    if (data.products.length > 0) {
      var selectedProducts = data.products;
      CreateProductsHtml(selectedProducts)
    }
    if (data.errors) {
      console.error(data.errors);
    }
  });
}

function CreateCollectionHtml(selectedProducts) {
  var shop = '<?=$shop?>';
  var Html = "";
  for (var i = 0; i < selectedProducts.length; i++) {
    var Image = '<svg style="height:50px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">';
    Image+='<path fill="#637381" d="M19 0H1a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zM8 6c.551 0 1 .449 1 1 0 .551-.449 1-1 1-.551 0-1-.449-1-1 0-.551.449-1 1-1m0 4c1.654 0 3-1.346 3-3S9.654 4 8 4 5 5.346 5 7s1.346 3 3 3m-6 8v-2.434l3.972-2.383 2.473 1.649a1 1 0 0 0 1.262-.125l4.367-4.367L18 13.48V18H2zM18 2v8.919l-3.375-2.7a1 1 0 0 0-1.332.074l-4.42 4.42-2.318-1.545a1 1 0 0 0-1.07-.025L2 13.234V2h16z"/>';
    Image+='</svg>';
    var collection = selectedProducts[i];
    if(collection.image !== null && collection.image !== ''){
      Image ='<a href="'+collection.image.src+'" target="_blank"><span class="Polaris-Thumbnail Polaris-Thumbnail--sizeMedium">';
      Image+='<img src="'+collection.image.src+'" alt="'+collection.image.alt+'" class="Polaris-Thumbnail__Image"></span></a>';
    }
    Html+= '<tr class="Polaris-DataTable__TableRow" id="cls'+collection.id+'">';
    Html+= '<input type="hidden" name="collection_handle" value="'+collection.handle+'">';
    Html+= '<input type="hidden" name="collection_data" value=\''+JSON.stringify(collection)+'\'>';
    Html+= '<th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">'+Image+'</th>';
    Html+= '<td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"><a target="_blank" href="https://'+shop+'/admin/collections/'+collection.id+'">'+collection.title+'</a></td>';
    Html+= '<td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"><span style="cursor:pointer" class="removeCollection">&#215;</span></td>';
    Html+= '</tr>';
  }
  $("#SelectCollection").show();
  $("#SelectCollection table tbody").html(Html);
}

function OpenCollectionPicker() {
    ShopifyApp.Modal.collectionPicker({selectMultiple: false}, function(success,data){
      if (!success) {
        return;
      }
      if (data.collections.length > 0) {
        var selectedProducts = data.collections;
        CreateCollectionHtml(selectedProducts);
      }
      if (data.errors) {
        console.error(data.errors);
      }
    });
}

$('.rdbtns').on('click', function(event) {
  $('.productSelectors').hide();
  var ToggleDiv = $(this).data('show');
  if(ToggleDiv == 'SelectTags') {
    $("#"+ToggleDiv).show();
  } else {
    switch (ToggleDiv) {
      case 'SelectCollection':
      OpenCollectionPicker();
      break;
      case 'SelectProduct':
      OpenProductPicker();
      break;
      default:
    }
  }
});


function ReturnSelectedColor(color){
  var MHT ='<div class="color swatch-box" style="background:'+color+'">';
  MHT+='<input type="hidden" name="Boxcolors[]" value="'+color+'">';
  MHT+='<span class="close removeColor">&#215;</span>';
  MHT+='</div>';
  return MHT;
}
  $(document).on('click','.removeColor',function(){
    $(this).parents('.color').remove();
  });
$(".colorInput").on('change',function(){
  var show_box_price = $(this).val();
  $('.colors').append(ReturnSelectedColor(show_box_price));
  $(this).val(null)
});


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
  var ActionURL ='<?=base_url()."Home/SaveBoxes?shop=".$shop."&shop_id=".$shop_id?>';
  var Submit = true;
  $('.txt-input:visible').each(function(ind,txbx){
    if($(txbx).val() == ""){
      $(txbx).css("border","1px solid red");
      Submit = false;
    } else {
      $(txbx).css("border","1px solid #c1ccd3");
    }
  });

  var ImageError = false;
  $('.bxImages').each(function(ind,txbx){
    if($(txbx).val() == ""){
      Submit = false;
      ImageError = true;
    }
  });
  if(ImageError){
    $('.imageError').fadeIn('1000').fadeOut('5000');
  }

  var contentsError = false;
  $('.chkbxs').each(function(i, chbx) {
    if($(this).prop("checked") == false) {
      Submit = false;
      contentsError = true;
    } else {
      Submit = true;
      contentsError = false;
      return false;
    }
  });
  if(contentsError) {
    $('.contentsError').fadeIn('1000').fadeOut('5000');
  }

  var giftError = false;
  var rdbtn_val = '';
  $('.rdbtns').each(function(i, rdbtn) {
    if($(this).prop('checked') == false) {
      Submit = false;
      giftError = true;
    } else {
      Submit = true;
      giftError = false;
      rdbtn_val = $(this).val();
      return false;
    }
  });
  if (giftError) {
    $('.giftError').fadeIn('1000').fadeOut('5000');
  }

  var collection_handle = $('input[name="collection_handle"]');
  var bx_gift_products = $('input[name="bx_gift_products[]"]');

  if (rdbtn_val == 'collection' && !collection_handle.length) {
    Submit = false;
    $('.giftContentError').fadeIn('1000').fadeOut('5000');
  } else if (rdbtn_val == 'product' && !bx_gift_products.length) {
    Submit = false;
    $('.giftContentError').fadeIn('1000').fadeOut('5000');
  } else if (rdbtn_val == 'tag') {
    var tagsselected = $('.tagsselected').children().length;
    if (tagsselected == 0) {
      Submit = false;
      $('.giftContentError').fadeIn('1000').fadeOut('5000');
    }
  }

  if(Submit) {
    $('.BXLOADER').show();
    $.ajax({
      type: 'POST',
      url: ActionURL,
      data: $('#bxform1, #bxform2, #bxform3, #bxform4').serialize(),
      dataType: 'json',
      success: function(response) {
        $('.BXLOADER').hide();
        if(response.code == 200) {
          ShopifyApp.flashNotice(response.msg);
        } else {
          ShopifyApp.flashError(response.msg);
        }
        window.location.href = "<?=base_url()."Home/LoadBoxView?shop=".$shop."&shop_id=".$shop_id?>"
      }
    });
  } else {
    ShopifyApp.flashError("Please Fill All Requird Fields");
  }
});
</script>
