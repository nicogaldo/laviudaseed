<?php
  get_header();
  strapword_mainbody_before();
?>

<main id="site-main">
  <?php strapword_mainbody_start(); ?>

  <?php get_template_part('loops/single-post', get_post_format()); ?>

  <?php strapword_mainbody_end(); ?>
</main>

<?php
    strapword_mainbody_after();
    get_footer();
?>
