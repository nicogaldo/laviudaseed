<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body id="top" <?php body_class(); ?>>

    <?php strapword_navbar_before();?>

    <nav id="top-navbar" class="d-none d-md-block navbar navbar-expand navbar-dark bg-primary bg-opacity-75 py-0">
        <div class="container">
            <div class="collapse navbar-collapse">

                <?php
                /* if (is_front_page()) { */ //Show different navbar in home.
                wp_nav_menu( array(
                    'theme_location'  => 'navbar-top',
                    'container'       => true,
                    'menu_class'      => '',
                    'fallback_cb'     => '__return_false',
                    'items_wrap'      => '<ul id="%1$s" class="navbar-nav ms-auto %2$s">%3$s</ul>',
                    'depth'           => 2,
                    'walker'          => new strapword_walker_nav_menu()
                ));
                ?>

            </div>
        </div>
    </nav>

    <div id="navbar-wrapper">
        <nav id="site-navbar" class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">

                <?php strapword_navbar_brand();?>

                
                <?php if ( !is_page( array( 'finalizar-compra', 'carrito' ) ) ) { ?>
                <div class="ms-auto me-3 d-lg-none">
                    <a href="#offcanvasWCCart" data-bs-toggle="offcanvas" role="button" aria-controls="offcanvasWCCart" class="cart-contents nav-link nav-item-4200 text-light">
                        <img src="<?php echo get_template_directory_uri(); ?>/theme/img/cart.svg" class="img-fluid"> <span class="cart-count"> <?php echo WC()->cart->get_cart_contents_count(); ?></span>
                    </a>
                </div>
                <?php } ?>

                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="offcanvas offcanvas-end bg-primary" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">

                        <?php if ( !is_page( array( 'iniciar-sesion', 'registrarse' ) ) ) { ?>
                        <div class="row d-lg-none pb-4 mb-4 border-bottom border-light">
                            <div class="col-4 text-center">
                                <?php if ( is_user_logged_in() ) {
                                //bp_activity_avatar('user_id=' . get_current_user_id() );
                                echo bp_get_loggedin_user_avatar('type=full&width=100%&height=100%');
                            } else {
                                echo '<img src="'.get_template_directory_uri().'/theme/img/VIUDA-FIESTA_sm.webp" class="img-fluid img-floating">';
                            } ?>

                            </div>
                            <div class="col-8 my-auto">
                                <?php if ( is_user_logged_in() ) { ?>
                                <a href="#" class="text-secondary d-block px-2 mb-2"><?php echo bp_get_loggedin_user_username(); ?></a>
                                <a href="<?php echo bp_get_loggedin_user_link(); ?>" class="text-light small text-uppercase px-2 mb-0">Ver mi perfil</a>
                                <?php } else { ?>
                                <a href="<?php echo get_permalink( get_page_by_path( 'iniciar-sesion' ) ); ?>" class="text-secondary d-block px-2 mb-2"><i class="bi bi-box-arrow-in-right"></i> Acceder</a>
                                <a href="<?php echo get_permalink( get_page_by_path( 'registrarse' ) ); ?>" class="text-bg-light px-2 mb-0"><i class="bi bi-person-badge-fill"></i> Registrarse</a>

                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>

                        <?php
                          /* if (is_front_page()) { */ //Show different navbar in home.
                            wp_nav_menu( array(
                              'theme_location'  => 'navbar-home',
                              'container'       => true,
                              'menu_class'      => '',
                              'fallback_cb'     => '__return_false',
                              'items_wrap'      => '<ul id="%1$s" class="navbar-nav ms-auto %2$s">%3$s</ul>',
                              'depth'           => 2,
                              'walker'          => new strapword_walker_nav_menu()
                            ));

                          /* } else {
                            wp_nav_menu( array(
                              'theme_location'  => 'navbar',
                              'container'       => false,
                              'menu_class'      => '',
                              'fallback_cb'     => '__return_false',
                              'items_wrap'      => '<ul id="%1$s" class="navbar-nav mx-auto %2$s">%3$s</ul>',
                              'depth'           => 2,
                              'walker'          => new strapword_walker_nav_menu()
                            ));
                          } */
                        ?>

                        <?php //strapword_navbar_search();?>
                    </div>
                </div>

            </div>
        </nav>
    </div>

    <?php strapword_navbar_after();?>