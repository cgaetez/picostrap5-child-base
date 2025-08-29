<?php

function add_additional_classes_to_a($classes, $item, $args) {
  if (isset($args->link_classes)) {
    $classes['class'] = $args->link_classes;
  }

  return $classes;
}

add_filter('nav_menu_link_attributes', 'add_additional_classes_to_a', 1, 3);

function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

/*
add_filter( 'wp_nav_menu_items', 'wti_loginout_menu_link', 10, 2 );

function wti_loginout_menu_link( $items, $args ) {
   if ($args->theme_location == 'secondary' || $args->theme_location == 'mobile') {
      if (is_user_logged_in()) {
         $items .= '<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-logout"><a href="/mi-cuenta/customer-logout" class="text-decoration-none d-block py-2 px-3 text-white"><i class="fa fa-sign-out text-white" aria-hidden="true"></i> '. __("Cerrar Sesión 2") .'</a></li>';
      }
   }
   return $items;
}
*/

add_shortcode('login-button', 'login_button');
add_shortcode('logout-button', 'logout_button');

function login_button() {
  return "
    <a href=\"/mi-cuenta/\" class=\"text-decoration-none d-block py-2 px-3 bg-hover-primary text-hover-warning\">
      " . (is_user_logged_in() ? 'Mi cuenta' : 'Iniciar Sesión') . "
    </a>";
}

function logout_button() {
  if (is_user_logged_in()) {
    return "
      <a href=\"/mi-cuenta/customer-logout\" class=\"text-decoration-none d-block py-2 px-3 bg-hover-primary text-hover-warning\">
        <i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i>
        Cerrar Sesión
      </a>";
  }
}
