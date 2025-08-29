<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
 

$image = get_field('top',14212);
?>
<section class="py-6 text-center" style="height:30vh;background:url(<?php echo $image['url']; ?>)  center / cover no-repeat;">
 
</section>
<div class="container-fluid bg-primary">
    <h1 class="text-white text-center py-4">Blog Acenor</h1> 
</div>

<section class="album py-5 bg-light">
  <div class="container">
    <div class="row">
    <?php 
        if ( have_posts() ) : 
            while ( have_posts() ) : the_post();
                
              get_template_part('loops/cards');
                
            endwhile;
        else :
            _e( 'Sorry, no posts matched your criteria.', 'textdomain' );
        endif;
        ?>
    </div>

    <div class="row">
      <div class="col lead text-center w-100">
        <div class="d-inline-block"><?php picostrap_pagination() ?></div>
      </div><!-- /col -->
    </div> <!-- /row -->
  </div>
</section>
 
<?php get_footer();
