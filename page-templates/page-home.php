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
<div class="container my-5 py-3 text-center">
  <?php 
    $titulo      = get_field('titulo');
    $descripcion = get_field('descripcion');
  ?>
  <?php if ( $titulo ): ?>
    <h1 class="mb-3 fw-bold text-primary"><?php echo esc_html( $titulo ); ?></h1>
  <?php endif; ?>

  <?php if ( $descripcion ): ?>
    <p class="mb-5"><?php echo esc_html( $descripcion ); ?></p>
  <?php endif; ?>
</div>

<div class="container my-5 py-3">
  <?php get_template_part("partials/main/catalog-carousel"); ?>
</div>

<div class="container-fluid my-5 py-3" id="home-sucursales">
  <h2 class="text-center text-primary mb-0 fw-bold h2-n">
    Sucursales
  </h2>

  <div class="border">
    <?php get_template_part("partials/main/branches-map"); ?>
  </div>
</div>

<div class="container my-5 py-3">
  <h2 class="text-center text-primary mb-0 fw-bold h2-n">
    Servicios
  </h2>

  <p class="text-center mb-4 p-h3">
    Contamos con gran variedad de servicios
  </p>

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
