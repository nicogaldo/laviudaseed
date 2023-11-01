<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce\Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

//the_title( '<h1 class="product_title entry-title">', '</h1>' ); ?>

<?php if ( !$product->get_price() ) { ?>
<div class="d-block w-100 clearfix"></div>
<a class="btn btn-comic btn-sm fw-normal mb-3" href="https://wa.me/5491126368931?text=Hola, quiero consultar sobre el producto <?php echo the_title(); ?> (<?php echo the_permalink(); ?>)" target="_blank" title="Clic para enviarnos un WhatsApp!"><i class="bi bi-whatsapp"></i> Consultar sobre <?php echo the_title(); ?></a>
<div class="d-block w-100 mb-4">
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
<?php } ?>