<?php
  get_header(); 
  strapword_mainbody_before();
?>

<main id="site-main">
  <?php
    strapword_mainbody_start();
    get_template_part('loops/page-content');
    //strapword_mainbody_end();
  ?>
</main>

<?php 
  strapword_mainbody_after();
  get_footer(); 
?>