<?php
  // Template Name: Page Home
  get_header(); 
  strapword_mainbody_before();

  $options = get_option( 'strapword_options' );
  $slider = $options['slider_home'];
?>

<header>
    <div class="container-fluid">
        <div class="row position-relative">

            <div class="swiper swiper-home px-0">
                <div class="swiper-wrapper">
                    <?php
                    if ( ! empty( $slider ) ) {
                            foreach ( $slider as $sliderItem ) { ?>

                    <?php if( ( $sliderItem['slider_home_text'] && ( $sliderItem['slider_home_main_text'] || $sliderItem['slider_home_secondary_text'] ) ) || $sliderItem['slider_home_button'] ) { $overlay = 'overlay-5'; } else { $overlay = ''; }; ?>

                    <div class="swiper-slide <?= $overlay; ?>">

                        <?php if ( ! empty( $sliderItem['slider_home_link'] )) { ?>

                        <a target="_blank" href="<?php echo $sliderItem['slider_home_link']; ?>">
                            <?php if ( $sliderItem['slider_home_img_mobile']['url'] && $sliderItem['slider_home_img_pc']['url'] ) { ?>
                            <picture>
                                <source srcset="<?php echo $sliderItem['slider_home_img_pc']['url']; ?>" media="(min-width: 992px)">
                                <img src="<?php echo $sliderItem['slider_home_img_mobile']['url']; ?>" alt="<?php echo $sliderItem['slider_home_name']; ?>" class="img-fluid">
                            </picture>
                            <?php } else { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/theme/img/default.webp" alt="<?php bloginfo( 'name' ); ?>" class="img-fluid">
                            <?php } ?>
                        </a>

                        <?php if( ( $sliderItem['slider_home_text'] && ( $sliderItem['slider_home_main_text'] || $sliderItem['slider_home_secondary_text'] ) ) || $sliderItem['slider_home_button'] ){ ?>

                        <style>
                        .<?php echo $sliderItem['slider_home_button_id'];

                        ?>.btn-slider {
                            padding: <?php echo $sliderItem['slider_home_tabs']['slider_home_size_mobile']['top'];
                            ?><?php echo $sliderItem['slider_home_tabs']['slider_home_size_mobile']['unit'];
                            ?><?php echo $sliderItem['slider_home_tabs']['slider_home_size_mobile']['left'];
                            ?><?php echo $sliderItem['slider_home_tabs']['slider_home_size_mobile']['unit'];
                            ?> !important;
                            font-size: <?php echo $sliderItem['slider_home_tabs']['slider_home_fs_mobile'];
                            ?>px !important;
                        }


                        @media only screen and (min-width: 768px) {

                            .<?php echo $sliderItem['slider_home_button_id'];

                            ?>.btn-slider {
                                padding: <?php echo $sliderItem['slider_home_tabs']['slider_home_size_tablet']['top'];
                                ?><?php echo $sliderItem['slider_home_tabs']['slider_home_size_tablet']['unit'];
                                ?><?php echo $sliderItem['slider_home_tabs']['slider_home_size_tablet']['left'];
                                ?><?php echo $sliderItem['slider_home_tabs']['slider_home_size_tablet']['unit'];
                                ?> !important;
                                font-size: <?php echo $sliderItem['slider_home_tabs']['slider_home_fs_tablet'];
                                ?>px !important;
                            }
                        }

                        @media only screen and (min-width: 992px) {

                            .<?php echo $sliderItem['slider_home_button_id'];

                            ?>.btn-slider {
                                padding: <?php echo $sliderItem['slider_home_tabs']['slider_home_size_desktop']['top'];
                                ?><?php echo $sliderItem['slider_home_tabs']['slider_home_size_desktop']['unit'];
                                ?><?php echo $sliderItem['slider_home_tabs']['slider_home_size_desktop']['left'];
                                ?><?php echo $sliderItem['slider_home_tabs']['slider_home_size_desktop']['unit'];
                                ?> !important;
                                font-size: <?php echo $sliderItem['slider_home_tabs']['slider_home_fs_desktop'];
                                ?>px !important;
                            }
                        }
                        </style>

                        <div class="container swiper-caption <?php echo $sliderItem['slider_home_button_id']; ?> py-4" style="top: <?= $sliderItem['slider_home_vertical_position'] ?>%!important;">
                            <div class="row justify-content-center animate" data-animate="fadeIn" data-duration="1s" data-delay=".3s">
                                <div class="text-white text-center py-4">

                                    <h1><?php echo $sliderItem['slider_home_main_text']; ?></h1>

                                    <p class="fs-5 text-break"><?php echo $sliderItem['slider_home_secondary_text']; ?></p>

                                    <?php if (  $sliderItem['slider_home_button'] ) { ?>
                                    <a target="_blank" href="<?php echo $sliderItem['slider_home_link']; ?>" class="btn btn-primary mx-auto"><?php echo $sliderItem['slider_home_button_text']; ?></a>
                                    <?php } ?>

                                </div>


                            </div>
                        </div> <!-- end .container -->

                        <?php 
                            } //end if button 
                        } else { ?>
                        <!-- end if enlace -->

                        <picture>
                            <source srcset="<?php echo $sliderItem['slider_home_img_pc']['url']; ?>" media="(min-width: 992px)">
                            <img src="<?php echo $sliderItem['slider_home_img_mobile']['url']; ?>" alt="<?php echo $sliderItem['slider_home_name']; ?>" class="img-fluid">
                        </picture>

                        <?php } ?>

                    </div>

                    <?php
                        } 
                    } else { ?>

                    <div class="swiper-slide">
                        <img src="<?php echo get_template_directory_uri(); ?>/theme/img/default.webp" alt="<?php bloginfo( 'name' ); ?>" class="img-fluid">
                    </div>
                    <?php   
                        }
                    ?>
                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>

            </div>

        </div>
    </div>
</header>

<main id="site-main">

    <section class="py-5">
        <div class="container">
            <div class="row position-relative h-100">

                <div class="col-12">
                    <h1 class="fs-2 text-center text-uppercase mb-0">Genéticas destacadas</h1>
                    <span class="text-center d-block mb-3">De lo más copado</span>
                </div>

                <div class="col-12 position-relative">
                    <div class="woocommerce swiper swiper-destacados px-0">
                        <ul class="swiper-wrapper products">
                            <?php
                            

                            $args = array(
                                'post_type' => 'product',
                                'posts_per_page' => 10,
                                //'product_tag'
                                'tax_query' => array( array(
                                    'taxonomy' => 'product_visibility',
                                    'field'    => 'name',
                                    'terms'    => 'featured',
                                    'operator' => 'IN',
                                ) )
                            );
                            $loop = new WP_Query( $args );

                            if ( $loop->have_posts() ) {
                            while ( $loop->have_posts() ) : $loop->the_post(); ?>

                            <div class="swiper-slide product">
                                <?php wc_get_template_part( 'content', 'product' ); ?>
                            </div>

                            <?php
                                endwhile;
                            } else {
                                echo __( 'No products found' );
                            }
                            wp_reset_postdata();
                            ?>

                        </ul>

                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <?php //echo do_shortcode('[recent_products limit="5" columns="5" category="" class="col-12 swiper swiper-destacados mb-0 mt-4 px-0"]'); ?>

            </div>
        </div>
    </section>

    <section class="bg-dark text-white">
        <div class="container">
            <div class="row position-relative h-100 py-5">

                <div class="col-12 col-md-4 mb-4 mb-md-0 animate" data-animate="fadeInUp" data-duration="1.2s" data-delay=".2s">
                    <div class="d-flex gap-3 justify-content-center align-items-center">
                        <div>
                            <i class="bi bi-shield-check fa-3x"></i>
                        </div>
                        <div>
                            <span class="d-block fs-3 fw-bold">Compra Segura</span>
                            <span class="d-block fs-6">Tu compra está protegida!</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-4 mb-md-0 animate" data-animate="fadeInUp" data-duration="1.2s" data-delay=".4s">
                    <div class="d-flex gap-3 justify-content-center align-items-center">
                        <div>
                            <i class="bi bi-truck fa-3x"></i>
                        </div>
                        <div>
                            <span class="d-block fs-3 fw-bold">Envios</span>
                            <span class="d-block fs-6">A todo el país!</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-4 mb-md-0 animate" data-animate="fadeInUp" data-duration="1.2s" data-delay=".6s">
                    <div class="d-flex gap-3 justify-content-center align-items-center">
                        <div>
                            <i class="bi bi-credit-card fa-3x"></i>
                        </div>
                        <div>
                            <span class="d-block fs-3 fw-bold">Pagos</span>
                            <span class="d-block fs-6">3 cuotas sin interés!</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-5 bg-cut">
        <div class="container">
            <div class="row g-md-5 position-relative h-100">

                <div class="col-12 col-md-6 position-relative mb-4 mb-md-0">
                    <div class="woocommerce swiper swiper-cats px-0">
                        <h1 class="fs-2 text-center text-uppercase mb-0">Mixes</h1>
                        <span class="text-center d-block mb-3">Tené variedad</span>
                        <ul class="swiper-wrapper products">
                            <?php
                            $args = array(
                                'post_type' => 'product',
                                'posts_per_page' => 10,
                                'product_tag'   => 'Mix'
                            );
                            $loop = new WP_Query( $args );

                            if ( $loop->have_posts() ) {
                                while ( $loop->have_posts() ) : $loop->the_post(); ?>

                            <div class="swiper-slide product">
                                <?php wc_get_template_part( 'content', 'product' ); ?>
                            </div>

                            <?php
                                endwhile;
                            } else {
                                echo __( 'No products found' );
                            }
                            wp_reset_postdata();
                            ?>

                        </ul>

                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>


                <div class="col-12 col-md-6 position-relative mt-4 mt-md-auto">
                    <div class="woocommerce swiper swiper-cats px-0">
                        <h1 class="fs-2 text-center text-uppercase mb-0">Faster</h1>
                        <span class="text-center d-block mb-3">Las quiero yaaa</span>
                        <ul class="swiper-wrapper products">
                            <?php
                            $args = array(
                                'post_type' => 'product',
                                'posts_per_page' => 10,
                                'product_tag'   => 'Faster'
                            );
                            $loop = new WP_Query( $args );

                            if ( $loop->have_posts() ) {
                                while ( $loop->have_posts() ) : $loop->the_post(); ?>

                            <div class="swiper-slide product">
                                <?php wc_get_template_part( 'content', 'product' ); ?>
                            </div>

                            <?php
                                endwhile;
                            } else {
                                echo __( 'No products found' );
                            }
                            wp_reset_postdata();
                            ?>

                        </ul>

                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <?php //echo do_shortcode('[recent_products limit="5" columns="5" category="" class="col-12 swiper swiper-destacados mb-0 mt-4 px-0"]'); ?>

            </div>
        </div>
    </section>

    <section class="position-relative img-featured overlay overlay-5 h-100 py-5">
        <img src="<?php echo get_template_directory_uri() ?>/theme/img/fundo-space.webp" alt="" class="img-fluid img-fundo">

        <div class="container my-5">
            <div class="row">
                <div class="col-12 position-relative">
                    <h1 class="display-4 text-secondary">Servicio de acompañamiento de cultivo.</h1>

                    <span class="text-white fw-bold lead">Adquiriendo nuestros productos, contás con el <i class="bi bi-whatsapp"></i> de <a href="https://www.instagram.com/weedworld.oficial/" target="_blank" class="fw-bold text-secondary text-uppercase border-bottom border-secondary">@weedworld.oficial</a> para que te acompañe en todo tu proceso de cultivo.</span>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-dark">
        <div class="container-fluid">
            <div class="row position-relative h-100">

                <div class="col-12 col-md-5 offset-md-1 py-5 pe-md-4">
                    <h1 class="display-2 text-white lh-sm">Sé parte de nuestra comunidad</h1>
                    <span class="text-white lead d-flex gap-2 align-items-center mb-3">
                        <span>
                            <img src="<?php echo get_template_directory_uri(); ?>/theme/img/VIUDA-FIESTA_sm.webp" class="img-fluid img-floating">
                        </span>
                        <span class="p-3">
                            Comparte tus cultivos con los demas miembros.
                        </span>
                    </span>
                    <span class="text-white lead d-flex gap-2 align-items-center mb-3">
                        <span>
                            Realice un seguimiento su ambiente de cultivo.
                        </span>
                        <span class="p-3">
                            <img src="<?php echo get_template_directory_uri(); ?>/theme/img/VIUDA-REGANDO_sm.webp" class="img-fluid img-floating">
                        </span>
                    </span>
                    <span class="text-white lead d-flex gap-2 align-items-center mb-3">
                        <span>
                            <img src="<?php echo get_template_directory_uri(); ?>/theme/img/VIUDA_CON_CHALITA_sm.webp" class="img-fluid img-floating">
                        </span>
                        <span class="p-3">
                            Registre información sobre cómo crecen sus plantas.
                        </span>
                    </span>
                    <span class="text-white lead d-flex gap-2 align-items-center mb-3">
                        <span>
                            Tome fotos y mediciones para compartir.
                        </span>
                        <span class="p-3">
                            <img src="<?php echo get_template_directory_uri(); ?>/theme/img/VIUDA_ESPACIAL_sm.webp" class="img-fluid img-floating">
                        </span>
                    </span>

                    <div class="border border-secondary p-4">
                        <span class="h2 text-secondary d-block">Comenzá ahora</span>
                        <span class="fs-4 text-white d-block mb-3">Sé parte de nuestra comunidad de La Viuda Seed y recibirás descuentos, promociones e información exclusiva.</span>
                        <a href="/registrarse" class="btn btn-outline-secondary btn-lg">Registrate ahora</a>

                    </div>
                </div>

                <div class="col-12 col-md-6 px-0">
                    <img src="<?php echo get_template_directory_uri(); ?>/theme/img/VIUDA_SILLON_MESITA_700.webp" class="img-fluid w-100 img-cover">

                </div>

            </div>
        </div>
    </section>

</main>

<?php 
  strapword_mainbody_after();
  get_footer(); 
?>