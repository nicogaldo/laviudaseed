<?php
  // Template Name: Page pOST
  get_header(); 
  strapword_mainbody_before();

?>

<main id="site-main">
    

    <section class="container">
        <div class="row position-relative h-100 py-5">

            <?php echo do_shortcode('[pva]'); ?>

        </div>
    </section>

    <section class="container-fluid">
        <div class="row position-relative h-100 py-5">

            <img src="<?php echo get_template_directory_uri(); ?>/theme/img/asesor_cannabico.webp" class="img-fluid">

        </div>
    </section>

</main>

<?php 
  strapword_mainbody_after();
  get_footer(); 
?>