<?php
  // Remove unused tabs
  add_filter('woocommerce_product_tabs', 'woo_remove_product_tabs', 98);

  function woo_remove_product_tabs($tabs) {
    unset($tabs['reviews']);
    unset($tabs['additional_information']);

    return $tabs;
  }

  // Add specifications tab
  add_filter('woocommerce_product_tabs', 'woo_add_specifications_tab');

  function woo_add_specifications_tab($tabs) {
    $tabs['specifications'] = array(
      'title' => __('Ficha', 'woocommerce'),
      'priority' => 50,
      'callback' => 'woo_specifications_tab_content'
    );

    return $tabs;
  }

  function woo_specifications_tab_content()  {
    echo get_post_meta(get_the_ID(), 'specifications', true);
}

/*function wooc_extra_register_fields() {?>

       <p class="form-row form-row-first">
       <label for="reg_billing_first_name"><?php _e( 'Nombre', 'woocommerce' ); ?><span class="required">*</span></label>
       <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
       </p>
       <p class="form-row form-row-last">
       <label for="reg_billing_last_name"><?php _e( 'Apellido', 'woocommerce' ); ?><span class="required">*</span></label>
       <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
       </p>
       <div class="clear"></div>
       <p class="form-row form-row-wide">
       <label for="billing_company"><?php _e( 'Rut', 'woocommerce' ); ?><span class="required">*</span></label>
       <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="billing_company" id="billing_company" value="<?php if ( ! empty( $_POST['billing_company'] ) ) esc_attr_e( $_POST['billing_rut'] ); ?>" />
       </p>
       <div class="clear"></div>
       <p class="form-row form-row-wide">
       <label for="reg_billing_phone"><?php _e( 'Teléfono fijo', 'woocommerce' ); ?></label>
       <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="billing_phone" id="reg_billing_phone" value="<?php if ( ! empty( $_POST['billing_phone'] ) ) esc_attr_e( $_POST['billing_phone'] ); ?>" />
       </p>
       <div class="clear"></div>
       <p class="form-row form-row-wide">
       <label for="reg_billing_mobile"><?php _e( 'Teléfono celular', 'woocommerce' ); ?></label>
       <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="billing_mobile" id="reg_billing_mobile" value="<?php if ( ! empty( $_POST['billing_mobile'] ) ) esc_attr_e( $_POST['billing_mobile'] ); ?>" />
       </p>
       <div class="clear"></div>
       <p class="form-row form-row-first">
       <label for="reg_billing_address_1"><?php _e( 'Calle y número', 'woocommerce' ); ?></label>
       <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="billing_address_1" id="reg_billing_address_1" value="<?php if ( ! empty( $_POST['billing_address_1'] ) ) esc_attr_e( $_POST['billing_address_1'] ); ?>" />
       </p>
       <p class="form-row form-row-last">
       <label for="reg_billing_address_1"><?php _e( 'Apartamento, habitación, etc', 'woocommerce' ); ?></label>
       <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="billing_address_1" id="reg_billing_address_2" value="<?php if ( ! empty( $_POST['billing_address_2'] ) ) esc_attr_e( $_POST['billing_address_2'] ); ?>" />
       </p>
       <div class="clear"></div>
       <p class="form-row form-row-first">
       <label for="reg_billing_city"><?php _e( 'Ciudad', 'woocommerce' ); ?> </label>
       <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="billing_city" id="reg_billing_city" value="<?php  if ( ! empty( $_POST['billing_city'] ) ) esc_attr_e( $_POST['billing_city'] ); ?>" />
       </p>
       <p class="form-row form-row-last">
       <label for="reg_billing_state"><?php _e( 'Región', 'woocommerce' ); ?> </label>
       <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="billing_state" id="reg_billing_state" value="<?php if ( ! empty( $_POST['billing_state'] ) ) esc_attr_e( $_POST['billing_state'] ); ?>" />
       </p>


       <?php
 }

 add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );
*/

add_action('wp_footer', 'validaRut', 50);

function validaRut() {

?>
<script type="text/javascript">

    jQuery(function($){
        $('input#billing_company').after('<span class="error woocommerce-invalid"></span>');

$('input#billing_company').on( 'change', function (){

    var rut = $(this).val();

    if(validateRut(rut)){
        $('input#billing_company').val(rutFormat(rut));
        $('span.error').html('');
    }else{
        $('span.error').html('Rut inv&aacute;lido');
        $('input#billing_company').val('');
        $('input#billing_company').addClass('woocommerce-invalid input');
        $('input#billing_company').focus();
    }

    var t = { updateTimer: !1,  dirtyInput: !1,
        reset_update_checkout_timer: function() {
            clearTimeout(t.updateTimer)
        },
        trigger_update_checkout: function() {
            t.reset_update_checkout_timer(), t.dirtyInput = !1,
            $(document.body).trigger("update_checkout")
        }
    };
    $(document.body).trigger('update_checkout');
    console.log('Event: update_checkout');
});

function validateRut(text) {
    var unformattedRut = String(text).replace(new RegExp("\\.", "g"), "").replace(new RegExp("-", "g"), "");

    var dv = unformattedRut.split("").reverse()[0].toLowerCase();
    var rutNumber = parseInt(unformattedRut.split("").reverse().join("").substring(1).split("").reverse().join(""));

    if(rutNumber<1000000)
        return false;


    if (!isNaN(rutNumber)) {
        var multiplier = 2;
        var sum = 0;

        while (rutNumber !== 0) {
            var mod = rutNumber % 10;
            rutNumber = Math.floor(rutNumber / 10);

            if (multiplier === 8) {
                multiplier = 2;
            }

            sum += mod * multiplier;

            multiplier++;
        }

        var rest = 11 - sum % 11;

        var dvValue;

        switch (rest) {
            case 11:
                {
                    dvValue = "0";

                    break;
                }

            case 10:
                {
                    dvValue = "k";
                    break;
                }

            default:
                {
                    dvValue = String(rest);
                    break;
                }
        }

        return dv === dvValue;
    }

    return false; //0 = false
};

function rutFormat(text) {
    if (text && text.length > 1) {
        var clearedRut = text.replace(/\.|-|\s/g, "");

        if (clearedRut) {
            var numericPart = clearedRut.substr(0, clearedRut.length - 1);

            if (!isNaN(numericPart)) {
                //numericPart = parseInt(numericPart).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                return numericPart + "-" + clearedRut.charAt(clearedRut.length - 1);
            }
        }
    }

    return text;
};
    });
</script>

<?php }


add_filter( 'woocommerce_dropdown_variation_attribute_options_args', static function( $args ) {
    $args['class'] = 'form-select  btn-primary';
    return $args;
}, 2 );


add_filter('woocommerce_gallery_image_html_attachment_image_params', function( $args ) {
    $args['class'] = 'border-bottom border-5 border-warning d-block mb-2';
    return $args;
} );

add_filter( 'wp_nav_menu_items', 'bbloomer_dynamic_menu_item_label', 9999, 2 );

function bbloomer_dynamic_menu_item_label( $items, $args ) {
   if ( ! is_user_logged_in() ) {
      $items = str_replace( "Mi cuenta", "Iniciar sesión", $items );
   }
   return $items;
}

/*
add_filter( 'woocommerce_checkout_fields', 'whq_wcchp_order_checkout_fields' );
function whq_wcchp_order_checkout_fields( $fields ) {
	$fields['billing']['billing_city']['priority']    = 80;
	$fields['shipping']['shipping_city']['priority']  = 80;
	$fields['billing']['billing_state']['priority']   = 70;
	$fields['shipping']['shipping_state']['priority'] = 70;

	return $fields;
}
*/


function quoteQtyUpdt() {
?>
  <style>
    /* Chrome, Safari, Edge, Opera */
    .quantity input::-webkit-outer-spin-button,
    .quantity input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    .quantity input[type=number] {
      -moz-appearance: textfield;
    }
  </style>

  <script>
    function addStyleFunction(input) {
      const inputPlus = jQuery(input).siblings().filter('.input-plus');
      const inputMinus = jQuery(input).siblings().filter('.input-minus');

      inputPlus.click((e) => {
        const input = jQuery(e.target).siblings().filter('input[type=number]')[0];
        
        input.stepUp();
        
        jQuery(input).trigger('change');
      });

      inputMinus.click((e) => {
        const input = jQuery(e.target).siblings().filter('input[type=number]')[0];
        
        input.stepDown();
        
        jQuery(input).trigger('change');
      });
    }

    function styleNumberInputs() {
      jQuery('.quantity').addClass('d-flex gap-2 justify-content-start');

      const numbersWithoutStyle = jQuery('input[type=number]:not(.with-style)');

      jQuery('<span class="input-minus bg-warning text-white btn px-3">-</span>').insertBefore(numbersWithoutStyle);
      jQuery('<span class="input-plus bg-warning text-white btn px-3">+</span>').insertAfter(numbersWithoutStyle)

      addStyleFunction(numbersWithoutStyle);

      numbersWithoutStyle.addClass('with-style');
    }

    jQuery(document).ajaxStop(() => {
      styleNumberInputs();
    });

    styleNumberInputs();
  </script>
<?php
}

add_filter('woocommerce_variable_add_to_cart', 'quoteQtyUpdt', 4);
add_filter('woocommerce_after_quantity_input_field', 'quoteQtyUpdt', 4);

remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10, 2 ); 

function woocommerce_template_loop_category_title_override( $category ) {
?>
  <h2 class="woocommerce-loop-category__title bg-primary text-white text-center">

  <?php
    echo esc_html( $category->name ); //Update your title which you want to update here

    if ( $category->count > 0 ) {
      echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . esc_html( $category->count ) . ')</mark>', $category );
    } ?>
  </h2>
  <?php
}
add_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title_override', 1 );

add_filter( 'woocommerce_subcategory_count_html', '__return_false' );

add_action('woocommerce_admin_order_data_after_billing_address', 'regionName');
function Region($region){
    switch($region){
        case "CL-AI": return "Aisén del General Carlos Ibañez del Campo";
        case "CL-AN": return "Antofagasta";
        case "CL-AP": return "Arica y Parinacota";
        case "CL-AR": return "La Araucanía";
        case "CL-AT": return "Atacama";
        case "CL-BI": return "Biobío";
        case "CL-CO": return "Coquimbo";
        case "CL-LI": return "Libertador General Bernardo O'Higgins";
        case "CL-LL": return "Los Lagos";
        case "CL-LR": return "Los Ríos";
        case "CL-MA": return "Magallanes";
        case "CL-ML": return "Maule";
        case "CL-NB": return "Ñuble";
        case "CL-RM": return "Región Metropolitana de Santiago";
        case "CL-TA": return "Tarapacá";
        case "CL-VS": return "Valparaíso";
        default: return $region;
    }
}
function regionName($order){
	/*echo '<pre>';
	var_dump($order);
	echo '</pre>';*/
    echo 'Región: '.Region($order->get_billing_state());
	
	echo '</br>Sucursal: ';
 	foreach ($order->get_meta_data() as $object) {
	  
	 $object_array = array_values((array)$object);
	  foreach ($object_array as $object_item) {
		if ('_billing_branches' == $object_item['key']) {
		  echo $object_item['value'];
		  break;
		}
	  }
}
}





 function wc_billing_field_strings( $translated_text, $text, $domain ) {
    switch ( $translated_text ) {
    case 'Población' :
    $translated_text = __( 'Ciudad', 'woocommerce' );
    break;
    }
    return $translated_text;
    }
    add_filter( 'gettext', 'wc_billing_field_strings', 20, 3 );


 /**
 * Notify admin when a new customer account is created
 */
add_action( 'woocommerce_created_customer', 'woocommerce_created_customer_admin_notification' );
function woocommerce_created_customer_admin_notification( $customer_id ) {
  wp_send_new_user_notifications( $customer_id, 'admin' );
}

add_filter( 'ywraq_export_columns', 'ywraq_custom_csv_columns' );
function ywraq_custom_csv_columns( $columns ) {
	return array_slice( $columns, 0, 9, true) + array( '_billing_branches' => 'Sucursal' ) + array_slice( $columns, 9, count( $columns ) - 1, true );
}



add_filter( 'woocommerce_email_headers', 'ywraq_custom_email_sending', 10, 3 );
function ywraq_custom_email_sending( $headers, $email, $order ) {
  if ( $email === 'ywraq_email' ) {
      $sucursal = get_post_meta( $order->get_id(), '_billing_branches', true );
      $recipient = '';
      switch ( $sucursal ) {
		  case 'Villa Alemana' :
              $recipient = 'villaalemanaweb@acenorchile.com';
              break;
          case 'Santiago' :
              $recipient = 'santiagoweb1@acenorchile.com';
              break;
          case 'Rancagua' :
              $recipient = 'rancaguaweb@acenorchile.com';
              break;
          case 'Talca' :
              $recipient = 'talcaweb@acenorchile.com';
              break;
          case 'Chillán' :
              $recipient = 'chillanweb@acenorchile.com';
              break;
          case 'Linares' :
              $recipient = 'linaresweb@acenorchile.com';
              break;
          case 'Curicó' :
              $recipient = 'curicoweb@acenorchile.com';
              break;
          case 'Concepción' :
              $recipient = 'concepcionweb@acenorchile.com';
              break;
          case 'Valdivia' :
              $recipient = 'valdiviaweb@acenorchile.com';
              break;
          case 'Los Ángeles' :
              $recipient = 'losangelesweb@acenorchile.com';
              break;
          case 'Puerto Montt' :
              $recipient = 'puertomontt@acenorchile.com';
              break;
      }
      if ( $recipient !== '' ) {
          $headers .= 'BCC: Sucursal <' . $recipient . '> \r\n';
      }
  }
  return $headers;
}


add_filter( 'woocommerce_email_styles', function( $css ) {
    $css .= '
          td > a { font-size: 17px; }
          small { font-size: 15px }
       ';
    return $css;
        
   
 });
 
 
 add_filter( 'ywraq_get_orders_to_export_args', 'ywraq_get_orders_to_export_args_helper' );
function ywraq_get_orders_to_export_args_helper( $args ) {
    
if(date('m')==1){
    $prevmonth = 12;
    $year = date('y')-1; 
    
}else{
    $prevmonth  = date('m')-1;
    $year = date('y');
}




$lastday =  cal_days_in_month(CAL_GREGORIAN, $prevmonth, $year); 

$dateStart = $year.'-'.$prevmonth.'-01';
$dateEnd = $year.'-'.$prevmonth.'-'.$lastday;

$fdate = $dateStart.'...'.$dateEnd;
//echo $fdate;


    
$args['date_created'] = $fdate; //format to use YYYY-MM-DD...YYYY-MM-DD
return $args;
}

add_filter('woocommerce_related_products', function ($related_posts, $product_id) {
    global $wpdb;

    $product = wc_get_product($product_id);

    $exclude_ids = [];
    $valid_related_posts = [];

    if ($product->is_type('simple')) {
        $grouped_parent = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT post_id FROM {$wpdb->postmeta}
                WHERE meta_key = '_children'
                AND meta_value LIKE %s",
                '%i:' . $product_id . ';%'
            )
        );

        if ($grouped_parent) {
            $grouped_product_id = $grouped_parent->post_id;

            $children_meta = $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT meta_value FROM {$wpdb->postmeta} 
                    WHERE post_id = %d AND meta_key = '_children'",
                    $grouped_product_id
                )
            );

            if ($children_meta) {
                $exclude_ids = maybe_unserialize($children_meta);
            }
        }
    }

    $categories = $product->get_category_ids();

    if (!empty($categories)) {
        $args = [
            'post_type'      => 'product',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'fields'         => 'ids',
            'tax_query'      => [
                [
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $categories,
                ],
            ],
        ];

        $query = new WP_Query($args);
        $category_products = $query->posts;

        foreach ($category_products as $related_id) {
            if (in_array($related_id, $exclude_ids)) {
                continue;
            }

            $related_product = wc_get_product($related_id);

            if (! $related_product) {
              continue;
            }

            if ($related_product->is_type('simple')) {
                $is_in_group = $wpdb->get_var(
                    $wpdb->prepare(
                        "SELECT post_id FROM {$wpdb->postmeta}
                        WHERE meta_key = '_children'
                        AND meta_value LIKE %s",
                        '%i:' . $related_id . ';%'
                    )
                );

                if ($is_in_group) {
                  continue;
                }
            }

            $valid_related_posts[] = $related_id;
        }
    }

    return array_unique($valid_related_posts);
}, 10, 2);

add_action('woocommerce_single_product_summary', function () {
    global $product, $wpdb;

    if (!$product->is_type('simple')) {
        return;
    }

    $product_id = $product->get_id();

    $grouped_parent = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT post_id FROM {$wpdb->postmeta} 
            WHERE meta_key = '_children' 
            AND meta_value LIKE %s",
            '%i:' . $product_id . ';%'
        )
    );

    if (!$grouped_parent) {
        return;
    }

    $children_meta = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT meta_value FROM {$wpdb->postmeta} 
            WHERE post_id = %d AND meta_key = '_children'",
            $grouped_parent->post_id
        )
    );

    if (!$children_meta) {
        return;
    }

    $child_ids = maybe_unserialize($children_meta);

    if (!is_array($child_ids)) {
        echo '<p>Failed to decode sibling products.</p>';

        return;
    }

    echo '<div class="d-flex flex-wrap gap-2">';

    foreach ($child_ids as $sibling_id) {
        $sibling_product = wc_get_product($sibling_id);

        $active_class = ($sibling_id == $product_id) ? 'btn-warning' : 'btn-primary';

        echo '<a href="' . esc_url(get_permalink($sibling_id)) . '" class="btn  btn-sm ' . $active_class . '">' . esc_html($sibling_product->get_name()) . '</a>';
    }

    echo '</div>';
});

add_action('woocommerce_product_query', function ($query, $query_vars) {
    $queried_object = get_queried_object();

    $grouped_product_ids = wc_get_products([
        'status'    => 'publish',
        'type'      => 'grouped',
        'limit'     => -1,
        'product_cat'  => [$queried_object->term_id],
        'return'    => 'ids',
    ]);

    $child_product_ids = [];

    foreach ($grouped_product_ids as $grouped_id) {
        $group_child_ids = get_post_meta($grouped_id, '_children', true);

        if (empty($group_child_ids) || ! is_array($group_child_ids)) {
            continue;
        }

        $child_product_ids = array_merge($child_product_ids, $group_child_ids);
    }

    $single_product_ids = wc_get_products([
        'status'    => 'publish',
        'type'      => 'simple',
        'limit'     => -1,
        'product_cat'  => [$queried_object->term_id],
        'return'    => 'ids',
    ]);

    $filtered_single_product_ids = array_diff($single_product_ids, $child_product_ids);

    $final_product_ids = array_merge($grouped_product_ids, $filtered_single_product_ids);

    $query->set('post__in', $final_product_ids);
}, 10, 2);


add_action('woocommerce_grouped_add_to_cart', function () {
  add_filter('yith_ywraq_before_print_button', '__return_false');
});

add_action('woocommerce_before_shop_loop_item', function () {
  add_filter('yith_ywraq_before_print_button', '__return_false');
});

add_action('woocommerce_shop_loop_item_title', function() {
  echo '<div class="bg-primary text-center text-white title-wrapper">';
  echo '<h3 class="custom-title">' . get_the_title() . '</h3>';
  echo '</div>';
}, 10);

remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

add_filter('yith_ywraq_quantity_loop', '__return_true');
