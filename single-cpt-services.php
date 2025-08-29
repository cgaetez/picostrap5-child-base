<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
?>
   <div class="d-flex container-fluid" style="height:50vh;background:url(<?php echo get_the_post_thumbnail_url(98); ?>)  center / cover no-repeat;"></div>
   
    <div class="container-fluid bg-primary mb-4">
        <h2 class="text-white text-center py-4 font-weight-normal h1">Servicios</h2>
    </div>
    <div class="container p-2 bg-lprimary">
        <div class="row">

            <div class="col-md-4">
                <div class="row">
                 <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'services'); ?>" class="img-fluid py-1" alt="<?php the_title(); ?>"/>
                </div>
            </div><!-- /col -->
            <div class="col-md-8">
                <div class="row">
                    <h1 class="display-6 text-left text-primary"><i class="fa fa-circle text-warning h6" aria-hidden="true"></i>&nbsp;<?php the_title(); ?></h1>
                    <div class="text-justify fs-6 text-muted">
                        <?php the_content(); ?>
                    </div>
                    <div class="bg-primary pt-3">
                        <h3 class="fs-5 text-left text-warning"><i class="fa fa-circle text-warning h6" aria-hidden="true"></i>&nbsp; Sucursales disponibles</h3>
                        <?php
                            $featured_posts = get_field('branch-availability');
                            if( $featured_posts ): ?>
                                <ul class="list-unstyled d-flex flex-wrap">
                                <?php foreach( $featured_posts as $post ):
                                    setup_postdata($post); ?>
                                    <li class="px-2">
                                        <a href="<?php the_permalink(); ?>" class="text-white fs-6 text-decoration-none"><?php the_title(); ?></a>
                                    </li>
                                <?php endforeach; ?>
                                </ul>
                                <?php
                                wp_reset_postdata(); ?>
                            <?php endif; ?>
                    </div>
                </div>
            </div><!-- /col -->
        </div>

    </div>
    <div class="container p-2 bg-lprimary mt-4">
        <div class="row border-top border-bottom border-dark pt-3 pb-2">
                <h3 class="text-muted text-center py-0">Otros Servicios</h3>
        </div>

        <div class="row py-5 my-2">
            <?php get_template_part("partials/main/service-display-nocurrent"); ?>
        </div>


     </div>
     <div class="container"></div>




<?php
    endwhile;
 else :
     _e( 'Sorry, no posts matched your criteria.', 'picostrap' );
 endif;
 ?>




<?php get_footer();
