<?php if (get_theme_mod("enable_topbar")) : ?>
  <div id="wrapper-topbar" class="d-none d-lg-block">
    <nav class="navbar navbar-expand-xl <?php echo get_theme_mod('topbar_bg_color_choice','bg-light') ?> <?php echo get_theme_mod('topbar_text_color_choice','text-dark') ?>" aria-label="Top Navigation" >
      <div class="container">
        <?php $content = get_theme_mod('topbar_content'); ?>

        <?php if(!empty($content)) : ?>
          <div id="topbar-content" class="col-md-12 text-left text-center text-md-left small"><?php echo do_shortcode(get_theme_mod('topbar_content')) ?></div>
        <?php else : ?>
          <?php get_template_part("partials/header/topbar/menu-left"); ?>

          <?php get_template_part("partials/header/topbar/menu-right"); ?>
        <?php endif; ?>
      </div>
    </nav>
  </div>
<?php endif ?>
