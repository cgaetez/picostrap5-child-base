<div class="carousel-item pb-5 px-5 <?php echo get_row_index() == 1 ? 'active' : ''; ?>">
  <?php $items = get_sub_field('highlighted-carousel-slide-items'); ?>

  <div class="row row-cols-2 row-cols-lg-4 g-4">
    <?php foreach($items as $item) : ?>
      <div class="col">
        <a href="<?php echo get_post_permalink($item); ?>" class="h5 text-decoration-none">
          <div class="card h-100 p-2 bg-secondary bg-opacity-25">
            <?php
              $thumbnailId = get_post_thumbnail_id($item);
              $imageUrl = wp_get_attachment_url($thumbnailId);
            ?>

            <img src="<?php echo $imageUrl; ?>" class="card-img-top" alt="<?php echo $item->post_title; ?>">

            <div class="card-footer text-center bg-transparent">
              <?php echo $item->post_title; ?>
            </div>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</div>
