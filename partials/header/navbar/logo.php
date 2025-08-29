<div id="logo-tagline-wrap">
  <?php if (!has_custom_logo()) : ?>
    <?php if (is_front_page() && is_home()) : ?>
      <div class="navbar-brand mb-0 h3">
        <a rel="home" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" itemprop="url">
          <?php bloginfo('name'); ?>
        </a>
      </div>
    <?php else : ?>
      <a class="navbar-brand mb-0 h3" rel="home" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" itemprop="url">
        <?php bloginfo('name'); ?>
      </a>
    <?php endif ?>
  <?php else : ?>
    <?php
      $logoId = get_theme_mod('custom_logo');
      $logUrl = wp_get_attachment_url($logoId);
    ?>

    <a href="/" rel="home" aria-current="page">
      <img class="maxw-250px maxw-lg-300px" src="<?php echo $logUrl; ?>">
    </a>
  <?php endif ?>

  <?php if (!get_theme_mod('header_disable_tagline')) : ?>
    <small id="top-description" class="text-muted d-none d-md-block mt-n2">
      <?php bloginfo("description") ?>
    </small>
  <?php endif ?>
</div>
