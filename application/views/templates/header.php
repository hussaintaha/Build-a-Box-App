<!doctype html>
<html class="no-js" lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Build A Box Admin</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="<?=base_url(); ?>assets/css/style.css" type="text/css" rel="stylesheet">
      <link href="<?=base_url(); ?>assets/css/font-awesome.min.css" type="text/css" rel="stylesheet">
      <link rel="stylesheet" href="https://unpkg.com/@shopify/polaris@4.17.0/styles.min.css"/>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
      <script src="https://cdn.shopify.com/s/assets/external/app.js"></script>
      <script type="text/javascript" src="<?=base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="<?=base_url(); ?>assets/js/app.js"></script>

      <script type="text/javascript">
         ShopifyApp.init({
           apiKey : '<?=$this->config->item('shopify_api_key'); ?>',
           shopOrigin : '<?='https://'.$_GET['shop'];?>'
         });
         var AppUrl = '<?=base_url(); ?>';
         function base_url(path) {
           var base_url = '<?=base_url(); ?>';
           if (path != '') {
             return base_url+path;
           }else{
             return base_url;
           }
         }
         var shop = '<?=$_GET['shop'];?>';
         var shop_id = '<?=shop_id($_GET['shop']);?>';
      </script>
      <?php $shop = $_GET['shop']; ?>
   </head>
   <body>

     <div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;">
        <span class="Polaris-Spinner Polaris-Spinner--colorTeal Polaris-Spinner--sizeLarge">
           <svg viewBox="0 0 44 44" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.542 1.487A21.507 21.507 0 00.5 22c0 11.874 9.626 21.5 21.5 21.5 9.847 0 18.364-6.675 20.809-16.072a1.5 1.5 0 00-2.904-.756C37.803 34.755 30.473 40.5 22 40.5 11.783 40.5 3.5 32.217 3.5 22c0-8.137 5.3-15.247 12.942-17.65a1.5 1.5 0 10-.9-2.863z"></path>
           </svg>
        </span>
        <span role="status">
        <span class="Polaris-VisuallyHidden">Spinner example</span>
        </span>
     </div>


      <div style="height: 500px;">
      <div style="--top-bar-background:#357997; --top-bar-color:rgb(255, 255, 255); --top-bar-border:rgb(196, 205, 213); --top-bar-background-lighter:hsla(198, 33%, 55%, 1); --p-frame-offset:0px;">
      <div class="Polaris-Frame Polaris-Frame--hasNav Polaris-Frame--hasTopBar" data-polaris-layer="true" data-has-navigation="true">
      <div class="Polaris-Frame__Skip"><a href="#AppFrameMainContent" class="Polaris-Frame__SkipAnchor">Skip to content</a></div>
      <div class="Polaris-Frame__TopBar" data-polaris-layer="true" data-polaris-top-bar="true" id="AppFrameTopBar">
         <div class="Polaris-TopBar">
            <button type="button" class="Polaris-TopBar__NavigationIcon" aria-label="Toggle menu">
               <span class="Polaris-Icon">
                  <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                     <path d="M19 11H1a1 1 0 1 1 0-2h18a1 1 0 1 1 0 2zm0-7H1a1 1 0 0 1 0-2h18a1 1 0 1 1 0 2zm0 14H1a1 1 0 0 1 0-2h18a1 1 0 1 1 0 2z"></path>
                  </svg>
               </span>
            </button>
            <div class="Polaris-TopBar__LogoContainer">
               <a target="_blank" class="Polaris-TopBar__LogoLink" style="width: 124px;"
                  href="https://www.vowelweb.com/" data-polaris-unstyled="true">
               <img src="<?=base_url().'assets/images/Logo.svg';?>" alt="Jaded Pixel" class="Polaris-TopBar__Logo" style="width: 124px;">
               </a>
            </div>
            <div class="Polaris-TopBar__Contents">
               <div class="Polaris-TopBar__SearchField">
                  <div style="visibility:hidden;"  class="Polaris-TopBar-SearchField">
                     <span class="Polaris-VisuallyHidden">
                     <label for="PolarisSearchField1">Search</label>
                     </span>
                     <input id="PolarisSearchField1" class="Polaris-TopBar-SearchField__Input" placeholder="Search" type="search" autocapitalize="off" autocomplete="off" autocorrect="off" value="">
                     <span class="Polaris-TopBar-SearchField__Icon">
                        <span class="Polaris-Icon">
                           <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                              <path d="M8 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8m9.707 4.293l-4.82-4.82A5.968 5.968 0 0 0 14 8 6 6 0 0 0 2 8a6 6 0 0 0 6 6 5.968 5.968 0 0 0 3.473-1.113l4.82 4.82a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414" fill-rule="evenodd"></path>
                           </svg>
                        </span>
                     </span>
                     <div class="Polaris-TopBar-SearchField__Backdrop"></div>
                  </div>
                  <div class="Polaris-TopBar-Search">
                     <div class="Polaris-TopBar-Search__Results">
                        <div class="Polaris-Card">
                           <div class="Polaris-ActionList">
                              <div class="Polaris-ActionList__Section--withoutTitle">
                                 <ul class="Polaris-ActionList__Actions">
                                    <li>
                                       <button type="button" class="Polaris-ActionList__Item">
                                          <div class="Polaris-ActionList__Content">Shopify help center</div>
                                       </button>
                                    </li>
                                    <li>
                                       <button type="button" class="Polaris-ActionList__Item">
                                          <div class="Polaris-ActionList__Content">Community forums</div>
                                       </button>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="Polaris-TopBar__SecondaryMenu"></div>
               <div style="display:none;">
                  <div class="Polaris-TopBar-Menu__ActivatorWrapper">
                     <button type="button" class="Polaris-TopBar-Menu__Activator" tabindex="0" aria-controls="Polarispopover1" aria-owns="Polarispopover1" aria-expanded="false">
                        <div class="Polaris-MessageIndicator__MessageIndicatorWrapper">
                           <span aria-label="Avatar with initials D" role="img" class="Polaris-Avatar Polaris-Avatar--sizeSmall Polaris-Avatar--styleThree">
                              <span class="Polaris-Avatar__Initials">
                                 <svg class="Polaris-Avatar__Svg" viewBox="0 0 40 40">
                                    <text x="50%" y="50%" dy="0.35em" fill="currentColor" font-size="20" text-anchor="middle">U</text>
                                 </svg>
                              </span>
                           </span>
                        </div>
                        <span class="Polaris-TopBar-UserMenu__Details">
                           <p class="Polaris-TopBar-UserMenu__Name">User</p>
                           <p class="Polaris-TopBar-UserMenu__Detail">Store User</p>
                        </span>
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div>
         <div class="Polaris-Frame__Navigation" id="AppFrameNav" hidden="">
            <nav class="Polaris-Navigation">
               <div class="Polaris-Navigation__PrimaryNavigation Polaris-Scrollable Polaris-Scrollable--vertical" data-polaris-scrollable="true">
                  <ul class="Polaris-Navigation__Section Polaris-Navigation__Section--withSeparator">
                     <li class="Polaris-Navigation__SectionHeading">
                        <span class="Polaris-Navigation__Text">Build A Box</span>
                        <button  style="visibility:hidden;" type="button" class="Polaris-Navigation__Action" aria-label="Contact support">
                           <span class="Polaris-Icon">
                              <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                 <path d="M13 11h2V9h-2v2zm-4 0h2V9H9v2zm-4 0h2V9H5v2zm5-9c-4.411 0-8 3.589-8 8 0 1.504.425 2.908 1.15 4.111l-1.069 2.495a1 1 0 0 0 1.314 1.313l2.494-1.069A7.939 7.939 0 0 0 10 18c4.411 0 8-3.589 8-8s-3.589-8-8-8z" fill-rule="evenodd"></path>
                              </svg>
                           </span>
                        </button>
                     </li>
                     <li class="Polaris-Navigation__ListItem">
                       <a  style="text-decoration:none;" href="<?=base_url()."Home/Dashboard?shop=".$shop?>" >
                        <button type="button" class="Polaris-Navigation__Item">
                           <div class="Polaris-Navigation__Icon">
                              <span class="Polaris-Icon">
                                 <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                    <path <?=((strtolower($PageName) == 'dashboard') ? 'fill="#1d249b"' : "")?> d="M19.664 8.252l-9-8a1 1 0 0 0-1.328 0L8 1.44V1a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v5.773L.336 8.252a1.001 1.001 0 0 0 1.328 1.496L2 9.449V19a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V9.449l.336.299a.997.997 0 0 0 1.411-.083 1.001 1.001 0 0 0-.083-1.413zM16 18h-2v-5a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v5H4V7.671l6-5.333 6 5.333V18zm-8 0v-4h4v4H8zM4 2h2v1.218L4 4.996V2z" fill-rule="evenodd"></path>
                                 </svg>
                              </span>
                           </div>
                           <span class="Polaris-Navigation__Text" <?=((strtolower($PageName) == 'dashboard') ? 'style="color:#1d249b"' : "")?> >Dashboard</span>
                        </button>
                      </a>
                     </li>
                     <li class="Polaris-Navigation__ListItem">
                    <a  style="text-decoration:none;" href="<?=base_url()."Home/LoadCreateBoxPage?shop=".$shop?>" >
                      <button type="button" class="Polaris-Navigation__Item">
                           <div class="Polaris-Navigation__Icon">
                              <span class="Polaris-Icon">
                                 <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                    <path fill="currentColor" d="M1 13h5l1 2h6l1-2h5v6H1z"></path>
                                    <path fill="<?=((strtolower($PageName) == 'create box') ? '#1d249b' : "#637381")?>" d="M19.492 11.897l-1.56-.88a7.8 7.8 0 0 0 0-2.035l1.56-.879a1.001 1.001 0 0 0 .37-1.38L17.815 3.26a1.001 1.001 0 0 0-1.353-.362l-1.491.841A8.078 8.078 0 0 0 13 2.586V1a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v1.586a8.053 8.053 0 0 0-1.97 1.152l-1.492-.84a1 1 0 0 0-1.352.361L.139 6.723a1.001 1.001 0 0 0 .37 1.38l1.559.88A7.829 7.829 0 0 0 2 10c0 .335.023.675.068 1.017l-1.56.88a.998.998 0 0 0-.37 1.38l2.048 3.464a.999.999 0 0 0 1.352.362l1.492-.842A7.99 7.99 0 0 0 7 17.413V19a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-1.587a8.014 8.014 0 0 0 1.97-1.152l1.492.842a1 1 0 0 0 1.353-.362l2.047-3.464a1.002 1.002 0 0 0-.37-1.38m-3.643-3.219c.1.448.15.893.15 1.322a6.1 6.1 0 0 1-.15 1.322 1 1 0 0 0 .484 1.09l1.287.725-1.03 1.742-1.252-.707a1 1 0 0 0-1.183.15 6.023 6.023 0 0 1-2.44 1.425 1 1 0 0 0-.715.96V18H9v-1.294a1 1 0 0 0-.714-.959 6.01 6.01 0 0 1-2.44-1.425 1.001 1.001 0 0 0-1.184-.15l-1.252.707-1.03-1.742 1.287-.726a.999.999 0 0 0 .485-1.089A6.043 6.043 0 0 1 4 10c0-.429.05-.874.152-1.322a1 1 0 0 0-.485-1.09L2.38 6.862 3.41 5.12l1.252.707a1 1 0 0 0 1.184-.149 6.012 6.012 0 0 1 2.44-1.426A1 1 0 0 0 9 3.294V2h2v1.294a1 1 0 0 0 .715.958c.905.27 1.749.762 2.44 1.426a1 1 0 0 0 1.183.15l1.253-.708 1.029 1.742-1.287.726a1 1 0 0 0-.484 1.09M9.999 6c-2.205 0-4 1.794-4 4s1.795 4 4 4c2.207 0 4-1.794 4-4s-1.793-4-4-4m0 6c-1.102 0-2-.897-2-2s.898-2 2-2c1.104 0 2 .897 2 2s-.896 2-2 2"/>
                                 </svg>
                              </span>
                           </div>
                           <span class="Polaris-Navigation__Text" <?=((strtolower($PageName) == 'create box') ? 'style="color:#1d249b"' : "")?>>Create Box</span>
                        </button>
                      </a>
                     </li>
                     <li class="Polaris-Navigation__ListItem">
                        <a  style="text-decoration:none;" href="<?=base_url()."Home/LoadBoxView?shop=".$shop?>" >
                        <button type="button" class="Polaris-Navigation__Item">
                           <div class="Polaris-Navigation__Icon">
                              <span class="Polaris-Icon">
                                 <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                    <path fill="currentColor" d="M1 13h5l1 2h6l1-2h5v6H1z"></path>
                                    <path d="M19.962 9.725C19.94 9.648 17.666 2 10 2S.06 9.648.038 9.725c-.05.18-.05.37 0 .55C.06 10.352 2.334 18 10 18s9.94-7.648 9.962-7.725c.05-.18.05-.37 0-.55zM10 16c-5.467 0-7.512-4.772-7.948-6C2.488 8.772 4.532 4 10 4c5.47 0 7.514 4.776 7.948 6-.435 1.228-2.48 6-7.948 6zm0-4c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zm0-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4z"
                                    fill="<?=((strtolower($PageName) == 'view sample boxes') ? '#1d249b' : "#637381")?>" />
                                 </svg>
                              </span>
                           </div>
                           <span class="Polaris-Navigation__Text"  <?=((strtolower($PageName) == 'view sample boxes') ? 'style="color:#1d249b"' : "")?> >View Boxes</span>
                        </button>
                          </a>
                     </li>
                     <li class="Polaris-Navigation__ListItem">


                      <a  style="text-decoration:none;" href="<?=base_url()."Home/LoadCreateCardView?shop=".$shop?>" >
                        <button type="button" class="Polaris-Navigation__Item">
                           <div class="Polaris-Navigation__Icon">
                              <span class="Polaris-Icon">
                                 <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                    <path fill="currentColor" d="M1 13h5l1 2h6l1-2h5v6H1z"></path>
                                    <path fill-rule="evenodd"
                                    fill="<?=((strtolower($PageName) == 'create card') ? '#1d249b' : "#637381")?>"
                                     d="M11 9h7V7h-7v2zm0 9h5v-7h-5v7zm-7 0h5v-7H4v7zM2 9h7V7H2v2zm2.75-5.5c0-.827.673-1.5 1.5-1.5 1.562 0 2.411 1.42 2.662 3H6.25c-.827 0-1.5-.673-1.5-1.5zM13 3a1.001 1.001 0 0 1 0 2h-1.887c.207-.964.738-2 1.887-2zm6 2h-3.185c.113-.314.185-.647.185-1 0-1.654-1.346-3-3-3-1.243 0-2.202.567-2.871 1.425C9.347 1.005 8.047 0 6.25 0c-1.93 0-3.5 1.57-3.5 3.5 0 .539.133 1.043.352 1.5H1a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h1v8a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-8h1a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1z"/>
                                 </svg>
                              </span>
                           </div>
                           <span class="Polaris-Navigation__Text" <?=((strtolower($PageName) == 'create card') ? 'style="color:#1d249b"' : "")?>>Create Cards</span>
                        </button>
                        </a>
                     </li>
                     <li class="Polaris-Navigation__ListItem">
                         <a  style="text-decoration:none;" href="<?=base_url()."Home/LoadCretedCardList?shop=".$shop?>" >
                            <button type="button" class="Polaris-Navigation__Item">
                               <div class="Polaris-Navigation__Icon">
                                  <span class="Polaris-Icon">
                                     <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                        <path fill="currentColor" d="M1 13h5l1 2h6l1-2h5v6H1z"></path>
                                        <path d="M19.962 9.725C19.94 9.648 17.666 2 10 2S.06 9.648.038 9.725c-.05.18-.05.37 0 .55C.06 10.352 2.334 18 10 18s9.94-7.648 9.962-7.725c.05-.18.05-.37 0-.55zM10 16c-5.467 0-7.512-4.772-7.948-6C2.488 8.772 4.532 4 10 4c5.47 0 7.514 4.776 7.948 6-.435 1.228-2.48 6-7.948 6zm0-4c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zm0-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4z"
                                         fill="<?=((strtolower($PageName) == 'view created cards') ? '#1d249b' : "#637381")?>"/>
                                     </svg>
                                  </span>
                               </div>
                               <span class="Polaris-Navigation__Text"  <?=((strtolower($PageName) == 'view created cards') ? 'style="color:#1d249b"' : "")?>>View Cards</span>
                            </button>
                          </a>
                     </li>
                     <!-- <li class="Polaris-Navigation__ListItem">
                         <a  style="text-decoration:none;" href="<?=base_url()."Home/LoadSubscriptionHomePage?shop=".$shop?>" >
                            <button type="button" class="Polaris-Navigation__Item">
                               <div class="Polaris-Navigation__Icon">
                                  <span class="Polaris-Icon">
                                     <svg class="Polaris-Icon__Svg" focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                       <path fill="<?=((strtolower($PageName) == 'integrations') ? '#1d249b' : "#637381")?>" d="M19 10a1 1 0 0 0-1 1v1h-4c-.379 0-.725.214-.895.553L12.382 14H7.618l-.723-1.447A1.001 1.001 0 0 0 6 12H2V3h5a1 1 0 1 0 0-2H1a1 1 0 0 0-1 1v17a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1v-8a1 1 0 0 0-1-1zM2 18v-4h3.382l.723 1.447c.17.339.516.553.895.553h6c.379 0 .725-.214.895-.553L14.618 14H18v4H2zM6.077 7.618a.992.992 0 0 0 0 .764.99.99 0 0 0 .217.326l3 3a.997.997 0 0 0 1.413 0 .999.999 0 0 0 0-1.415L9.414 9H15.5C17.981 9 20 6.981 20 4.5 20 2.018 17.981 0 15.5 0a1 1 0 1 0 0 2 2.5 2.5 0 0 1 0 5H9.414l1.293-1.293a.999.999 0 1 0-1.414-1.414l-2.999 3a.99.99 0 0 0-.217.325"/>
                                     </svg>
                                  </span>
                               </div>
                               <span class="Polaris-Navigation__Text"  <?=((strtolower($PageName) == 'integrations') ? 'style="color:#1d249b"' : "")?>>Integrations</span>
                            </button>
                          </a>
                     </li> -->
                     <li class="Polaris-Navigation__ListItem">
                         <a  style="text-decoration:none;" href="<?=base_url()."Home/LoadHelpPage?shop=".$shop?>" >
                            <button type="button" class="Polaris-Navigation__Item">
                               <div class="Polaris-Navigation__Icon">
                                  <span class="Polaris-Icon">
                                     <svg class="Polaris-Icon__Svg" focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                       <path fill="<?=((strtolower($PageName) == 'instructions') ? '#1d249b' : "#637381")?>" d="M10 0C4.486 0 0 4.486 0 10s4.486 10 10 10 10-4.486 10-10S15.514 0 10 0m0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8m1-5v-3a1 1 0 0 0-1-1H9a1 1 0 1 0 0 2v3a1 1 0 0 0 1 1h1a1 1 0 1 0 0-2m-1-5.9a1.1 1.1 0 1 0 0-2.2 1.1 1.1 0 0 0 0 2.2">
                                         </path>
                                     </svg>
                                  </span>
                               </div>
                               <span class="Polaris-Navigation__Text"  <?=((strtolower($PageName) == 'instructions') ? 'style="color:#1d249b"' : "")?>>Instructions</span>
                            </button>
                          </a>
                     </li>
                  </ul>
               </div>
            </nav>
            <button type="button" class="Polaris-Frame__NavigationDismiss" aria-hidden="true" aria-label="Close navigation" tabindex="-1">
               <span class="Polaris-Icon Polaris-Icon--colorWhite">
                  <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                     <path d="M11.414 10l6.293-6.293a.999.999 0 1 0-1.414-1.414L10 8.586 3.707 2.293a.999.999 0 1 0-1.414 1.414L8.586 10l-6.293 6.293a.999.999 0 1 0 1.414 1.414L10 11.414l6.293 6.293a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414L11.414 10z" fill-rule="evenodd"></path>
                  </svg>
               </span>
            </button>
         </div>
      </div>
      <div class="Polaris-Frame__ContextualSaveBar Polaris-Frame-CSSAnimation--startFade"></div>
      <main  class="Polaris-Frame__Main" id="AppFrameMain" data-has-global-ribbon="false">
      <a id="AppFrameMainContent" tabindex="-1"></a>
      <div class="Polaris-Frame__Content">
      <div class="Polaris-Page">
      <div class="Polaris-Page-Header Polaris-Page-Header--mobileView">
         <div class="Polaris-Page-Header__MainContent">
            <div class="Polaris-Page-Header__TitleActionMenuWrapper">
               <div>
                  <div class="Polaris-Header-Title__TitleAndSubtitleWrapper">
                     <div class="Polaris-Header-Title">
                        <h1 class="Polaris-DisplayText Polaris-DisplayText--sizeLarge"><?=$PageName?></h1>
                     </div>
                  </div>
               </div>
                <?php if(strtolower($PageName) == 'dashboard') { ?>
                  <div class="Polaris-Banner Polaris-Banner--statusInfo Polaris-Banner--hasDismiss Polaris-Banner--withinPage" tabindex="0" role="status" aria-live="polite" aria-labelledby="Banner8Heading" aria-describedby="Banner8Content">
                 <div class="Polaris-Banner__Ribbon">
                   <span class="Polaris-Icon Polaris-Icon--colorTealDark Polaris-Icon--isColored Polaris-Icon--hasBackdrop">
                     <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                       <circle cx="10" cy="10" r="9" fill="currentColor"></circle>
                       <path d="M10 0C4.486 0 0 4.486 0 10s4.486 10 10 10 10-4.486 10-10S15.514 0 10 0m0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8m1-5v-3a1 1 0 0 0-1-1H9a1 1 0 1 0 0 2v3a1 1 0 0 0 1 1h1a1 1 0 1 0 0-2m-1-5.9a1.1 1.1 0 1 0 0-2.2 1.1 1.1 0 0 0 0 2.2">
                       </path>
                     </svg>
                   </span>
                 </div>
                 <div class="Polaris-Banner__ContentWrapper">
                   <div class="Polaris-Banner__Heading" id="Banner8Heading">
                     <p class="Polaris-Heading">Build A Box Page Ready</p>
                   </div>
                   <div class="Polaris-Banner__Content" id="Banner8Content">
                     <p>Click Here to open   <a href="<?="https://".$shop."/apps/builder/build-your-box"?>" target="_blank"> Click Here</a> </p>
                     <div class="Polaris-Banner__Actions">
                       <div class="Polaris-ButtonGroup">
                         <div class="Polaris-ButtonGroup__Item">
                           <div class="Polaris-Banner__PrimaryAction">
                              <a href="<?="https://".$shop."/apps/builder/build-your-box"?>" target="_blank">
                                <button type="button" class="Polaris-Button Polaris-Button--outline">
                                 <span class="Polaris-Button__Content">
                                   <span class="Polaris-Button__Text">Go to Build A Box</span></span>
                               </button>
                             </a>
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
                 <?php } ?>

            </div>
         </div>
      </div>
      <div class="Polaris-Page__Content">
      <div class="Polaris-Layout">
