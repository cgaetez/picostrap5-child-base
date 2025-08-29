<?php if (have_rows('intertwined-display')) : ?>
  <div class="row">
    <?php
      $index = 0;
    ?>

    <?php while (have_rows('intertwined-display')) : the_row(); ?>
      <?php
        $index++;
        $variant = get_row_index() % 2 == 0 ? 'primary' : 'secondary';
      ?>

      <div class="col-12 col-md-4 px-md-1">
        <?php if ($variant == 'primary') : ?>
          <div class="card minh-md-350px border-<?php echo $variant; ?> rounded-0 d-none d-md-block bg-img-center-center-cover" style="background-image: url('<?php echo get_sub_field('image'); ?>')">
          </div>

          <div class="py-1 d-none d-md-block"></div>
        <?php endif ?>

        <div class="card minh-md-350px rounded-0 text-white border-<?php echo $variant; ?> bg-<?php echo $variant; ?> my-1 my-md-0">
          <div class="card-body text-center">
            <?php the_sub_field('content'); ?>
          </div>

          <div class="card-footer p-3 text-center bg-transparent border-top-0">
            <a href="<?php echo get_sub_field('link') ?>" class="btn btn-outline-light px-5">Ver más</a>
          </div>
        </div>

        <?php if ($variant == 'secondary') : ?>
          <div class="py-1 d-none d-md-block"></div>

          <div class="card minh-md-350px border-<?php echo $variant; ?> rounded-0 d-none d-md-block bg-img-center-center-cover" style="background-image: url('<?php echo get_sub_field('image'); ?>')">
          </div>
        <?php endif; ?>
      </div>

      <?php $index++; ?>
    <?php endwhile; ?>
  </div>
<?php endif; ?>
