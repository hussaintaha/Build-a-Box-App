<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['GetShopifyCustomerdata'] = 'ShopifyWebhookController/GetShopifyCustomerdata';
$route['EraseShopifyCustomerdata'] = 'ShopifyWebhookController/EraseShopifyCustomerdata';
$route['EraseShopData'] = 'ShopifyWebhookController/EraseShopData';

$route['default_controller'] = 'Auth/check_login';

$route['build-your-box'] = 'StoreFront/BuildYourBox';
$route['cart'] = 'CartController/MyCart';


$route['checkout'] = 'Checkout/Checkout';
$route['clear-cart'] = 'Checkout/CartClear';


$route['product_update'] = 'WebhookController/ProductUpdateWebhook';
$route['product_delete'] = 'WebhookController/ProductDeleteWebhook';


$route['CreateShopifyOrder'] = 'StripeWebhookController/CreateShopifyOrder';
$route['my-dashboard'] = 'ShopifyUser/UserDahboard';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
