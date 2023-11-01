<?php
  get_header(); 
  strapword_mainbody_before();
?>

<main id="site-main">

  <?php
    strapword_mainbody_start();
    //echo '<div class="row">';
    get_template_part('loops/index-loop');
    //echo '</div>';
    strapword_mainbody_end();
  ?>

</main>

<?php 
  strapword_mainbody_after();
  get_footer(); 
?>
