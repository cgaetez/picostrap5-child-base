<h1 class="text-center text-primary mb-0 fw-bold">
  <?php the_field('catalog-carousel-title'); ?>
</h1>

<h3 class="text-center mb-4">
  <?php the_field('catalog-carousel-subtitle'); ?>
</h3>

<div id="catalog-carousel" class="carousel slide" data-bs-interval="false" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <?php while(have_rows('catalog-carousel-slides')) : the_row(); ?>
      <button
        type="button"
        data-bs-target="#catalog-carousel"
        data-bs-slide-to="<?php echo get_row_index() - 1; ?>"
        class="rounded-circle <?php echo get_row_index() == 1 ? 'active' : ''; ?>"
        aria-current="<?php echo get_row_index() == 1 ? 'true' : 'false'; ?>"
        aria-label="Slide <?php echo get_row_index(); ?>">
      </button>
    <?php endwhile; ?>
  </div>

  <div class="carousel-inner">
    <?php while(have_rows('catalog-carousel-slides')) : the_row(); ?>
      <?php get_template_part("partials/main/catalog-carousel/slide"); ?>
    <?php endwhile; ?>
  </div>

  <button type="button" class="carousel-control-prev" data-bs-target="#catalog-carousel" data-bs-slide="prev" style="width: 3rem">
    <span class="carousel-control-prev-icon bg-warning p-4" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>

  <button type="button" class="carousel-control-next" data-bs-target="#catalog-carousel" data-bs-slide="next" style="width: 3rem">
    <span class="carousel-control-next-icon bg-warning p-4" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
