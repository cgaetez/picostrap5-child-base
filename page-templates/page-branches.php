<?php
  /**
   * Template Name: Acenor - Sucursales
   */

  // Exit if accessed directly.
  defined( 'ABSPATH' ) || exit;

  get_header();
  if ( have_posts() ) :
    while ( have_posts() ) : the_post();

    if (get_the_post_thumbnail_url()){
        ?><div class="d-flex container-fluid" style="height:50vh;background:url(<?php echo get_the_post_thumbnail_url(); ?>)  center / cover no-repeat;"></div>
    <?php } else {
        ?><div class="d-flex container-fluid" style="height:20vh;"></div>
    <?php } ?>
    <div class="container-fluid bg-primary">
        <h2 class="text-white text-center py-4 font-weight-normal h1"><?php the_title(); ?></h2>
    </div>
  <?php
   endwhile;
  endif;
  ?>
 <div class="container-fluid mb-5">
  <div class="container">
  <?php get_template_part("partials/main/branches-map"); ?>
  </div>
</div>

<?php
  get_footer();
