<div class="carousel-inner">
  <?php while (have_rows('main-slider')) : the_row(); ?>
    <?php
      $index = get_row_index() - 1;
      $active = $index == 0 ? 'active' : '';
    ?>

    <div class="carousel-item bg-dark <?php echo $active; ?>">
      <img src="<?php echo get_sub_field('image') ?>" class="d-block w-100 opacity-100" alt="Slide <?php echo $index + 1; ?>">

      <div class="carousel-caption d-none d-md-block text-start bottom-20">
        <div class="row">
          <div class="col-12 <?php echo get_sub_field('caption-classes') ?>">
            <?php echo get_sub_field('caption'); ?>
			<?php if(get_sub_field('button_link')){
				echo '<a href="'.get_sub_field('button_link').'" class="btn btn-warning text-white">'.get_sub_field('button_text').'</a>';
			}  ?>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
</div>
