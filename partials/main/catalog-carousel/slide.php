<div class="carousel-item pb-5 px-5 <?php echo get_row_index() == 1 ? 'active' : ''; ?>">
  <?php $items = get_sub_field('catalog-carousel-slide-items'); ?>

  <div class="row row-cols-2 row-cols-lg-4 g-4">
    <?php foreach($items as $item) : ?>
      <div class="col">
        <a href="/categoria-producto/<?php echo $item->slug; ?>" class="h5 text-decoration-none">
          <div class="card rounded-0 h-100 bg-secondary">
            <?php
              $thumbnailId = get_term_meta($item->term_id, 'thumbnail_id', true);
              $imageUrl = wp_get_attachment_url($thumbnailId);
            ?>

            <img src="<?php echo $imageUrl; ?>" class="card-img-top rounded-0" alt="<?php echo $item->name; ?>">

            <div class="card-footer rounded-0 bg-transparent text-center text-white text-uppercase">
              <?php echo $item->name; ?>
            </div>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</div>
