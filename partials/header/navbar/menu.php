<?php
  wp_nav_menu(array(
    'theme_location' => 'primary',
    'container' => false,
    'menu_class' => '',
	'add_li_class'  => 'mx-2',
    'fallback_cb' => '__return_false',
    'items_wrap' => '<ul id="%1$s" class="navbar-nav ms-auto mb-md-0 %2$s">%3$s</ul>',
    'walker' => new bootstrap_5_wp_nav_menu_walker()
  ));
?>
