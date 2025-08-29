<?php
  $sliderId = $args['sliderId'];
  $count = count(get_field('main-slider'));
?>

<?php if ($count > 1) : ?>
  <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo $sliderId ?>" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>

  <button class="carousel-control-next" type="button" data-bs-target="#<?php echo $sliderId ?>" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
<?php endif; ?>
