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


//schema
// add_filter(
//     'rank_math/snippet/rich_snippet_product_entity',
//     function ( $entity ) {

//         // Solo en plantillas de producto
//         if ( ! is_product() ) {
//             return $entity;
//         }

//         // Siempre (re)construimos el bloque offers básico SIN price
//         $entity['offers'] = [
//             '@type'         => 'Offer',
//             'priceCurrency' => function_exists( 'get_woocommerce_currency' )
//                                 ? get_woocommerce_currency()
//                                 : 'USD',
//             'availability'  => 'https://schema.org/InStock',   // o PreOrder / BackOrder
//             'url'           => get_permalink(),                // recomendable
//             'seller'        => [
//                 '@type' => 'Organization',
//                 'name'  => get_bloginfo( 'name' ),
//             ],
//         ];

//         return $entity;
//     },
//     PHP_INT_MAX       // asegúrate de ser el último filtro
// );

function agregar_clarity_al_head() {
    ?>
    <script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src=
        "https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "sgwrql9c30");
    </script>
    <?php
}
add_action( 'wp_head', 'agregar_clarity_al_head' );

function gm_free_embed_iframe($args = []) {
  $a = array_merge(['address'=>null,'lat'=>null,'lng'=>null,'zoom'=>16,'lang'=>'es'], $args);
  $q = ($a['lat'] !== null && $a['lng'] !== null)
        ? sprintf('%F,%F', (float)$a['lat'], (float)$a['lng'])
        : (string)$a['address'];
  $src = 'https://www.google.com/maps?' . http_build_query([
    'hl' => $a['lang'], 'q' => $q, 'z' => (int)$a['zoom'], 'output' => 'embed'
  ]);
  return '<iframe width="100%" height="100%" style="border:0"
                  loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                  allowfullscreen src="' . esc_url($src) . '"></iframe>';
}

// ACF Options Page
if ( function_exists('acf_add_options_page') ) {
  acf_add_options_page([
    'page_title' => 'Ajustes Globales',
    'menu_title' => 'Ajustes Globales',
    'menu_slug'  => 'ajustes-globales',
    'capability' => 'manage_options',
    'redirect'   => false
  ]);
}
add_action('wp_enqueue_scripts', function () {
  $obj = get_queried_object_id();
  $tpl = $obj ? get_page_template_slug($obj) : '';
  $is_conecta = $tpl && stripos($tpl, 'conecta') !== false;
  $is_homev2  = ($tpl === 'page-templates/home-v2.php');

  $need_splide = is_front_page() || $is_homev2 || $is_conecta;
  if ( ! $need_splide ) return;
  wp_enqueue_style('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', [], '4.1.4');
  wp_enqueue_script('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', [], '4.1.4', true);

  $init = <<<JS
document.addEventListener('DOMContentLoaded', function () {
  (function(){
    var el = document.querySelector('.homev2-featured .splide');
    if (!el) return;
    new Splide(el, {
      type: 'slide',
      perPage: 4,
      perMove: 1,
      gap: '20px',
      pagination: true,
      arrows: true,
      drag: true,
      breakpoints: { 1100:{perPage:3}, 800:{perPage:2}, 520:{perPage:1} }
    }).mount();
  })();

  (function(){
    function responsiveSplide(selector, opts, mqStr) {
      document.querySelectorAll(selector).forEach(function(el){
        var mql = window.matchMedia(mqStr || '(max-width: 768px)');
        var instance = null;
        function toggle(){
          if (mql.matches) {
            if (!instance) instance = new Splide(el, opts).mount();
          } else {
            if (instance) { instance.destroy(true); instance = null; }
          }
        }
        if (mql.addEventListener) mql.addEventListener('change', toggle); else mql.addListener(toggle);
        toggle();
      });
    }
    responsiveSplide('.js-cats-splide',     { type:'slide', perPage:2, perMove:1, gap:'16px', pagination:true, arrows:true, drag:true, breakpoints:{480:{perPage:1}} });
    responsiveSplide('.js-services-splide', { type:'slide', perPage:2, perMove:1, gap:'16px', pagination:true, arrows:true, drag:true, breakpoints:{480:{perPage:1}} });
  })();

  (function(){
    var el = document.querySelector('.js-svc-splide');
    if (!el) return;

    var opts = {
      type: 'slide',
      perPage: 1,
      perMove: 1,
      gap: '16px',
      arrows: true,
      pagination: true,
      drag: true,
      rewind: false,
      updateOnMove: true
    };

    var mql = window.matchMedia('(max-width: 768px)');
    var instance = null;

    function toggle(){
      if (mql.matches) {
        if (!instance) instance = new Splide(el, opts).mount();
      } else {
        if (instance) { instance.destroy(true); instance = null; }
      }
    }

    if (mql.addEventListener) mql.addEventListener('change', toggle); else mql.addListener(toggle);
    toggle();
  })();
});
JS;
  wp_add_inline_script('splide', $init);
}, 30);
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('dashicons');
});
// Font Awesome 6 
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style(
    'fa6',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
    [],
    '6.5.2'
  );
});

add_action('wp_enqueue_scripts', function () {
  if (is_page(23006)) {
    wp_dequeue_style('scss-compiler');
    wp_dequeue_script('scss-compiler');
    wp_dequeue_style('simple-custom-css-js');
    wp_dequeue_script('simple-custom-css-js');
    wp_dequeue_style('css-hero');
    wp_dequeue_script('css-hero');
  }
}, 999);

//custom post type novedades
add_action('init', function () {

  $labels = [
    'name'          => 'Novedades',
    'singular_name' => 'Novedad',
    'add_new_item'  => 'Añadir novedad',
    'edit_item'     => 'Editar novedad',
    'new_item'      => 'Nueva novedad',
    'view_item'     => 'Ver novedad',
    'search_items'  => 'Buscar novedades',
  ];

  register_post_type('novedad', [
    'labels'             => $labels,
    'public'             => true,
    'has_archive'        => true,            
    'rewrite'            => ['slug' => 'novedades'],
    'menu_icon'          => 'dashicons-megaphone',
    'supports'           => ['title','editor','thumbnail','excerpt'],
    'show_in_rest'       => true,   
  ]);
});
