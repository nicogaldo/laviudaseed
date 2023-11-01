<?php
  get_header(); 
  strapword_mainbody_before();
?>

<main id="site-main">
  <?php strapword_mainbody_start(); ?>

  <header class="container py-5 text-center">
    <span class="h3 fw-light"><?php  _e('Archive', 'strapword'); ?></span>
    <h1 class="display-4 mt-3">
      <?php echo the_archive_title(); ?>
    </h1>
  </header>

  <?php get_template_part('loops/index-loop'); ?>

  <?php strapword_mainbody_end(); ?>
</main>

<?php 
  strapword_mainbody_after();
  get_footer(); 
?>