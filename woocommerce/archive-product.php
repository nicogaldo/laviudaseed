<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' ); ?>


<?php if ( is_product_category() ){
    global $wp_query;

    // get the query object
    $cat = $wp_query->get_queried_object();

    $product_categories_childs = get_terms( 'product_cat', array( 'hide_empty' => true, 'child_of' => $cat->term_id ) );

    // get the thumbnail id using the queried category term_id
    $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );

    // get the image URL
    $image = wp_get_attachment_url( $thumbnail_id ); 
} ?>


<section class="">
    <div class="container-fluid">
        <div class="row position-relative">

            <div class="swiper swiper-header swiper-xs swiper-home px-0">
                <div class="swiper-wrapper">

                    <div class="swiper-slide overlay-8">
                        <?php if ( is_product_category() && $image ) {
                            echo '<img src="' . $image . '" alt="' . $cat->name . '" class="img-fluid"/>';
                        } else { 
                            echo '<img src="' . get_template_directory_uri() . '/theme/img/default.webp" class="img-fluid">';
                        }; ?>

                        <div class="container swiper-caption py-4">
                            <div class="row animate" data-animate="fadeIn" data-duration="1s" data-delay=".5s">

                                <div class="col-md-12 my-4 my-md-auto">
                                    <span class="">

                                        <?php 
                                        if ( apply_filters( 'woocommerce_show_page_title', true ) ) :
                                            do_action( 'woocommerce_before_main_content' );
                                            ?>
                                        <h1 class="woocommerce-products-header__title page-title display-4 fw-bold lh-1 text-uppercase text-white"><?php woocommerce_page_title(); ?></h1>
                                        <?php endif; ?>
                                    </span>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
                <!-- <div class="swiper-button-next"></div> -->
                <!-- <div class="swiper-button-prev"></div> -->
                <div class="swiper-pagination"></div>

            </div>
        </div>
    </div>
</section>

<?php 
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
//do_action( 'woocommerce_before_main_content' );

?>
<!-- <header class="woocommerce-products-header bg-primary pb-3">

    <div class="container">

        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
        <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
        <?php endif; ?>

        <?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
    </div>
</header> -->

<?php //if ( is_product_category() && !$product_categories_childs ) { ?>
<section class="container py-3">
    <div class="row">

        <?php
		/**
		 * Hook: woocommerce_sidebar.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' ); ?>

        <div class="col-12">
            <?php
			if ( woocommerce_product_loop() ) {

				/**
				 * Hook: woocommerce_before_shop_loop.
				 *
				 * @hooked woocommerce_output_all_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );

				woocommerce_product_loop_start();

				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();

						/**
						 * Hook: woocommerce_shop_loop.
						 */
						do_action( 'woocommerce_shop_loop' );

						wc_get_template_part( 'content', 'product' );
					}
				}

				woocommerce_product_loop_end();

				/**
				 * Hook: woocommerce_after_shop_loop.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
			}
			?>

        </div>

        <?php
		/**
		 * Hook: woocommerce_after_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );

		?>

    </div>
</section>
<?php //} ?>


<?php
get_footer( 'shop' );