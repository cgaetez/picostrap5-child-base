<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">
  <?php /*
  <a class="skip-link visually-hidden-focusable" href="#theme-main">
    <?php esc_html_e('Skip to content', 'picostrap'); ?>
  </a>
  */ ?>

  <nav class="navbar <?php echo get_theme_mod('picostrap_header_navbar_expand','navbar-expand-lg'); ?> <?php echo get_theme_mod('picostrap_header_navbar_position')." ". get_theme_mod('picostrap_header_navbar_color_scheme','navbar-dark').' '. get_theme_mod('picostrap_header_navbar_color_choice','bg-dark'); ?>" aria-label="Main Navigation" >
    <div class="container">
      <?php get_template_part("partials/header/navbar/logo"); ?>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobile-menu" aria-controls="mobile-menu" aria-expanded="false" aria-label="Mostrar/Ocultar menú">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div id="mobile-menu" class="collapse navbar-collapse">
        <?php
          wp_nav_menu([
            'theme_location' => 'primary',
          ]);
        ?>

        <?php //get_template_part("partials/header/navbar/search-form"); ?>
      </div>

    </div>
  </nav>
  <a href="tel:+56229259200" class="text-center text-decoration-none  d-block d-lg-none py-2 px-3 fs-1"><i class="fa fa-phone text-warning mr-2" aria-hidden="true"></i> +562 2925 9200</a>

</div>
