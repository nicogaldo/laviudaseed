<?php
    // Template Name: Page Login
    get_header(); 
    strapword_mainbody_before();

    $url = "";

    if (isset($_GET['rtn'])) {
        $url = urldecode($_GET['rtn']);
        $url = explode('=', $url);
        
    } else {
        
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();            
            $url = "".get_home_url()."/usuarios/$current_user->user_nicename/profile/";
            wp_redirect($url);
            exit();
        }
    }
?>

<main id="site-main">

    <?php if (is_page('iniciar-sesion')) { ?>
    <section class="container">
        <div class="row flex-column align-items-center position-relative py-3 py-md-4 my-3 my-md-4 ">

            <div class="col-12 col-md-6 text-center mb-4">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/theme/img/VIUDA-COHETE-CHURRO_sm.webp" alt="cogo logeandose" width="200" class="img-fluid img-floating">
                    <h1 class="text-uppercase text-secondary">Ingresá ahora jujuuuuu</h1>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <?php 
                if ($url) {
                    echo do_shortcode('[wppb-login register_url="/registrarse" lostpassword_url="/recuperar-cuenta" redirect_url="'.$url[1].'"]');
                } else {
                    echo do_shortcode('[wppb-login register_url="/registrarse" lostpassword_url="/recuperar-cuenta" redirect_url="'.get_bloginfo( 'url' ).'"]');
                }
                ?>
                
            </div>

        </div>
    </section>
    <?php } ?>

    <?php if (is_page('recuperar-cuenta')) { ?>
    <section class="container">
        <div class="row flex-column align-items-center position-relative py-3 py-md-4 my-3 my-md-4 ">

            <div class="col-12 col-md-6 text-center mb-4">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/theme/img/VIUDA-ESTRESADA_sm.webp" alt="cogo logeandose" width="200" class="img-fluid img-floating">
                    <h1 class="text-uppercase text-secondary">Recuperar contraseña</h1>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <?php echo do_shortcode('[wppb-recover-password] '); ?>
            </div>

        </div>
    </section>
    <?php } ?>

</main>

<?php 
  strapword_mainbody_after();
  get_footer(); 
?>