<?php
  // Exit if accessed directly.
  defined( 'ABSPATH' ) || exit;

  get_header();
?>

<?php get_template_part("partials/main/title"); ?>

<div class="container">
  <div class="row">
    <div class="col-md-10 offset-md-1 py-5">
      <?php get_template_part("partials/main/post", "content"); ?>
    </div>
  </div>
</div>

<?php
  get_footer();
