<?php
  $sliderId = $args['sliderId'];
  $count = count(get_field('main-slider'));
?>

<?php if ($count > 1) : ?>
  <div class="carousel-indicators mb-0">
    <?php while (have_rows('main-slider')) : the_row(); ?>
      <?php
        $index = get_row_index() - 1;
        $active = $index == 0 ? 'active' : '';
      ?>

      <button type="button" data-bs-target="#<?php echo $sliderId ?>" data-bs-slide-to="<?php echo $index ?>" class="bg-secondary rounded-circle <?php echo $active ?>" aria-current="true" aria-label="Slide <?php echo $index + 1; ?>">
      </button>
    <?php endwhile; ?>
  </div>
<?php endif; ?>
