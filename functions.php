<?php
  defined('ABSPATH') || exit;

  include_once ('functions/picostrap-default.php');

  include_once ('functions/utils.php');
  include_once ('functions/acf-google-map-api.php');
  include_once ('functions/wp-nav-menu-extra.php');
  include_once ('functions/woocommerce-customization.php');
  include_once('functions/widgets.php');
  include_once('functions/sizes.php');
  include_once('functions/cf7-rut-field.php');

  register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'picostrap' ),
				'secondary' => __( 'Secondary Menu', 'picostrap' ),
				'secondary-left' => __( 'Secondary Menu (Left)', 'picostrap' ),
        'mobile' => __( 'Mobile Menu', 'picostrap' ),
			)
		);

    add_image_size( 'blog', 600, 600, true );


add_action('phpmailer_init', function ($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host = SMTP_HOST;
    $phpmailer->SMTPAuth = SMTP_AUTH;
    $phpmailer->Username = SMTP_USER;
    $phpmailer->Password = SMTP_PASS;
    $phpmailer->SMTPSecure = SMTP_SECURE;
    $phpmailer->Port = SMTP_PORT;
    $phpmailer->From = SMTP_USER;
    $phpmailer->FromName = 'ACENOR'; // Personaliza el remitente
});
