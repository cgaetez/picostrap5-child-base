<?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')) : ?>
  <div class="wrapper bg-primary py-2" id="wrapper-footer-widgets">
    <div class="container mb-0">
      <div id="footer-widget" class="row m-0  bg-primary">
        <div class="container">
          <div class="row">
            <?php if (is_active_sidebar('footer-1')) : ?>
              <div class="col-12 col-md-3">
                <?php dynamic_sidebar('footer-1'); ?>
              </div>
            <?php endif; ?>

            <?php if (is_active_sidebar('footer-2')) : ?>
              <div class="col-12 col-md-3"><?php dynamic_sidebar('footer-2'); ?></div>
            <?php endif; ?>

            <?php if (is_active_sidebar('footer-3')) : ?>
              <div class="col-12 col-md-3"><?php dynamic_sidebar('footer-3'); ?></div>
            <?php endif; ?>

            <?php if (is_active_sidebar('footer-4')) : ?>
              <div class="col-12 col-md-3 pt-md-5"><?php dynamic_sidebar('footer-4'); ?></div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php if (is_active_sidebar('footerfull')) : ?>
   <div class="wrapper bg-primary mt-5 py-5" id="wrapper-footer-widgets">
    <div class="container mb-5">
      <div class="row text-white">
        <?php  dynamic_sidebar('footerfull'); ?>
      </div>
    </div>
  </div>
<?php endif ?>
