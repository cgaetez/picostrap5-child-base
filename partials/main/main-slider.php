<?php
  $sliderId = $args['id'] ?? uniqid('main-slider-')
?>

<?php if (have_rows('main-slider')) : ?>
  <div id="<?php echo $sliderId ?>" class="carousel slide" data-bs-ride="carousel">
    <?php get_template_part("partials/main/main-slider/indicators", null, [
      'sliderId' => $sliderId
    ]); ?>

    <?php get_template_part("partials/main/main-slider/inner", null, [
      'sliderId' => $sliderId
    ]); ?>

    <?php get_template_part("partials/main/main-slider/controls", null, [
      'sliderId' => $sliderId
    ]); ?>
  </div>
<?php endif; ?>
