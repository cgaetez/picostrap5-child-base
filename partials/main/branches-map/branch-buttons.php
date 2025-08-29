<?php $result = $args['result']; ?>

<div class="row">
  <?php while($result->have_posts()) : $result->the_post(); ?>
    <div class="col-6 col-lg-12 mb-1">
      <button id="<?php echo $post->post_name; ?>-btn" class="btn btn-primary w-100 branch-button py-2 py-lg-1 fw-bold fs-6">
        <?php echo the_title(); ?>
      </button>
    </div>
  <?php endwhile; wp_reset_postdata(); ?>
</div>
