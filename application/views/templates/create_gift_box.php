<style media="screen">
  body{
    font-family: -apple-system,BlinkMacSystemFont,San Francisco,Roboto,Segoe UI,Helvetica Neue,sans-serif!important;
    background-color: #7d7c7c0f;
  }

</style>
<div class="Polaris-Card" style="background: #7d7c7c00;">
  <div>
    <div class="Polaris-Tabs__Wrapper">
      <ul role="tablist" class="Polaris-Tabs">
        <li class="Polaris-Tabs__TabContainer"><a class="Polaris-Tabs__Tab" href="<?php echo base_url(); ?>Home/Dashboard?shop=<?php echo $shop; ?>"><span class="Polaris-Tabs__Title">Dashboard</span></a></li>
        <li class="Polaris-Tabs__TabContainer"><a class="Polaris-Tabs__Tab Polaris-Tabs__Tab--selected" href="<?php echo base_url(); ?>Home/create_gift_box?shop=<?php echo $shop; ?>" ><span class="Polaris-Tabs__Title">Create Gift Box</span></a></li>
      </ul>
    </div>
  </div>
</div>
<div class="container" style="margin-top: 30px;">
  <div class="Polaris-Card">
  <div class="setting_card">
    <div class="cont">
      <div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;">
        <form enctype="multipart/form-data" method="post">
          <div class="Polaris-FormLayout">
            <div class="Polaris-FormLayout__Item">
              <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-6">
                  <div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;">
                    <div class="Polaris-Stack Polaris-Stack--vertical">
                      <div class="Polaris-Stack__Item">
                        <div><label class="Polaris-Choice" for="disabled"><span class="Polaris-Choice__Control"><span class="Polaris-RadioButton"><input id="disabled" value="Product Based" name="product_type" type="radio" class="inputProduct Polaris-RadioButton__Input" aria-describedby="disabledHelpText" value="" checked=""><span class="Polaris-RadioButton__Backdrop"></span><span class="Polaris-RadioButton__Icon"></span></span></span><span class="Polaris-Choice__Label">Product Based</span></label>
                          <div class="Polaris-Choice__Descriptions">
                            <div class="Polaris-Choice__HelpText" id="disabledHelpText">Choose Product Quantity e.g. 1 or 2, etc.</div>
                          </div>
                        </div>
                        <div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;margin-top: 30px;">
                          <div class="ShowProductField">
                            <div class="Polaris-Labelled__LabelWrapper">
                              <div class="Polaris-Label"><label id="PolarisTextField2Label" for="PolarisTextField2" class="Polaris-Label__Text">Add Product Count</label></div>
                            </div>
                            <div class="Polaris-Connected">
                              <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                <div class="Polaris-TextField Polaris-TextField--hasValue"><input id="inputAmoutField" name="productValue" type="text" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField2Label" value="" aria-invalid="false" aria-multiline="false" placeholder="e.g. 1 or 2">
                                  <div class="Polaris-TextField__Backdrop"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div id="errmsg"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;">
                    <div class="Polaris-Stack Polaris-Stack--vertical">
                      <div class="Polaris-Stack__Item">
                        <div><label class="Polaris-Choice" for="optional"><span class="Polaris-Choice__Control"><span class="Polaris-RadioButton"><input id="optional" name="product_type" value="Amount Based" type="radio" class="inputAmount Polaris-RadioButton__Input" aria-describedby="optionalHelpText" value=""><span class="Polaris-RadioButton__Backdrop"></span><span class="Polaris-RadioButton__Icon"></span></span></span><span class="Polaris-Choice__Label">Amount Based</span></label>
                          <div class="Polaris-Choice__Descriptions">
                            <div class="Polaris-Choice__HelpText" id="optionalHelpText">Choose Amount e.g. 100 or 200.</div>
                          </div>
                        </div>
                        <div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;margin-top: 30px;">
                          <div class="ShowAmountField" style="display:none;">
                            <div class="Polaris-Labelled__LabelWrapper">
                              <div class="Polaris-Label"><label id="PolarisTextField2Label" for="PolarisTextField2" class="Polaris-Label__Text">Add Amount</label></div>
                            </div>
                            <div class="Polaris-Connected">
                              <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                <div class="Polaris-TextField Polaris-TextField--hasValue"><input id="inputProductField" name="amountValue" type="text" value="" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField2Label" aria-invalid="false" aria-multiline="false" placeholder="e.g. 100 or 200">
                                  <div class="Polaris-TextField__Backdrop"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div id="errmsg1"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="_2uqHj" style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;">
                <div class="">
                  <div class="">
                    <img width="100" class="thumb" height="100" src="<?php echo base_url('assets/images/no-image.png') ?>" alt="">
                    <span class="afterUpload" style="display:none;">
                      <img width="100" height="100" src="<?php echo base_url('assets/images/double-arrow.png') ?>" alt="">
                      <img width="100" id="loadImage" class="thumb" height="100" src="<?php echo base_url('assets/images/no-image.png') ?>" alt="">
                    </span>
                  </div>
                </div>
                <div class="">
                  <div class="Polaris-Labelled__LabelWrapper">
                    <div class="Polaris-Label">
                      <label id="PolarisTextField2Label" for="PolarisTextField2" class="Polaris-Label__Text">Choose Gift Image</label>
                    </div>
                  </div>
                  <div class="Polaris-Connected" style="width: 48.5%;">
                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                      <div class="Polaris-TextField Polaris-TextField--hasValue"><input id="PolarisTextField2" onchange="readURL(this)" name="file" type="file" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField2Label" aria-invalid="false" aria-multiline="false" value="">
                        <div class="Polaris-TextField__Backdrop"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="Polaris-FormLayout__Item"><input type="submit" class="Polaris-Button" name="submit" value="Submit"></div>
        </form>
      </div>
    </div>
  </div>
  </div>
</div>
<script type="text/javascript">
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $('.afterUpload').show();
        $('#loadImage').attr('src', e.target.result)
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
