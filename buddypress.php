<?php
  
  acf_form_head();
  
  get_header(); 
  strapword_mainbody_before();
?>

<main id="site-main">

    <section id="post_<?php the_ID()?>" <?php post_class("container")?>>

        <div class="row position-relative h-100 py-5">

            <?php if(have_posts()): while(have_posts()): the_post(); ?>

            <div class="col-12 pb-5 entry-content">

                <?php if (is_page('registrarse')) { ?>

                <div class="d-flex align-items-end justify-content-center">
                    <h1 class="d-inline-block">¡Unite a la comuinidad!</h1>
                    <img src="<?php echo get_template_directory_uri(); ?>/theme/img/COGO-FUMANDO_sm.webp" alt="cogo fumando" width="100" class="img-fluid img-floating d-inline-block"> 
                </div>

                <?php } ?>

                <?php the_content()?>
            </div>

            <?php
            endwhile;
            else :
                get_template_part('loops/404');
            endif;
            ?>

        </div>
    </section>
</main>

<?php 
  get_footer();
?>