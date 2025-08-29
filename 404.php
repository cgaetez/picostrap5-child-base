<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package picostrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
 
?>


<main class="site-main" id="main">


	<div class="bg-transparent text-center offset-lg-4 col-lg-4 px-6">
		<img src="<?php echo get_stylesheet_directory_uri();?>/acenor-triste.svg" class="">			
	</div>
	<div class="pb-3 bg-transparent text-center offset-lg-3 col-lg-6">
 		<h1  class="display-1"><?php esc_html_e( 'Página no encontrada', 'picostrap' ); ?></h1>
			
		<p class="lead"><?php esc_html_e( 'Quiere ir al inicio del sitio?', 'picostrap' ); ?>&nbsp;</p>
		<a class="btn btn-primary" href="<?php bloginfo('url') ?>" role="button">Ir a inicio <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="1em" height="1em" viewBox="0 0 24 24" fill="currentColor">
				<path d="M19.31 18.9C19.75 18.21 20 17.38 20 16.5C20 14 18 12 15.5 12S11 14 11 16.5 13 21 15.5 21C16.37 21 17.19 20.75 17.88 20.32L21 23.39L22.39 22L19.31 18.9M15.5 19C14.12 19 13 17.88 13 16.5S14.12 14 15.5 14 18 15.12 18 16.5 16.88 19 15.5 19M5 20V12H2L12 3L22 12H20.18C19 10.77 17.34 10 15.5 10C11.92 10 9 12.92 9 16.5C9 17.79 9.38 19 10.03 20H5Z"></path>
			</svg></a>
			
	</div>


</main> 

<?php
get_footer();
