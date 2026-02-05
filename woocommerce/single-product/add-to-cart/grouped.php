<?php
  /**
   * Grouped product add to cart
   *
   * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/grouped.php.
   *
   * HOWEVER, on occasion WooCommerce will need to update template files and you
   * (the theme developer) will need to copy the new files to your theme to
   * maintain compatibility. We try to do this as little as possible, but it does
   * happen. When this occurs the version of the template file will be bumped and
   * the readme will list any important changes.
   *
   * @see     https://docs.woocommerce.com/document/template-structure/
   * @package WooCommerce\Templates
   * @version 4.8.0
   */

  defined( 'ABSPATH' ) || exit;
?>

<?php
  global $product, $post;

  do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart grouped_form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
  <table cellspacing="0" class="woocommerce-grouped-product-list group_table">
    <tbody>
      <?php
      $quantites_required      = false;
      $previous_post           = $post;
      $grouped_product_columns = apply_filters(
        'woocommerce_grouped_product_columns',
        array(
          'quantity',
          'label',
          'price',
        ),
        $product
      );
      $show_add_to_cart_button = false;

      // Calcular nombres cortos (quitar prefijo común, solo productos visibles)
      $acenor_short_names = array();
      $acenor_all_names = array();
      foreach ( $grouped_products as $gp ) {
          if ( $gp->get_status() === 'publish' && $gp->is_visible() ) {
              $acenor_all_names[ $gp->get_id() ] = $gp->get_name();
          }
      }
      $acenor_name_values = array_values( $acenor_all_names );
      $acenor_prefix = isset( $acenor_name_values[0] ) ? $acenor_name_values[0] : '';
      foreach ( $acenor_name_values as $acenor_n ) {
          while ( $acenor_prefix !== '' && strpos( $acenor_n, $acenor_prefix ) !== 0 ) {
              $acenor_prefix = mb_substr( $acenor_prefix, 0, mb_strlen( $acenor_prefix ) - 1 );
          }
      }
      $acenor_last_space = strrpos( $acenor_prefix, ' ' );
      if ( $acenor_last_space !== false ) {
          $acenor_prefix = substr( $acenor_prefix, 0, $acenor_last_space + 1 );
      }
      // Si el prefijo es muy corto, no acortar
      if ( mb_strlen( trim( $acenor_prefix ) ) < 5 ) {
          $acenor_prefix = '';
      }
      foreach ( $acenor_all_names as $acenor_cid => $acenor_name ) {
          $acenor_short = ltrim( mb_substr( $acenor_name, mb_strlen( $acenor_prefix ) ) );
          // Si el nombre corto es muy corto (menos de 10 chars), usar el nombre completo
          if ( $acenor_short === '' || mb_strlen( $acenor_short ) < 10 ) {
              $acenor_short = $acenor_name;
          }
          // Si el nombre aún es largo, quitar texto hasta el primer número (dejar solo medidas)
          if ( mb_strlen( $acenor_short ) > 25 && preg_match( '/^[^\d]+/', $acenor_short, $matches ) ) {
              $acenor_short = trim( mb_substr( $acenor_short, mb_strlen( $matches[0] ) ) );
          }
          $acenor_short_names[ $acenor_cid ] = $acenor_short;
      }

      do_action( 'woocommerce_grouped_product_list_before', $grouped_product_columns, $quantites_required, $product );

      foreach ( $grouped_products as $grouped_product_child ) {
        // Saltar productos no publicados
        if ( $grouped_product_child->get_status() !== 'publish' || ! $grouped_product_child->is_visible() ) {
            continue;
        }
        $post_object        = get_post( $grouped_product_child->get_id() );
        $quantites_required = $quantites_required || ( $grouped_product_child->is_purchasable() && ! $grouped_product_child->has_options() );
        $post               = $post_object; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
        setup_postdata( $post );

        if ( $grouped_product_child->is_in_stock() ) {
          $show_add_to_cart_button = true;
        }

        echo '<tr id="product-' . esc_attr( $grouped_product_child->get_id() ) . '" class="woocommerce-grouped-product-list-item ' . esc_attr( implode( ' ', wc_get_product_class( '', $grouped_product_child ) ) ) . '">';

        // Output columns for each product.
        foreach ( $grouped_product_columns as $column_id ) {
          do_action( 'woocommerce_grouped_product_list_before_' . $column_id, $grouped_product_child );

          switch ( $column_id ) {
            case 'quantity':
              ob_start();

              if ( ! $grouped_product_child->is_purchasable() || $grouped_product_child->has_options() || ! $grouped_product_child->is_in_stock() ) {
                woocommerce_template_loop_add_to_cart();
              } elseif ( $grouped_product_child->is_sold_individually() ) {
                echo '<input type="checkbox" name="' . esc_attr( 'quantity[' . $grouped_product_child->get_id() . ']' ) . '" value="1" class="wc-grouped-product-add-to-cart-checkbox" />';
              } else {
                do_action( 'woocommerce_before_add_to_cart_quantity' );

                woocommerce_quantity_input(
                  array(
                    'input_name'  => 'quantity[' . $grouped_product_child->get_id() . ']',
                    'input_value' => isset( $_POST['quantity'][ $grouped_product_child->get_id() ] ) ? wc_stock_amount( wc_clean( wp_unslash( $_POST['quantity'][ $grouped_product_child->get_id() ] ) ) ) : '', // phpcs:ignore WordPress.Security.NonceVerification.Missing
                    'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $grouped_product_child ),
                    'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $grouped_product_child->get_max_purchase_quantity(), $grouped_product_child ),
                    'placeholder' => '0',
                  )
                );

                do_action( 'woocommerce_after_add_to_cart_quantity' );
              }

              $value = ob_get_clean();
              break;
            case 'label':
              $acenor_display_name = isset( $acenor_short_names[ $grouped_product_child->get_id() ] ) ? $acenor_short_names[ $grouped_product_child->get_id() ] : $grouped_product_child->get_name();
              $value  = '<label for="product-' . esc_attr( $grouped_product_child->get_id() ) . '">';
              $value .= $grouped_product_child->is_visible() ? '<a href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', $grouped_product_child->get_permalink(), $grouped_product_child->get_id() ) ) . '">' . esc_html( $acenor_display_name ) . '</a>' : esc_html( $acenor_display_name );
              $value .= '</label>';
              break;
            case 'price':
              $value = $grouped_product_child->get_price_html() . wc_get_stock_html( $grouped_product_child );
              break;
            default:
              $value = '';
              break;
          }

          echo '<td class="woocommerce-grouped-product-list-item__' . esc_attr( $column_id ) . '">' . apply_filters( 'woocommerce_grouped_product_list_column_' . $column_id, $value, $grouped_product_child ) . '</td>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

          do_action( 'woocommerce_grouped_product_list_after_' . $column_id, $grouped_product_child );
        }

        echo '</tr>';
      }
      $post = $previous_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
      setup_postdata( $post );

      do_action( 'woocommerce_grouped_product_list_after', $grouped_product_columns, $quantites_required, $product );
      ?>
    </tbody>
  </table>

  <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />

  <?php if ( $quantites_required && $show_add_to_cart_button ) : ?>

    <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

    <button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

    <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

  <?php endif; ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<style>
form.cart.grouped_form {
    margin: 0 !important;
    padding: 0 !important;
}
.woocommerce-grouped-product-list.group_table {
    display: flex !important;
    flex-wrap: wrap !important;
    gap: 8px !important;
    border: none !important;
    border-spacing: 0 !important;
    border-collapse: collapse !important;
    margin: 0.25rem 0 !important;
    padding: 0 !important;
}
.woocommerce-grouped-product-list.group_table > tbody {
    display: contents !important;
}
.woocommerce-grouped-product-list.group_table tr {
    display: contents !important;
}
.woocommerce-grouped-product-list-item__quantity,
.woocommerce-grouped-product-list-item__price {
    display: none !important;
}
.woocommerce-grouped-product-list-item__label {
    display: inline-block !important;
    padding: 0 !important;
    border: none !important;
}
.woocommerce-grouped-product-list-item__label a {
    text-transform: capitalize !important;
    display: inline-block !important;
    padding: 6px 14px !important;
    background-color: #132b51 !important;
    color: #fff !important;
    font-weight: 600 !important;
    text-decoration: none !important;
    border-radius: 4px !important;
    font-size: 0.85em !important;
    white-space: nowrap !important;
}
.woocommerce-grouped-product-list-item__label a:hover {
    background-color: #ecbd16 !important;
    color: #132b51 !important;
    text-decoration: none !important;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var links = document.querySelectorAll('.woocommerce-grouped-product-list-item__label a');
    if (!links.length) return;
    var max = 0;
    links.forEach(function(a) { var w = a.offsetWidth; if (w > max) max = w; });
    links.forEach(function(a) { a.style.minWidth = max + 'px'; a.style.textAlign = 'center'; });
});
</script>
