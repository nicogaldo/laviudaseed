<?php
/**
 * Create Post template page
 *
 * @package    BuddyBlog_Pro
 * @subpackage Templates/default/default
 * @copyright  Copyright (c) 2020, Brajesh Singh
 * @license    https://www.gnu.org/licenses/gpl.html GNU Public License
 * @author     Brajesh Singh
 * @since      1.0.0
 */

// Do not allow direct access over web.
defined( 'ABSPATH' ) || exit;

// yes, we are forcing main query, will reset later.
query_posts(
	bblpro_get_posts_query_args(
		array(
			'post_type' => bblpro_get_current_post_type(),
		)
	)
);
$posted = false;
$post_type = bblpro_get_current_post_type();
$post_id = bblpro_get_current_post_type();
if ( have_posts() ) : ?>

<div class="row row-cols-1 row-cols-md-2 g-4 pt-4">

    <?php while ( have_posts() ) :
		the_post();
		$posted = true;
		?>

    <div class="col">
        <article role="article" id="post_<?php the_ID()?>" <?php post_class("card text-bg-dark novedades shadow mb-4 mb-md-5"); ?>>

            <?php if ( $post_type != 'log' ) { ?>
            <a href="<?php echo the_permalink(); ?>">
                <?php if ( has_post_thumbnail( get_the_ID() ) ) { ?>
                <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>" style="height: 220px; object-fit: cover;" class="card-img-top">
                <?php } else { ?>
                <img src="<?php echo get_template_directory_uri(); ?>/theme/img/<?php echo $post_type; ?>-default.webp" style="height: 220px; object-fit: cover;" class="card-img-top">
                <?php }; ?>
            </a>
            <?php }; //end if ?>

            <div class="card-body px-4 pt-3 pb-0">
                <?php if ( $post_type == 'log' ) {

                $logUrl = get_the_permalink();

                if (get_field( 'log_type' ) == 'Planta') {
                    $logUrl = bp_core_get_user_domain(get_the_author_meta('ID')) . 'plantas/view/'. get_field('log_planta') .'#log-'. get_the_ID();

                } elseif (get_field( 'log_type' ) == 'Ambiente') {
                    $logUrl = bp_core_get_user_domain(get_the_author_meta('ID')) . 'ambientes-de-cultivo/view/'. get_field('log_ambiente') .'#log-'. get_the_ID();
                    
                } ?>

                <h1 class="card-title fs-4 d-block mt-0 mb-2"><a href="<?php echo $logUrl; ?>" class="">Log fecha <?php echo get_the_date( 'd-m-y' ); ?></a></h1>


                <?php } else { ?>

                <h1 class="card-title fs-4 d-block mt-0 mb-2"><a href="<?php echo the_permalink(); ?>" class=""><?php the_title(); ?></a></h1>
                <?php } ?>

                <?php if ( $post_type == 'ambiente' ) { ?>
                <div class="index-post-category">

                    <span class="d-inline-block me-2">
                        <?php
                        $ambiente = get_field( 'tipo_de_ambiente' );
                        switch ($ambiente) {
                            case 'Interior':
                                echo '<i class="bi bi-house-heart"></i>';
                                break;
                            case 'Exterior':
                                echo '<i class="bi bi-image-alt"></i>';
                                break;                            
                            default:
                                echo '';
                                break;
                        }
                        ?>
                        <?php echo $ambiente; ?>
                    </span>

                    <?php if ( have_rows( 'luces' ) ) : ?>
                    <?php while ( have_rows( 'luces' ) ) : the_row(); ?>
                    <?php if ( have_rows( 'tipo_de_luz' ) ) : ?>
                    <?php while ( have_rows( 'tipo_de_luz' ) ) : the_row(); ?>
                    <span class="d-inline-block me-2"><i class="bi bi-lightbulb"></i> <?php the_sub_field( 'led_sodio_lec_full_spectrum' ); ?></span>
                    <span class="d-inline-block me-2"><i class="bi bi-lightning"></i> <?php the_sub_field( 'watts' ); ?> W</span>
                    <?php endwhile; ?>
                    <?php endif; ?>
                    <?php endwhile; ?>
                    <?php else : ?>
                    <?php // No rows found ?>
                    <?php endif; ?>

                    <!-- <span class="d-inline-block me-2"><i class="bi bi-watch"></i> <?php the_field( 'tiempo_de_exposicion' ); ?>hs de exposición</span> -->
                </div>

                <div class="d-flex align-items-center mb-2">
                    <?php 
                        $args = array(
                        'posts_per_page'    => -1, 
                        'post_type'         => 'planta',
                        'meta_query' => array(
                                array(
                                    'key' => 'elegir_ambiente', // name of custom field
                                    'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
                                    'compare' => 'LIKE'
                                )
                            )
                        );
                        $plantas = new WP_Query( $args );
                        
                        if ( $plantas->have_posts() ) : ?>
                    <?php //print_r($plantas); ?>

                    <span class="fs-5 text-white-50 me-3"><?php echo $plantas->post_count; ?> Cultivos </span>

                    <?php while ( $plantas->have_posts() ) : $plantas->the_post(); ?>

                    <?php 
                    $img = get_field( 'foto_portada' );
                    if ( $img ) : ?>
                    <img src="<?php $img['sizes']['thumbnail']; ?>" class="img-fluid rounded-circle inline-block me-2" width="40" height="40" />
                    <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/theme/img/planta-default.webp" class="img-fluid rounded-circle inline-block me-2" width="40" height="40" />
                    <?php endif; ?>
                    <a href="<?php echo the_permalink(); ?>" class="text-white inline-block me-3"><?php echo the_title(); ?></a>

                    <?php endwhile; ?>

                    <?php wp_reset_postdata(); ?>
                    <?php endif; ?>

                </div>
                <?php }; //end if is ambiente ?>
            </div>

            <?php if ( bblpro_user_can_delete_post( get_current_user_id(), get_the_ID() ) ) { ?>
            <footer class="card-footer mt-2">
                <div class="post-actions d-flex">
                    <a href="<?= bp_core_get_user_domain(get_the_author_meta('ID')); ?>logs/nuevo-log/" class="btn btn btn-sm btn-outline-light"><i class="bi bi-plus-circle"></i> Nuevo Log</a>

                    <div class="d-inline-block ms-auto">
                        <?php echo bblpro_get_post_edit_link( get_the_ID(), array('label' => 'Editar', 'class' => 'btn btn btn-sm btn-outline-secondary') ); ?>
                        <?php echo bblpro_get_post_delete_link( get_the_ID(), array('label' => 'Borrar', 'class' => 'btn btn-sm btn-outline-danger ms-auto') ); ?>
                    </div>
                </div>
            </footer><!-- .entry-footer -->
            <?php } ?>

        </article>
    </div>


    <?php endwhile; ?>
</div> <!-- .row -->

<div class="pagination bbl-pagination">
    <?php bblpro_paginate(); ?>
</div>
<?php else : ?>

<section class="">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 pt-4">
                <div id="content" role="main" class="d-flex flex-column align-items-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/theme/img/VIUDA-REGANDO_sm.webp" alt="" class="img-fluid">
                    <p class="fs-6 mt-4">No hay nada cargado aún.</p>

                </div><!-- /#content -->
            </div>
        </div>
    </div>
</section>

<?php endif; ?>

<?php
wp_reset_query();
wp_reset_postdata();
?>

<section class="">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div id="content" role="main" class="d-flex flex-column align-items-center">

                    <?php if ( ! $posted && bp_is_my_profile() && bblpro_user_can_create_post( get_current_user_id(), bblpro_get_current_post_type() ) ) : ?>

                    <p> <a class="btn btn-primary" href="<?php echo bblpro_get_post_type_create_tab_url( get_current_user_id(), bblpro_get_current_post_type() ); ?>"><i class="bi bi-house-heart-fill"></i> Agregar</a>
                    </p>

                    <?php elseif ( ! $posted && bp_is_user() ) : ?>

                    <?php echo sprintf( "<p class='fs-5 mt-4'>%s no ha compartido nada aún.</p>", bp_get_displayed_user_fullname() ); ?>

                    <?php endif; ?>


                </div><!-- /#content -->
            </div>
        </div>
    </div>
</section>