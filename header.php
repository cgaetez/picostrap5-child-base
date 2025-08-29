<?php
  // Exit if accessed directly.
  defined( 'ABSPATH' ) || exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="google-site-verification" content="vRh1mFa11oGTtJ5xkPHe0IHkltz4MdcsEzXJHEDEmCw" /> 
  
  <?php wp_head(); ?>

</head>

<body <?php body_class('bg-light'); ?> >
  <?php wp_body_open(); ?>

  <?php if (function_exists('lc_custom_header')) : ?>
    <?php lc_custom_header(); ?>
  <?php else : ?>
    <?php get_template_part("partials/header/topbar"); ?>

    <?php get_template_part("partials/header/navbar"); ?>
  <?php endif ?>

  <main id='theme-main'>
