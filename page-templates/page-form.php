<?php
  /**
   * Template Name: Acenor - Formulario
   */

  // Exit if accessed directly.
  defined( 'ABSPATH' ) || exit;

  get_header();
?>

<div class="position-relative">
    <?php if (get_post_thumbnail_id()) : 
    $thumbnailId = get_post_thumbnail_id(); ?>
    <img src="<?php echo wp_get_attachment_url($thumbnailId); ?>"
        class="position-absolute of-cover op-top-center w-100">
    <?php endif; ?>
    <!-- ← CORRECTO -->

    <div class="container py-3 py-lg-5">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <div class="card rounded-50px p-3 my-3 my-lg-5">
                    <div class="card-body">
                        <h1 class="text-center text-primary mb-5">
                            <?php the_title(); ?>
                        </h1>

                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
  get_footer();
?>