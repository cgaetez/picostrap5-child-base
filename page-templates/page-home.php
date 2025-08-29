<?php
  /**
   * Template Name: Acenor - Inicio
   */

  // Exit if accessed directly.
  defined( 'ABSPATH' ) || exit;

  get_header();
?>

<div>
  <?php get_template_part("partials/main/main-slider"); ?>
</div>

<div class="container my-5 py-3">
  <?php get_template_part("partials/main/catalog-carousel"); ?>
</div>

<div class="container-fluid my-5 py-3" id="home-sucursales">
  <h1 class="text-center text-primary mb-0 fw-bold">
    Sucursales
  </h1>

  <div class="border">
    <?php get_template_part("partials/main/branches-map"); ?>
  </div>
</div>

<div class="container my-5 py-3">
  <h1 class="text-center text-primary mb-0 fw-bold">
    Servicios
  </h1>

  <h3 class="text-center mb-4">
    Contamos con gran variedad de servicios
  </h3>

  <?php get_template_part("partials/main/intertwined-display"); ?>
</div>

<div class="my-5">
  <?php the_content(); ?>
</div>

<div class="container my-5 py-3">
  <?php get_template_part("partials/main/highlighted-carousel"); ?>
</div>

<?php
  get_footer();
