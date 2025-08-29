<?php if (get_theme_mod('enable_search_form')) : ?>
  <form action="<?php echo bloginfo('url') ?>" method="get" id="header-search-form">
    <input class="form-control" type="text" placeholder="Search" aria-label="Search" name="s" value="<?php the_search_query(); ?>">
  </form>
<?php endif ?>
