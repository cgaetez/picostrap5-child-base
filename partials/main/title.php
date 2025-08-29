<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
    <?php if (get_the_post_thumbnail_url()) : ?>
      <div class="d-flex container-fluid" style="height:50vh;background:url(<?php echo get_the_post_thumbnail_url(); ?>)  center / cover no-repeat;"></div>
    <?php else : ?>
      <div class="d-flex container-fluid" style="height:20vh;"></div>
    <?php endif; ?>

    <div class="container-fluid bg-primary">
      <div class="row text-center">
        <div class="col-md-12">
          <h1 class="text-white text-center py-4 font-weight-normal h1"><?php the_title(); ?></h1>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
<?php endif;?>
