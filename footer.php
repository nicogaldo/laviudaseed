<?php

strapword_footer_before();

$options = get_option( 'strapword_options' ); 
$redes = $options['menu_redes']; 
$menu = $options['activate_menu_redes']; 
?>

<footer id="site-footer" class="bg-dark border-top">

    <!-- <div class="container-xxl">

        <?php //if(is_active_sidebar('footer-widget-area')): ?>
        <div class="row pt-5 pb-4" id="footer" role="navigation">
            <?php //dynamic_sidebar('footer-widget-area'); ?>
        </div>
        <?php //endif; ?>

    </div> -->

    <div class="container py-4">
        <div class="row py-4">

            <div class="col-12 col-md-4 text-center text-md-start mb-4 mb-md-0">
                <?php strapword_footer_brand();?>
            </div>

            <div class="col-12 col-md-4 text-light">

            </div>

            <div class="col-12 col-md-4 text-center text-md-end">
                <?php
                if ( ! empty( $redes ) && $menu ) { ?>

                <span class="fs-6 fw-bold text-light d-inline-block mb-2"><?php echo $options['title_redes']; ?></span>

                <ul id="menu-redes" class="list-inline d-inline-block mb-0">

                    <?php
                    //$redes['whatsapp_general'] = implode(',', $redes['whatsapp_general']);

                    foreach ( $redes as $red => $val ) {

                        $val = trim($val);

                        if ($val == ',,0') {
                            $val = '';
                        }

                        if( ( !empty($val)  ) )  {
                    
                            echo '<li class="list-inline-item mb-2">';
                            if ( $red == 'email_general' ) {
                                $icon = 'fa-solid fa-envelope';
                                $href = 'mailto:'.$val.'';
                            }
                            
                            if ( $red == 'facebook_general' ) {
                                $icon = 'fa-brands fa-facebook';
                                $href = 'https://www.facebook.com/'.$val.'';
                            }
                            
                            if ( $red == 'instagram_general' ) {
                                $icon = 'fa-brands fa-instagram';
                                $href = 'https://www.instagram.com/'.$val.'';
                            }
                            
                            if ( $red == 'telegram_general' ) {
                                $icon = 'fa-brands fa-telegram';
                                $href = 'https://t.me/'.$val.'';
                            }
                            
                            if ( $red == 'tiktok_general' ) {
                                $icon = 'fa-brands fa-tiktok';
                                $href = 'https://www.tiktok.com/@'.$val.'';
                            }
                            
                            if ( $red == 'twitter_general' ) {
                                $icon = 'fa-brands fa-twitter';
                                $href = 'https://www.twitter.com/'.$val.'';
                            }
                            
                            if ( $red == 'linkedin_general' ) {
                                $icon = 'fa-brands fa-linkedin';
                                $href = 'https://ar.linkedin.com/company/'.$val.'';
                            }
                            
                            if ( $red == 'youtube_general' ) {
                                $icon = 'fa-brands fa-youtube';
                                $href = 'https://www.youtube.com/'.$val.'';
                            }
                            echo '<a class="nav-link text-secondary icon-foward" target="_blank" href="'.$href.'"><i class="fs-5 fa-fw '.$icon.'"></i></a>';
                            echo '</li>';
                        
                        }
                    }
                    echo '</ul>';
                } ?>

            </div>
        </div>
    </div>

</footer>

<?php //strapword_footer_after();?>

<?php strapword_bottomline();?>

<?php if ( !is_buddypress() && $options['whatsapp_floating_button'] ) {

if ( $options['gotop_button'] ) { ?>

    <style>
        a.go-top,
        a.go-top.on {
            right: 22px !important;
        }

        a.go-top.on {
            bottom: 90px !important;
        }
    </style>

<?php } 

if ( !is_buddypress() && $options['whatsapp_general']['whatsapp_number'] ) { ?>
<a class="btn btn-whatsapp" data-animate="bounceIn" data-duration="1.2s" data-delay="4s" title="¡Envianos un WhatsApp!" target="_blank" href="https://wa.me/?phone=<?php echo $options['whatsapp_general']['whatsapp_number']; ?>&text=<?php echo $options['whatsapp_general']['whatsapp_text']; ?>"><i class="fa-brands fa-fw fa-whatsapp"></i></a>
<?php }
} // end if whatsapp_floating_button

if ( $options['gotop_button'] ) { ?>
<a href="#top" class="btn btn-secondary go-top px-2 py-1 smooth"><i class="fas fa-angle-up"></i></a>
<?php } ?>

<?php if (is_woocommerce_activated()) { ?>
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasWCCart" aria-labelledby="offcanvasWCCartLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-dark" id="offcanvasWCCartLabel">Carrito</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body woocommerce">
        <div class="widget_shopping_cart_content">
            <?php woocommerce_mini_cart(); ?>
        </div>
    </div>
</div>
<?php } ?>

<?php wp_footer(); ?>
</body>

</html>