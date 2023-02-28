<!DOCTYPE html>
<html>
  <head>
   <title>Trust Badge</title>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
   <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
   <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" rel="stylesheet">
   <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" type="text/css" rel="stylesheet">
   <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" type="text/css" rel="stylesheet">
   <link href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" rel="stylesheet">

   <script src="https://cdn.shopify.com/s/assets/external/app.js"></script>
   <script type="text/javascript">
       ShopifyApp.init({
           apiKey : '<?php echo $this->config->item('shopify_api_key'); ?>',
           shopOrigin : '<?php echo 'https://'.$_GET['shop'];?>'
       });
   </script>

   </head>
   <body>
     <h1>Done</h1>
   </body>
</html>
