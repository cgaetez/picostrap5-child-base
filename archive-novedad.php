<?php
defined('ABSPATH') || exit;
get_header();

$top_page_id = 24252; 
$image = get_field('imagen', $top_page_id);
?>

<section class="py-6 text-center"
  style="height:30vh;background:url(<?php echo esc_url($image['url'] ?? ''); ?>) center / cover no-repeat;">
</section>

<div class="container-fluid bg-primary">
  <h1 class="text-white text-center py-4">Novedades Acenor</h1>
</div>

<section class="album py-5 bg-light">
  <div class="container">
    <div class="row">
      <?php
      if ( have_posts() ) :
        while ( have_posts() ) : the_post();
          get_template_part('loops/cards'); // reutilizas EXACTO el mismo diseño
        endwhile;
      else :
        _e('Sorry, no posts matched your criteria.', 'textdomain');
      endif;
      ?>
    </div>

    <div class="row">
      <div class="col lead text-center w-100">
        <div class="d-inline-block"><?php picostrap_pagination(); ?></div>
      </div>
    </div>
  </div>
</section>

<?php get_footer();
