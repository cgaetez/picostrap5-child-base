<?php
  wp_nav_menu([
    'theme_location' => 'secondary-left',
    'fallback_cb' => false,
    'container' => false,
    'menu_class' => 'list-unstyled d-flex flex-row flex-wrap mb-0',
    'link_classes' => 'text-decoration-none d-block py-2 px-3 text-white'
  ]);
