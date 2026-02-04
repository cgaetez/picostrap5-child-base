<?php
  defined('ABSPATH') || exit;

  include_once ('functions/picostrap-default.php');

  include_once ('functions/utils.php');
  include_once ('functions/acf-google-map-api.php');
  include_once ('functions/wp-nav-menu-extra.php');
  include_once ('functions/woocommerce-customization.php');
  include_once('functions/widgets.php');
  include_once('functions/sizes.php');
  include_once('functions/cf7-attribution.php');
  include_once('functions/cf7-rut-field.php');
  include_once('functions/seoaustral.php');
  
  add_filter('dgwt/wcas/form/action', function($url){
  return trailingslashit( get_option('home') );
}, 10, 1);
