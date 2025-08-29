<?php
  /**
   * Template Name: Acenor - Servicios
   */

  // Exit if accessed directly.
  defined( 'ABSPATH' ) || exit;

  get_header();
?>

<?php get_template_part("partials/main/title"); ?>

<div class="container-fluid">
  <div class="container">
    <?php get_template_part("partials/main/service-display"); ?>
  </div>
</div>

<?php
  get_footer();
