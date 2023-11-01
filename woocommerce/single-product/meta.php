<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<!-- <div class="product_meta d-flex flex-column flex-md-row-reverse justify-content-md-end align-items-md-center"> -->
<div class="product_meta d-flex flex-column gap-4 mt-4">


    <div>
        <?php do_action( 'woocommerce_product_meta_end' ); ?>
    </div>
    
    <?php if ( $product->get_price() ) { ?>
    
    <div>
        <a class="btn btn-comic btn-sm fw-normal mb-3" href="https://wa.me/5491126368931?text=Hola, quiero consultar sobre el producto <?php echo the_title(); ?> (<?php echo the_permalink(); ?>)" target="_blank" title="Clic para enviarnos un WhatsApp!"><i class="bi bi-whatsapp"></i> Consultar sobre <?php echo the_title(); ?></a>
        <div class="d-block w-100">
            <ul id="menu-redes" class="list-unstyled mb-0">
                <li class="list-inline-item mb-2 mb-md-0">
                    <span class="small">Compartir: </span>
                </li>
                <li class="list-inline-item mb-2 mb-md-0">
                    <a class="nav-link h6 text-dark mb-0 icon-foward" target="_blank" href="https://wa.me/?text=<?php the_title()?> %20-%20 <?php the_permalink()?>"><i class="fab fa-whatsapp"></i></a>
                </li>
                <li class="list-inline-item mb-2 mb-md-0">
                    <a class="nav-link h6 text-dark mb-0 icon-foward" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink()?>"><i class="fab fa-facebook-f"></i></a>
                </li>
                <li class="list-inline-item mb-2 mb-md-0">
                    <a class="nav-link h6 text-dark mb-0 icon-foward" target="_blank" href="http://twitter.com/share?url=<?php the_permalink()?>&text=<?php the_title()?>&via=bicienriqueweb"><i class="fab fa-twitter"></i></a>
                </li>
                <li class="list-inline-item mb-2 mb-md-0">
                    <a class="nav-link h6 text-dark mb-0 icon-foward" target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php the_permalink()?>"><i class="fab fa-linkedin-in"></i></a>
                </li>
            </ul>
        </div>
    
    </div>
    <?php } ?>

    <div class="small">
        <!-- <img src="<?php echo get_template_directory_uri() ?>/theme/img/logo_iram_conbajada.webp" class="img-fluid mb-2" width="150px"> -->

        <?php do_action( 'woocommerce_product_meta_start' ); ?>

        <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

        <span class="sku_wrapper d-block"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>

        <?php endif; ?>

        <?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in d-block">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

        <?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as d-block">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>
    </div>

</div>