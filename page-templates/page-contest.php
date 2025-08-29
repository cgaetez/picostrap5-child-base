<?php
  /**
   * Template Name: Acenor - Concurso
   */

  // Exit if accessed directly.
  defined( 'ABSPATH' ) || exit;

  get_header();
?>

<div class="position-relative headCont d-none d-md-block">
  <?php if (get_post_thumbnail_id()) : $thumbnailId = get_post_thumbnail_id(); ?>
    <img src="<?php echo wp_get_attachment_url($thumbnailId); ?>" class="position-absolute of-cover op-top-center w-100">
    <h2 class="text-white text-center-abs fs-1">¡GANA CON TUS PROYECTOS DE ACERO!</h2>
    <p class="text-white text-center-abs mt-5 fs-4">Participa y Lleva $150.000 para compras en ACENOR</p>
  <? endif ?>
</div>
<div class="d-block d-md-none bg-primary">
  <?php if (get_post_thumbnail_id()) : $thumbnailId = get_post_thumbnail_id(); ?>
    <img src="<?php echo wp_get_attachment_url($thumbnailId); ?>" class=" w-100">
    <h2 class="text-center mx-auto text-white fs-1">¡GANA CON TUS PROYECTOS DE ACERO!</h2>
    <p class="text-center mx-auto text-white mt-5 fs-4">Participa y Lleva $150.000 para compras en ACENOR</p>
  <? endif ?>
</div>

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
      <div class="col-12 bg-primary">
        <p class="text-center text-white my-5">Al participar, no solo tienes la oportunidad de ganar, sino que también mostrarás tu talento y proyectos a nuestra comunidad."</p>
      </div>
    </div>
  </div>
 

<?php
  get_footer();
