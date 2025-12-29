<?php
defined('ABSPATH') || exit;

get_header();

if ( have_posts() ) :
  while ( have_posts() ) : the_post();
?>

  <div class="container py-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">

        <?php if ( has_post_thumbnail() ) : ?>
          <figure class="mb-4 text-center">
            <?php
              // "large" para que no quede enorme.
              // Si la quieres aún más chica usa "medium_large"
              // Si la quieres en máxima calidad usa "full"
              the_post_thumbnail('large', [
                'class'   => 'rounded',
                'loading' => 'eager',
                'style'   => 'max-width:100%;height:auto;display:block;'
              ]);
            ?>
          </figure>
        <?php endif; ?>

        <h1 class="display-5 text-left"><?php the_title(); ?></h1>

        <?php the_content(); ?>

        <?php
          if ( get_theme_mod("enable_sharing_buttons") ) picostrap_the_sharing_buttons();

          edit_post_link( __( 'Edit this post', 'picostrap' ), '<p class="text-right">', '</p>' );

          if ( !get_theme_mod("singlepost_disable_comments") ) {
            if ( comments_open() || get_comments_number() ) {
              comments_template();
            }
          }
        ?>

      </div><!-- /col -->
    </div><!-- /row -->
  </div><!-- /container -->
<style>.text-center img {
    margin: auto;
}</style>
<?php
  endwhile;
else :
  _e( 'Sorry, no posts matched your criteria.', 'picostrap' );
endif;

get_footer();
