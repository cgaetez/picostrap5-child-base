<?php

$slides = get_field('highlighted-carousel-slides'); // array de filas
$all_items = [];

if ( is_array($slides) ) {
  foreach ( $slides as $row ) {
    if ( ! empty($row['highlighted-carousel-slide-items'])
         && is_array($row['highlighted-carousel-slide-items']) ) {
      $all_items = array_merge(
        $all_items,
        $row['highlighted-carousel-slide-items']
      );
    }
  }
}

$chunks = array_chunk( $all_items, 4 );
?>

<h2 class="text-center text-primary fw-bold pb-0 mb-0 h2-n">
  <?php the_field('highlighted-carousel-title'); ?>
</h2>

<p class="text-center p-h3">
  <?php the_field('highlighted-carousel-subtitle'); ?>
</p>

<div id="highlighted-carousel" class="carousel slide" data-bs-interval="false" data-bs-ride="carousel">

<div class="carousel-indicators">
  <?php foreach ( $chunks as $i => $_ ): ?>
    <button
      type="button"
      data-bs-target="#highlighted-carousel"
      data-bs-slide-to="<?php echo $i; ?>"
      class="rounded-circle <?php echo $i === 0 ? 'active' : ''; ?>"
      aria-current="<?php echo $i === 0 ? 'true' : ''; ?>"
      aria-label="Slide <?php echo $i + 1; ?>">
    </button>
  <?php endforeach; ?>
</div>

  <div class="carousel-inner">
    <?php
    if ( have_rows('highlighted-carousel-slides') ) {
      while ( have_rows('highlighted-carousel-slides') ) {
        the_row();
        get_template_part('partials/main/highlighted-carousel/slide');
      }
    }
    ?>
  </div>

  <button type="button"
          class="carousel-control-prev"
          data-bs-target="#highlighted-carousel"
          data-bs-slide="prev"
          style="width:3rem">
    <span class="carousel-control-prev-icon bg-warning p-4" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button type="button"
          class="carousel-control-next"
          data-bs-target="#highlighted-carousel"
          data-bs-slide="next"
          style="width:3rem">
    <span class="carousel-control-next-icon bg-warning p-4" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>

</div>
