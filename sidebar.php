<?php
/**
 * The Sidebar
 * ===========
 * 
 * Note: The main column has simply Bootstrap flexbox "col-sm" so it will expand
 * to occupy the whole row (if no sidebar) or to occupy whatever part of the row
 * is available (if there is a sidebar, or more than one sidebar, etc.).
 *
 * (So, you don't need to set the main column to col-sm-8 or whatever.)
 */
?>

<?php if( is_active_sidebar('mainbody-widget-area-1') ): ?>

<?php if (is_woocommerce()) { ?>
<button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWCFilter" aria-controls="offcanvasWCFilter" class="btn btn-lg btn-outline-dark fw-normal text-uppercase rounded-3 d-block w-auto py-0 px-3 ms-auto mb-3"> Filtrar <i class="bi bi-filter"></i> </button>
<?php } // end if woocommerce?>

<div id="sidebar" class="sidebar col-12" role="navigation">
    <!-- <div id="sidebar" class="sidebar col" role="navigation"> -->
    <?php
    //strapword_mainbody_widgets_1_before();
    if (is_woocommerce()) { ?>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasWCFilter" aria-labelledby="offcanvasWCFilterLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWCFilterLabel">Filtrar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

            <div class="block-8 widget_block col-md-auto mb-3">
                <h2>Categorías</h2>
            </div>
            
            <div class="block-8 widget_block col-md-auto mb-3">
                <?php
                    wp_nav_menu( array(
                        'theme_location'  => 'navbar-wc-categories',
                        'container'       => true,
                        'menu_class'      => '',
                        'fallback_cb'     => '__return_false',
                        'items_wrap'      => '<ul id="%1$s" class="navbar-nav nav-vertical ms-auto %2$s">%3$s</ul>',
                        'depth'           => 2,
                        'walker'          => new strapword_walker_nav_menu()
                    ));
                ?>
            </div>

            <?php dynamic_sidebar('shop'); ?>
        </div>
    </div>

    <?php
    } else {
        dynamic_sidebar('mainbody-widget-area-1');
    }
    //strapword_mainbody_widgets_1_after();
        ?>
</div>
<?php endif; ?>