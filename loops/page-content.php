<?php
/*
 * The Page Content Loop
 */
?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>
<article role="article" id="post_<?php the_ID()?>" <?php post_class("mb-5")?>>
    <section class="bg-primary">

        <div class="container">
            <div class="row pb-3">
                <div class="col-12">
                    <nav class="woocommerce-breadcrumb py-2 mb-0">
                        <?php if ( function_exists('yoast_breadcrumb') ) {
                            yoast_breadcrumb( '<p class="mb-0">','</p>' );
                        } ?>
                    </nav>
                    <h1 class="lh-1 text-light mb-0"><?php echo the_title(); ?></h1>
                </div>
            </div>
        </div> <!-- end .container -->

    </section>

    <section>
        <div class="container">
            <div class="row py-4">
                <div class="col-12">

                    <?php the_content(); ?>
                </div>
            </div>

        </div>
    </section>
</article>
<?php
  endwhile;
  else :
    get_template_part('loops/404');
  endif;
?>