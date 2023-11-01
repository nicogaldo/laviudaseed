<?php
/**
 * WooCommerce Support
 */

function strapword_add_woocommerce_support() {

    /* $thumbnail = array(
        'width'     => "270",   // px
        'height'    => "0",   // px
        'crop'      => 0 // Disabling Hard crop option.
    ); */

	add_theme_support( 'woocommerce', array(
		'gallery_thumbnail_image_width' => 150,
        //'thumbnail_image_width' => $thumbnail,
		'thumbnail_image_width' => 400,
		'single_image_width'    => 750,

		'product_grid'          => array(
			//'default_rows'      => 3,
			//'min_rows'          => 2,
			//'max_rows'          => 8,
			'default_columns'   => 3,
			//'min_columns'       => 2,
			'max_columns'       => 4,
		),
	) );

	//add_theme_support( 'wc-product-gallery-zoom' );
	//add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'strapword_add_woocommerce_support' );

/* =============================== */
/*        WC Bootstrap Forms       */
/* =============================== */
function strapword_wc_bst_form( $args, $key, $value = null ) {

	/* This is not meant to be here, but it serves as a reference
	of what is possible to be changed.
	$defaults = array(
		'type'			  => 'text',
		'label'			 => '',
		'description'	   => '',
		'placeholder'	   => '',
		'maxlength'		 => false,
		'required'		  => false,
		'id'				=> $key,
		'class'			 => array(),
		'label_class'	   => array(),
		'input_class'	   => array(),
		'return'			=> false,
		'options'		   => array(),
		'custom_attributes' => array(),
		'validate'		  => array(),
		'default'		   => '',
	); */

	// Start field type switch case
	switch ( $args['type'] ) {

		case "select" :  /* Targets all select input type elements, except the country and state select input types */
			$args['class'][] = 'form-group'; // Add a class to the field's html element wrapper - woocommerce input types (fields) are often wrapped within a <p></p> tag
			$args['input_class'] = array('form-control', 'input-lg'); // Add a class to the form input itself
			//$args['custom_attributes']['data-plugin'] = 'select2';
			$args['label_class'] = array('control-label');
			$args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',  ); // Add custom data attributes to the form input itself
		break;

		case 'country' : /* By default WooCommerce will populate a select with the country names - $args defined for this specific input type targets only the country select element */
			$args['class'][] = 'form-group single-country';
			$args['label_class'] = array('control-label');
		break;

		case "state" : /* By default WooCommerce will populate a select with state names - $args defined for this specific input type targets only the country select element */
			$args['class'][] = 'form-group'; // Add class to the field's html element wrapper
			$args['input_class'] = array('form-control', 'input-lg'); // add class to the form input itself
			//$args['custom_attributes']['data-plugin'] = 'select2';
			$args['label_class'] = array('control-label');
			$args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',  );
		break;

		case "password" :
		case "text" :
		case "email" :
		case "tel" :
		case "number" :
			$args['class'][] = 'form-group';
			//$args['input_class'][] = 'form-control input-lg'; // will return an array of classes, the same as bellow
			$args['input_class'] = array('form-control', 'input-lg');
			$args['label_class'] = array('control-label');
		break;

		case 'textarea' :
			$args['input_class'] = array('form-control', 'input-lg');
			$args['label_class'] = array('control-label');
		break;

		case 'checkbox' :
		break;

		case 'radio' :
		break;

		default :
			$args['class'][] = 'form-group';
			$args['input_class'] = array('form-control', 'input-lg');
			$args['label_class'] = array('control-label');
		break;
	}

	return $args;
}
add_filter('woocommerce_form_field_args','strapword_wc_bst_form',10,3);

/* ==================================== */
/*                Sidebar               */
/* ==================================== */
function strwrd_widgets_init() {
  register_sidebar( array(
    'name'            => __( 'Shop Widget Area', 'b5st' ),
    'id'              => 'shop',
    'description'     => __( 'Use 1, 2, 3 or 4 widgets.', 'b5st' ),
    'before_widget'   => '<div class="%1$s %2$s col-md-auto mb-3">',
    'after_widget'    => '</div>',
    'before_title'    => '<h2 class="h4">',
    'after_title'     => '</h2>',
  ) );
}
add_action( 'widgets_init', 'strwrd_widgets_init' );

/* =============================== */
/*            Breadcrums           */
/* =============================== */
// https://woocommerce.com/document/customise-the-woocommerce-breadcrumb/
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );
function jk_woocommerce_breadcrumbs() {

    $nav = '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">';
    $close_nav = '</nav>';

    if( is_product() ) {
        $nav = '<nav class="woocommerce-breadcrumb bg-primary py-2 mb-0" itemprop="breadcrumb"><div class="container">';
        $close_nav = '</div></nav>';
    }

    return array(
            'delimiter'   => ' » ',
            //'wrap_before' => '<nav class="woocommerce-breadcrumb bg-primary py-2 mb-0" itemprop="breadcrumb"><div class="container">',
            'wrap_before' => $nav,
            'wrap_after'  => $close_nav,
            'before'      => '',
            'after'       => '',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}

/* =============================== */
/*           Catalog mode          */
/* =============================== */
// Remove Price on Product Loop
//remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
// Remove Price on Single Product Page
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
// Remove Add to Cart Button on Single Product Page 
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
// Remove Sale Flash Badge on Product Loop
//remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
// Remove Sale Flash Badge on Single Product Page 
//remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

/* =============================== */
/*   Discount per payment method   */
/* =============================== */
// Show discount price in single product page
add_filter( 'woocommerce_get_price_suffix', 'add_some_text_after_price', 99, 4 );
function add_some_text_after_price ($html, $product, $price, $qty) {
    global $woocommerce_loop;
    
    $discount = 17000; // set discount fix price
    $final_price = $product->get_price() - $discount;
    $product_categories = wp_get_post_terms( $product->get_id(), 'product_cat', array("fields" => "ids") );
    $cat_semas_id = 87;
    
    if ( is_product() && !$product->is_type( 'variable' ) && in_array( $cat_semas_id, $product_categories) && $woocommerce_loop['name'] !== 'related' && $woocommerce_loop['name'] !== 'up-sells' ) {
        $html .= ' <span class="price-suffix price-dto-bacs"> Precio con transferencia bancaria:<br> ' . wc_price($final_price) . '</span>';
    }
    return $html;
}

// Show discount price in single product page if is variation
add_filter('woocommerce_available_variation', 'variation_price_custom_suffix', 10, 3 );
function variation_price_custom_suffix( $variation_data, $product, $variation ) {
    $discount = 10000; // set discount fix price
    $product_categories = wp_get_post_terms( $product->get_id(), 'product_cat', array("fields" => "ids") );
    $cat_semas_id = 87;

    //print_r($variation_data['attributes']);

    $item_variation = $variation_data['attributes'];

    foreach ($item_variation as $key => $value) {
        switch ($value) {
            case 'x2':
                $discount = 10000;
                break;
            case 'x4':
                $discount = 13000;
                break;
            case 'x7':
                $discount = 15000;
                break;
            case 'x12':
                $discount = 17000;
                break;
            default:
                $discount = 10000;
                break;
        }
        $final_price = $variation->get_price() - $discount;
    }

    //$final_price = $variation->get_price() - $discount;
    
    //echo '<pre>';
    //print_r($product_categories);
    //echo '</pre>';

    if ( in_array( $cat_semas_id, $product_categories)) {
        $variation_data['price_html'] .= ' <span class="price-suffix price-dto-bacs text-dark"> Precio con transferencia bancaria:<br> ' . wc_price($final_price) . '</span>';
    }
    return $variation_data;
}

// Update discount price per payment method
function action_woocommerce_before_calculate_totals( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
        return;

    $discount = 17000;
    // Get payment method
    $chosen_payment_method = WC()->session->get( 'chosen_payment_method' );

    if ( is_checkout() && $chosen_payment_method == 'bacs' ) {


        // Loop through cart items
        foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {     

            //print_r($cart_item['variation']);
            
            $cart_item_variation = $cart_item['variation'];
            // Get price
            $price = $cart_item['data']->get_price();
            // Set price

            if ($cart_item_variation) {
                foreach ($cart_item_variation as $key => $value) {
                    switch ($value) {
                        case 'x2':
                            $discount = 10000;
                            break;
                        case 'x4':
                            $discount = 13000;
                            break;
                        case 'x7':
                            $discount = 15000;
                            break;
                        case 'x12':
                            $discount = 17000;
                            break;
                        default:
                            $discount = 17000;
                            break;
                    }
                    $cart_item['data']->set_price( $price - $discount );
                }
            } else {
                $cart_item['data']->set_price( $price - 17000 );
            }
        }
    }
}
add_action( 'woocommerce_before_calculate_totals', 'action_woocommerce_before_calculate_totals', 10, 1 );    

function action_wp_footer() {
    if ( is_checkout() && ! is_wc_endpoint_url() ) :
    ?>
    <script type="text/javascript">
        jQuery(function($){
            $( 'form.checkout' ).on( 'change', 'input[name="payment_method"]', function() {
                $(document.body).trigger( 'update_checkout' );
            });
        });
    </script>
    <?php
    endif;
}
add_action( 'wp_footer', 'action_wp_footer' );

/* function cp_change_product_price_display_in_cart( $price, $cart_item, $cart_item_key ) {
    $product = $cart_item['data'];
    if ( 'yes' === $product->get_meta( '_ywsbs_subscription' ) ) {
        return $price;
    }
    return 'Rent: ' . $price . '/day';
}

add_filter( 'woocommerce_cart_item_price', 'cp_change_product_price_display_in_cart', 10, 3 ); */

/* =============================== */
/*        Format Price Range       */
/* =============================== */
function strapword_format_price_range( $price, $from, $to ) {
    return sprintf( '%s %s', __( '<span class="from-price text-muted">Desde:</span>', 'iconic' ), wc_price( $from ) );
}
add_filter( 'woocommerce_format_price_range', 'strapword_format_price_range', 10, 3 );

/* =============================== */
/*          Discount Badge         */
/* =============================== */
add_filter( 'woocommerce_get_price_html', 'change_displayed_sale_price_html', 10, 2 );
function change_displayed_sale_price_html( $price, $product ) {
    // Only on sale products on frontend and excluding min/max price on variable products
    if( $product->is_on_sale() && ! is_admin() && ! $product->is_type('variable') && ! $product->is_type('grouped')){
        // Get product prices
        $regular_price = (float) $product->get_regular_price(); // Regular price
        $sale_price = (float) $product->get_price(); // Active price (the "Sale price" when on-sale)
        // "Saving Percentage" calculation and formatting
        $precision = 0; // Max number of decimals
        $saving_percentage = round( 100 - ( $sale_price / $regular_price * 100 ), $precision ) . '%';
        // Append to the formated html price
        $price .= sprintf( __('<p class="badge-percent">%s OFF</p>', 'woocommerce' ), $saving_percentage );
    }
    return $price;
}

/**
 * @snippet       Display "Sold Out" on Loop Pages - WooCommerce
 * @how-to        Get CustomizeWoo.com FREE
 * @sourcecode    https://businessbloomer.com/?p=17420
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 3.4.3
 */
add_action( 'woocommerce_before_shop_loop_item_title', 'bbloomer_display_sold_out_loop_woocommerce' );
function bbloomer_display_sold_out_loop_woocommerce() {
    global $product;
    if ( !$product->is_in_stock() ) {
        echo '<span class="soldout">' . __( 'Agotado', 'woocommerce' ) . '</span>';
    }
}

/* =============================== */
/*        Add Cart menu item       */
/* =============================== */
function add_menu_items($items, $args) {

    if ($args->theme_location == 'navbar-home' || $args->theme_location == 'navbar') {
        $class = array();
        $url = '#offcanvasWCCart';
        $class[] = 'd-none d-lg-flex';
        
        if (is_cart()) {
            $class[] = 'active current';
            $url = '#';
        }

        $title = '<img src="'. get_template_directory_uri() .'/theme/img/cart.svg" class="img-fluid"> <span class="cart-count">'. WC()->cart->get_cart_contents_count() .'</span>';

        $toAdd = [
            (object) [
                'title'                 => $title,
                'menu_item_parent'      => 0, //FOR SUBMENU ITEM SET PARENT's db_id
                'current'               => '',
                'current_item_ancestor' => '',
                'ID'                    => 4200,
                'object_id'             => 4200,
                'db_id'                 => 99992,
                'url'                   => $url,
                'classes'               => $class
            ],
        ];

        $items = array_merge($items, $toAdd);
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'add_menu_items', 5, 2);

/**
 * Update navbar mini-cart (not only when page is refreshed)
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'strapword_add_to_cart_fragments' );
function strapword_add_to_cart_fragments( $fragments ) {
    ob_start();
    $cart_contents_count = WC()->cart->cart_contents_count;
    ?>
    <a href="#offcanvasWCCart" data-bs-toggle="offcanvas" role="button" aria-controls="offcanvasWCCart" class="cart-contents nav-link nav-item-4200 text-light">
    <img src="<?php echo get_template_directory_uri(); ?>/theme/img/cart.svg" class="img-fluid"> <span class="cart-count"><?php echo esc_html( $cart_contents_count ); ?></span>
    </a>
    <?php 
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}

// Changue Message After Add to Cart Action
add_filter ( 'wc_add_to_cart_message_html', 'wc_add_to_cart_message_filter', 10, 2 );
function wc_add_to_cart_message_filter($message, $products) {
    global $woocommerce;
    $return_to  = get_permalink(wc_get_page_id('shop'));
    $message    = sprintf('<a href="%s" class="button wc-forwards">%s</a> %s <a %s class="button me-2">%s</a>', $return_to, __('Sigue comprando', 'woocommerce'), __('Producto añadido correctamente a tu carrito.', 'woocommerce'), 'href="#offcanvasWCCart" data-bs-toggle="offcanvas" role="button" aria-controls="offcanvasWCCart"', 'Ver carrito' );
    return $message;
}

/* =============================== */
/*           Product Loop          */
/* =============================== */
// Change Order Title Product & Thumbnail
// Remove Title Product on Loop
//remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
// Remove Title Thumbnail on Loop
//remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
// Change Order 
/* add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
    function woocommerce_template_loop_product_thumbnail() {
				echo '<h2 class="woocommerce-loop-product__title">'. get_the_title() .'</h2>';
        echo "<div class='wc-img-wrapper overflow-hidden mb-2'>";
        echo woocommerce_get_product_thumbnail();
        echo "</div>";
    }
} */

// Add Category & Brand on Card Loop Product
add_action( 'woocommerce_before_shop_loop_item_title', 'strapword_before_shop_loop_item_title', 10 );
function strapword_before_shop_loop_item_title() {

    global $product;
    $product_id = $product->get_id();
    $brands = wp_get_post_terms( $product_id, 'pwb-brand' );
    //foreach( $brands as $brand ) echo '<p>'.$brand->name.'</p>';

    global $post;
    $terms = get_the_terms( $post->ID, 'product_cat' );
    if ( $terms && ! is_wp_error( $terms ) ) :
    //only displayed if the product has at least one category
        $cat_links = array();
        foreach ( $terms as $term ) {
            $cat_links[] = $term->name;
        }
        //$on_cat = join( " ", $cat_links );
        if ($brands || $cat_links) {
            echo '<div class="product-cat text-center pt-3">';
            echo ($brands && $cat_links) ? $brands[0]->name .' - ' . $cat_links[0] : '';
            echo ($brands && empty($cat_links)) ? $brands[0]->name : '';
            echo (empty($brands) && $cat_links) ? $cat_links[0] : '';
            echo '</div>';
        }
    endif;
}

// Add Product Attributes on Card Loop Product
add_action( 'woocommerce_after_shop_loop_item_title', 'strapword_after_shop_loop_item_title', 10 );
function strapword_after_shop_loop_item_title() {
    global $product;
    //$variations = $product->get_available_variations();
    $attr = $product->get_attribute( 'formato' );
    if ( strpos($attr, '|') ) {
        echo '<div class="small text-center text-dark mt-n2">'.$attr .'</div>';
    }
}

// Change add to cart string button on Product Loop 
add_filter( 'woocommerce_loop_add_to_cart_link', 'replacing_add_to_cart_button', 10, 2 );
function replacing_add_to_cart_button( $button, $product  ) {

	$product_type = $product->get_type();
    $button_text = 'Ver más';

	switch ( $product_type ) {
		case 'grouped':
			$button_text = __( 'Ver Productos', 'woocommerce' );
		break;
		case 'simple':

			if ( !$product->is_in_stock() || !$product->get_price() ) {
				$button_text = __( 'Ver más', 'woocommerce' );
			} else {
				$button_text = __( 'Comprar', 'woocommerce' );
			}

		break;
		case 'variable':

			if ( !$product->is_in_stock() ) {
				$button_text = __( 'Ver más', 'woocommerce' );
			} else {
				$button_text = __( 'Ver opciones', 'woocommerce' );
			}

		break;
		default:
			$button_text = __( 'Ver más', 'woocommerce' );
	}

    $button  = '<div class="d-flex flex-column flex-sm-row gap-1 justify-content-center mt-2 mx-auto">';
    // FOR AJAX ADD TO CART ADD THESE ATTRS
    //$html .= '<a href="' . esc_url( $product->add_to_cart_url() ) . '" class="button alt product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="'.$product->id.'" data-quantity="1" data-product_sku="'.$product->sku.'" aria-label="Añade “'.$product->name.'” a tu carrito" aria-describedby="" rel="nofollow">' . $button_text .'</a>';
    $button .= '<a class="btn btn-secondary btn-sm btn-comic fw-normal view_more_button" href="' . $product->get_permalink() . '">'.$button_text.'</a>';
    //$button .= '<a class="btn btn-primary btn-sm fw-normal text-white send_whatsapp_button" target="_blank" href="https://wa.me/123456789?text=Hola, quiero consultar sobre el producto '. get_the_title() .'"><i class="bi bi-whatsapp"></i> Consultar </a>';
    $button .= '</div>';
    return $button;
}

/* =============================== */
/*            Shop Page            */
/* =============================== */
// Remove "Default Sorting" Dropdown @ WooCommerce Shop & Archive Pages  
//remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

/* =============================== */
/*           Product Page          */
/* =============================== */
// Move Title Product on Single Page - Template Title is now 'share options'
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 36 );

/**
 * Move product tabs short description
 * source: https://businessbloomer.com/woocommerce-move-product-tabs-short-description/
 */
//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 35 );


// Remove short description
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

// Add short description to a custom product tab
add_filter( 'woocommerce_product_tabs', 'add_custom_product_tab', 10, 1 );
function add_custom_product_tab( $tabs ) {
    $short_description_tab = array(
        'short_description_tab' =>  array(
            'title' => __( "Short description", "woocommerce" ),
            'priority' => 12,
            'callback' => 'short_description_tab_content'
        )
    );
    return array_merge( $short_description_tab, $tabs );
}

// Custom product tab content
function short_description_tab_content() {
    global $post, $product;

    $short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

    if ( ! $short_description ) {
        return;
    }

    echo '<div class="woocommerce-product-details__short-description">' . $short_description . '</div>'; // WPCS: XSS ok.
}
// Remove product data tabs
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    //unset( $tabs['additional_information'] );
    unset( $tabs['description'] );
    unset( $tabs['reviews'] ); 
    return $tabs;
}

/**
 * Change number of related products output
 */ 
/* add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
function jk_related_products_args( $args ) {
    $args['posts_per_page'] = 3; // 4 related products
    $args['columns'] = 3; // arranged in 2 columns
    return $args;
}
 */

/*===================================
=            Performance            =
===================================*/
//https://www.webnots.com/fix-slow-page-loading-with-woocommerce-wc-ajaxget_refreshed_fragments/
/** Disable Ajax Call from WooCommerce */
//add_action( 'wp_enqueue_scripts', 'dequeue_woocommerce_cart_fragments', 11); 
//function dequeue_woocommerce_cart_fragments() { if (is_front_page()) wp_dequeue_script('wc-cart-fragments'); }