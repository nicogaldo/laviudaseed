<?php
/**
 * Single Post template page used if the post is shown on profile
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

$post_type = bblpro_get_current_post_type();
$post_id = bblpro_get_queried_post_id();

if ( bp_is_my_profile() || is_super_admin() ) {
	$status = 'any';
} else {
	$status = 'publish';
}

$query_args = array(
	'author'      => bp_displayed_user_id(),
	'post_type'   => $post_type,
	'post_status' => $status,
	'p'           => bblpro_get_queried_post_id(),
);


query_posts( $query_args );
global $post;
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		// Important: Do not remove it. It is used to unhook BuddyPress Theme compatibility comment closing function.
		do_action( 'bblpro_before_blog_post' );
		?>

<article id="post-<?php the_ID(); ?>" <?php post_class('pt-4'); ?>>

    <figure class="post-thumbnail">
        <?php if ( has_post_thumbnail( get_the_ID() ) ) : ?>
        <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>" class="img-fluid w-100" style="height: 300px; object-fit: cover;" />
        <?php else : ?>
        <img src="<?php echo get_template_directory_uri(); ?>/theme/img/<?php echo $post_type; ?>-default.webp" class="img-fluid w-100" style="height: 300px; object-fit: cover;" />
        <?php endif; ?>
    </figure>

    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title m-0">', '</h1>' ); ?>
    </header><!-- .entry-header -->

    <div class="entry-content my-3">

        <?php if ( $post_type == 'log' ) {
            $logUrl = get_the_permalink();
            if (get_field( 'log_type' ) == 'Planta') {
                $logUrl = bp_core_get_user_domain(get_the_author_meta('ID')) .'plantas/view/'. get_field('log_planta') .'#log-'. get_the_ID();
                
            } elseif (get_field( 'log_type' ) == 'Ambiente') {
                $logUrl = bp_core_get_user_domain(get_the_author_meta('ID')) .'ambientes-de-cultivo/view/'. get_field('log_ambiente') .'#log-'. get_the_ID();
            }
            wp_redirect( $logUrl );
        }; //end if is log ?>

        <?php if ( $post_type == 'ambiente' ) { ?>

        <div class="mb-4">
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

            <?php if ( have_rows( 'Dimensiones' ) ) : ?>
            <?php while ( have_rows( 'Dimensiones' ) ) : the_row(); ?>
            <span class="d-inline-block me-2" title="Ancho x Largo x Alto"><i class="bi bi-rulers"></i> <?php the_sub_field( 'ancho' ); ?>cm
                x <?php the_sub_field( 'largo' ); ?>cm
                x <?php the_sub_field( 'altura' ); ?>cm
            </span>
            <?php endwhile; ?>
            <?php endif; ?>

            <?php if ( have_rows( 'luces' ) ) : ?>
            <?php while ( have_rows( 'luces' ) ) : the_row(); ?>
            <?php if ( have_rows( 'tipo_de_luz' ) ) : ?>
            <?php while ( have_rows( 'tipo_de_luz' ) ) : the_row(); ?>
            <span class="d-inline-block me-2"><i class="bi bi-lightbulb"></i> <?php the_sub_field( 'led_sodio_lec_full_spectrum' ); ?></span>
            <span class="d-inline-block me-2"><i class="bi bi-lightning"></i> <?php the_sub_field( 'watts' ); ?>W</span>
            <?php endwhile; ?>
            <?php endif; ?>
            <?php endwhile; ?>
            <?php else : ?>
            <?php // No rows found ?>
            <?php endif; ?>

            <span class="d-inline-block me-2"><i class="bi bi-watch"></i> <?php the_field( 'tiempo_de_exposicion' ); ?>hs de exposición</span>
        </div>

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
        $plantas = new WP_Query( $args ); ?>

        <div class="row">

            <div class="col-12 col-md-4 small">
                <span class="fs-3 d-block w-100 mt-3"><?php echo $plantas->post_count; ?> Cultivos</span>

                <div class="d-flex align-items-center mb-3">
                    <?php if ( $plantas->have_posts() ) : ?>
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
            </div>

            <div class="col-12 col-md-8">

                <?php 
                $args = array(
                    'posts_per_page'    => -1, 
                    'post_type'         => 'log',
                    'meta_query' => array(
                        //'relation' => 'OR',
                        /* array(
                            'key' => 'log_planta',
                            //'value' => '"' . get_the_ID() . '"',
                            'value' => $elegir_ambiente[0],
                            //'value' => "486",
                            'compare' => 'LIKE'
                        ), */
                        array(
                            'key' => 'log_ambiente',
                            //'value' => '"' . get_the_ID() . '"',
                            'value' => $post_id,
                            'compare' => 'LIKE'
                        )
                    )
                );
                $logs = new WP_Query( $args ); ?>

                <?php if ( $logs->have_posts() ) : ?>
                <div class="container">

                    <ul class="timeline">

                        <?php if ( bblpro_user_can_edit_post( get_current_user_id(), $post_id ) ) { ?>
                        <li class="timeline-item mb-5">
                            <p class="fs-6 text-white-50 lh-1 mb-2"> <a href="<?= bp_loggedin_user_domain(); ?>logs/nuevo-log/" class="btn btn-primary mt-n2"><i class="bi bi-plus-circle"></i> Nuevo Log</a></p>
                        </li>
                        <?php } ?>

                        <?php while ( $logs->have_posts() ) : $logs->the_post();
                    
                            $log_type = get_field( 'log_type' );
    
                            $log_ambiente = get_field( 'log_ambiente' );
    
                            $altura = get_field( 'altura' );
                            $ppm = get_field( 'ppm' );
                            $ph = get_field( 'ph' );
                            $ec = get_field( 'ec' );
                            $temperatura_del_agua = get_field( 'temperatura_del_agua' );
                            $humedad = get_field( 'humedad' );
                            $temperatura_del_ambiente = get_field( 'temperatura_del_ambiente' );
                            $temperatura_exterior = get_field( 'temperatura_exterior' );
                            $co2 = get_field( 'co2' );
                            $precipitaciones = get_field( 'precipitaciones' );
    
    
                            $fecha = get_field( 'fecha' );
                            $nota = get_field( 'nota' );
                            
                            ?>

                        <li id="log-<?= get_the_ID(); ?>" class="timeline-item mb-5">
                            <!-- <h5 class="fw-bold">Our company starts its operations</h5> -->
                            <p class="fs-6 text-white-50 lh-1 mb-2"><?php echo $fecha; ?> <i class="text-white-50">- #<?= get_the_ID(); ?></i></p>
                            <div class="card text-bg-dark border-light border-opacity-25 rounded-3">
                                <div class="card-body px-3 py-2">
                                    <?php echo ($nota) ? '<p class="mb-2"><i class="bi bi-pencil-square"></i> Nota: '.$nota.'</p>' : '' ; ?>

                                    <?php echo ($altura) ? '<p class="mb-2"><i class="bi bi-sort-up-alt"></i> Altura: '. $altura .'cm</p>' : '' ; ?>
                                    <?php echo ($ppm) ? '<p class="mb-2"><i class="bi bi-droplet-half"></i> '. $ppm .' PPM</p>' : '' ; ?>
                                    <?php echo ($ph) ? '<p class="mb-2"><i class="bi bi-moisture"></i> PH: '. $ph .'</p>' : '' ; ?>
                                    <?php echo ($ec) ? '<p class="mb-2"><i class="bi bi-broadcast"></i> EC: '. $ec .'</p>' : '' ; ?>
                                    <?php echo ($temperatura_del_agua) ? '<p class="mb-2"><i class="bi bi-thermometer-half"></i> Temp. agua: '. $temperatura_del_agua . '°C</p>' : '' ; ?>
                                    <?php echo ($humedad) ? '<p class="mb-2"><i class="bi bi-clouds"></i> Humedad: '. $humedad .' %</p>' : '' ; ?>
                                    <?php echo ($temperatura_del_ambiente) ? '<p class="mb-2"><i class="bi bi-thermometer-half"></i> Temp. ambiente: '. $temperatura_del_ambiente .'°C</p>' : '' ; ?>
                                    <?php echo ($temperatura_exterior) ? '<p class="mb-2"><i class="bi bi-cloud-sun"></i> Temp. exterior: '. $temperatura_exterior .'°C</p>' : '' ; ?>
                                    <?php echo ($co2) ? '<p class="mb-2"><i class="bi bi-circle"></i> CO2: '. $co2 .' %</p>' : '' ; ?>
                                    <?php echo ($precipitaciones) ? '<p class="mb-2"><i class="bi bi-cloud-drizzle"></i> Precipitaciones: '. $precipitaciones .'cm</p>' : '' ; ?>

                                </div>
                            </div>

                            <?php $fotos_images = get_field( 'fotos' ); ?>
                            <?php if ( $fotos_images ) :  ?>
                            <div class="card text-bg-dark border-light border-opacity-25 rounded-3 mt-2">
                                <div class="card-body px-3 py-2">
                                    <div id="thumb-log-<?= get_the_ID(); ?>" data-id="thumb-log-<?= get_the_ID(); ?>" thumbsSlider="" class="swiper swiper-thumb px-0 position-relative">

                                        <!-- TODO: Hacer swipers dinamicos -->
                                        <div class="swiper-wrapper justify-content-md-center">
                                            <?php foreach ( $fotos_images as $fotos_image ): 
                                            //print_r($fotos_image['sizes']);
                                            ?>

                                            <div class="swiper-slide text-center animate" data-animate="zoomIn" data-duration=".8s" data-delay="<?php //echo $delay;?>s">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal-log-<?= get_the_ID(); ?>">
                                                    <img src="<?php echo esc_url( $fotos_image['sizes']['woocommerce_gallery_thumbnail'] ); ?>" alt="<?php echo esc_attr( $fotos_image['alt'] ); ?>" class="img-slider-thumb" />
                                                    <?php //echo '<img src="'.wp_get_attachment_url( $gallery_item_id ).'" class="img-slider-staff swiper-lazy rounded-10">'; ?>
                                                </a>
                                            </div>

                                            <!-- <p><?php echo esc_html( $fotos_image['caption'] ); ?></p> -->
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <!-- Inicio Modal - Slider Footer -->
                                    <div class="modal fade" id="modal-log-<?= get_the_ID(); ?>" tabindex="-1" aria-labelledby="modalLabel-log-<?= get_the_ID(); ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content bg-transparent border-0">
                                                <div class="modal-header border-0">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body ">
                                                    <div id="swipe-log-<?= get_the_ID(); ?>" data-id="swipe-log-<?= get_the_ID(); ?>" class="swiper swiper-modal position-relative">
                                                        <div class="swiper-wrapper">

                                                            <?php foreach ( $fotos_images as $fotos_image ): 
                                                            //print_r($fotos_image['sizes']);
                                                            ?>
                                                            <div class="swiper-slide text-center my-auto animate" data-animate="zoomIn" data-duration=".8s" data-delay="<?php //echo $delay; ?>s">
                                                                <img src="<?php echo esc_url( $fotos_image['sizes']['large'] ); ?>" alt="<?php echo esc_attr( $fotos_image['alt'] ); ?>" class="img-fluid" />
                                                                <?php //echo '<img src="'.wp_get_attachment_url( $gallery_item_id ).'" class="img-slider-staff swiper-lazy rounded-10">'; ?>
                                                            </div>
                                                            <?php endforeach; ?>

                                                        </div>
                                                        <div class="swiper-button-next"></div>
                                                        <div class="swiper-button-prev"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fin Modal - Slider Footer -->

                                </div>
                            </div>
                            <?php endif; ?>

                            
                            <?php if ( comments_open() || bblpro_user_can_edit_post( get_current_user_id(), $post_id )) : ?>
                            <div class="card text-bg-dark border-light border-opacity-25 rounded-3 mt-2 post-actions">
                                <div class="card-body d-flex">

                                    <?php if ( comments_open()) : ?>
                                    <a class="btn btn-sm btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#comments-log-<?= get_the_ID(); ?>" aria-controls="comments-log-<?= get_the_ID(); ?>">
                                        <i class="bi bi-chat-text"></i>
                                        <?php
                                        $comment_count = get_comments_number();
                                        printf(
                                        /* translators: 1: comment count number. */
                                        esc_html( _nx( '%1$s comentario', '%1$s comentarios', $comment_count, 'strapword' ) ),
                                        number_format_i18n( $comment_count )
                                        );
                                    ?>
                                    </a>
                                    <div class="offcanvas offcanvas-end offcanvas-comments text-bg-dark" tabindex="-1" id="comments-log-<?= get_the_ID(); ?>" aria-labelledby="comments-log-<?= get_the_ID(); ?>Label">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title my-0" id="comments-log-<?= get_the_ID(); ?>Label">Comentarios log #<?= get_the_ID(); ?></h5>
                                            <a type="button" class="btn-close btn-close-light text-bg-light" data-bs-dismiss="offcanvas" aria-label="Close"></a>
                                        </div>

                                        <div class="offcanvas-body pt-0">
                                            <div>
                                                <?php
                                                    // This continues in the single post loop
                                                    if ( comments_open() || get_comments_number() ) :
                                                    //comments_template();
                                                    comments_template('/loops/single-post-comments.php');
                                                    endif;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if ( bblpro_user_can_edit_post( get_current_user_id(), $post_id ) ) { ?>
                                    <div class="d-inline-block ms-auto">
                                        <?php echo bblpro_get_post_edit_link( get_the_ID(), array('label' => 'Editar', 'class' => 'btn btn btn-sm btn-outline-secondary') ); ?>
                                        <?php echo bblpro_get_post_delete_link( get_the_ID(), array('label' => 'Borrar', 'class' => 'btn btn-sm btn-outline-danger ms-auto') ); ?>
                                    </div>
                                    <?php }; //end if is bblpro_user_can_edit_post ?>

                                </div>
                            </div>
                            <?php endif; ?>

                        </li>

                        <?php endwhile; ?>
                    </ul>
                </div>
                <?php wp_reset_postdata(); ?>
                <?php endif; ?>

            </div>
        </div>
        <?php }; //end if is ambiente ?>


        <?php if ( $post_type == 'planta' ) { ?>

        <div class="row">

            <div class="col-12 col-md-4 small">

                <span class="fs-4 text-white d-block">Genetíca</span>
                <span class="text-white-50"><?php the_field( 'genetica' ); ?></span>

                <div class="d-block w-100 my-4"></div>

                <span class="fs-4 text-white d-block">Etapa</span>
                <?php if (get_field( 'germinacion' )) { ?>
                <span class="text-white-50 d-flex align-items-center gap-2">
                    <i class="bi bi-1-circle fs-2"></i>
                    <span class="d-flex flex-column">
                        <span>Germinacion</span>
                        <?php the_field( 'germinacion' ); ?>
                    </span>
                </span>
                <?php } ?>
                <?php if (get_field( 'plantula' )) { ?>
                <span class="text-white-50 d-flex align-items-center gap-2">
                    <i class="bi bi-2-circle fs-2"></i>
                    <span class="d-flex flex-column">
                        <span>Plantula</span>
                        <?php the_field( 'plantula' ); ?>
                    </span>
                </span>
                <?php } ?>
                <?php if (get_field( 'enraizamiento' )) { ?>
                <span class="text-white-50 d-flex align-items-center gap-2">
                    <i class="bi bi-1-circle fs-2"></i>
                    <span class="d-flex flex-column">
                        <span>Enraizamiento</span>
                        <?php the_field( 'enraizamiento' ); ?>
                    </span>
                </span>
                <?php } ?>
                <?php if (get_field( 'vegetativo' )) { ?>
                <span class="text-white-50 d-flex align-items-center gap-2">
                    <i class="bi bi-3-circle fs-2"></i>
                    <span class="d-flex flex-column">
                        <span>Vegetativo</span>
                        <?php the_field( 'vegetativo' ); ?>
                    </span>
                </span>
                <?php } ?>
                <?php if (get_field( 'floracion' )) { ?>
                <span class="text-white-50 d-flex align-items-center gap-2">
                    <i class="bi bi-4-circle fs-2"></i>
                    <span class="d-flex flex-column">
                        <span>Floracion</span>
                        <?php the_field( 'floracion' ); ?>
                    </span>
                </span>
                <?php } ?>
                <?php if (get_field( 'secado' )) { ?>
                <span class="text-white-50 d-flex align-items-center gap-2">
                    <i class="bi bi-5-circle fs-2"></i>
                    <span class="d-flex flex-column">
                        <span>Secado</span>
                        <?php the_field( 'secado' ); ?>
                    </span>
                </span>
                <?php } ?>
                <?php if (get_field( 'curado' )) { ?>
                <span class="text-white-50 d-flex align-items-center gap-2">
                    <i class="bi bi-6-circle fs-2"></i>
                    <span class="d-flex flex-column">
                        <span>Curado</span>
                        <?php the_field( 'curado' ); ?>
                    </span>
                </span>
                <?php } ?>


                <div class="d-block w-100 my-4"></div>

                <?php $elegir_ambiente = get_field( 'elegir_ambiente' ); ?>
                <?php //print_r( $elegir_ambiente ); ?>
                <?php if ( $elegir_ambiente ) : ?>
                <?php foreach ( $elegir_ambiente as $ambiente_id ) : ?>

                <?php
                $ambiente = get_field( 'tipo_de_ambiente', $ambiente_id );
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
                <span class="text-white-50"><?php echo $ambiente; ?></span>
                <span class="fs-4 text-white d-block"><?php echo get_the_title( $ambiente_id ); ?></span>

                <?php if ( have_rows( 'Dimensiones', $ambiente_id ) ) : ?>
                <?php while ( have_rows( 'Dimensiones', $ambiente_id ) ) : the_row(); ?>
                <span class="text-white-50 d-block me-2" title="Ancho x Largo x Alto"><i class="bi bi-rulers"></i> <?php the_sub_field( 'ancho' ); ?>cm
                    x <?php the_sub_field( 'largo' ); ?>cm
                    x <?php the_sub_field( 'altura' ); ?>cm
                </span>
                <?php endwhile; ?>
                <?php endif; ?>

                <?php if ( have_rows( 'luces', $ambiente_id ) ) : ?>
                <?php while ( have_rows( 'luces', $ambiente_id ) ) : the_row(); ?>
                <?php if ( have_rows( 'tipo_de_luz', $ambiente_id ) ) : ?>
                <?php while ( have_rows( 'tipo_de_luz', $ambiente_id ) ) : the_row(); ?>
                <span class="text-white-50 d-block me-2"><i class="bi bi-lightbulb"></i> <?php the_sub_field( 'led_sodio_lec_full_spectrum' ); ?></span>
                <span class="text-white-50 d-block me-2"><i class="bi bi-lightning"></i> <?php the_sub_field( 'watts' ); ?> W</span>
                <?php endwhile; ?>
                <?php endif; ?>
                <?php endwhile; ?>
                <?php else : ?>
                <?php // No rows found ?>
                <?php endif; ?>

                <span class="text-white-50 d-block me-2"><i class="bi bi-watch"></i> <?php the_field( 'tiempo_de_exposicion', $ambiente_id ); ?>hs de exposición</span>


                <?php endforeach; ?>
                <?php endif; ?>

            </div>

            <div class="col-12 col-md-8">

                <?php 

                $args = array(
                    'posts_per_page'    => -1, 
                    'post_type'         => 'log',
                );
                
                if ($elegir_ambiente) {
                    $args['meta_query'] = array(
                        'relation' => 'OR',
                        array(
                            'key' => 'log_planta',
                            'value' => $post_id,
                            'compare' => 'LIKE'
                        ),
                        array(
                            'key' => 'log_ambiente',
                            'value' => $elegir_ambiente[0],
                            'compare' => 'LIKE'
                        )
                    ); // ends meta_query
                } else {
                    $args['meta_query'] = array(
                        'relation' => 'OR',
                        array(
                            'key' => 'log_planta',
                            'value' => $post_id,
                            'compare' => 'LIKE'
                        )
                    ); // ends meta_query

                }
                $logs = new WP_Query( $args ); ?>

                <?php if ( $logs->have_posts() ) : ?>
                <div class="container">

                    <ul class="timeline">

                        <?php if ( bblpro_user_can_edit_post( get_current_user_id(), $post_id ) ) { ?>
                        <li class="timeline-item mb-5">
                            <p class="fs-6 text-white-50 lh-1 mb-2"> <a href="<?= bp_loggedin_user_domain(); ?>logs/nuevo-log/" class="btn btn-primary mt-n2"><i class="bi bi-plus-circle"></i> Nuevo Log</a></p>
                        </li>
                        <?php } ?>

                        <?php while ( $logs->have_posts() ) : $logs->the_post();
            
                        $log_type = get_field( 'log_type' );

                        $log_ambiente = get_field( 'log_ambiente' );

                        $altura = get_field( 'altura' );
                        $ppm = get_field( 'ppm' );
                        $ph = get_field( 'ph' );
                        $ec = get_field( 'ec' );
                        $temperatura_del_agua = get_field( 'temperatura_del_agua' );
                        $humedad = get_field( 'humedad' );
                        $temperatura_del_ambiente = get_field( 'temperatura_del_ambiente' );
                        $temperatura_exterior = get_field( 'temperatura_exterior' );
                        $co2 = get_field( 'co2' );
                        $precipitaciones = get_field( 'precipitaciones' );


                        $fecha = get_field( 'fecha' );
                        $nota = get_field( 'nota' );
                        
                        ?>

                        <li id="log-<?= get_the_ID(); ?>" class="timeline-item mb-5">
                            <!-- <h5 class="fw-bold">Our company starts its operations</h5> -->
                            <p class="fs-6 text-white-50 lh-1 mb-2"><?php echo $fecha; ?> <i class="text-white-50">- #<?= get_the_ID(); ?></i></p>
                            <div class="card text-bg-dark border-light border-opacity-25 rounded-3">
                                <div class="card-body px-3 py-2">
                                    <?php echo ($nota) ? '<p class="mb-2"><i class="bi bi-pencil-square"></i> Nota: '.$nota.'</p>' : '' ; ?>

                                    <?php echo ($altura) ? '<p class="mb-2"><i class="bi bi-sort-up-alt"></i> Altura: '. $altura .'cm</p>' : '' ; ?>
                                    <?php echo ($ppm) ? '<p class="mb-2"><i class="bi bi-droplet-half"></i> '. $ppm .' PPM</p>' : '' ; ?>
                                    <?php echo ($ph) ? '<p class="mb-2"><i class="bi bi-moisture"></i> PH: '. $ph .'</p>' : '' ; ?>
                                    <?php echo ($ec) ? '<p class="mb-2"><i class="bi bi-broadcast"></i> EC: '. $ec .'</p>' : '' ; ?>
                                    <?php echo ($temperatura_del_agua) ? '<p class="mb-2"><i class="bi bi-thermometer-half"></i> Temp. agua: '. $temperatura_del_agua . '°C</p>' : '' ; ?>
                                    <?php echo ($humedad) ? '<p class="mb-2"><i class="bi bi-clouds"></i> Humedad: '. $humedad .' %</p>' : '' ; ?>
                                    <?php echo ($temperatura_del_ambiente) ? '<p class="mb-2"><i class="bi bi-thermometer-half"></i> Temp. ambiente: '. $temperatura_del_ambiente .'°C</p>' : '' ; ?>
                                    <?php echo ($temperatura_exterior) ? '<p class="mb-2"><i class="bi bi-cloud-sun"></i> Temp. exterior: '. $temperatura_exterior .'°C</p>' : '' ; ?>
                                    <?php echo ($co2) ? '<p class="mb-2"><i class="bi bi-circle"></i> CO2: '. $co2 .' %</p>' : '' ; ?>
                                    <?php echo ($precipitaciones) ? '<p class="mb-2"><i class="bi bi-cloud-drizzle"></i> Precipitaciones: '. $precipitaciones .'cm</p>' : '' ; ?>

                                </div>
                            </div>

                            <?php $fotos_images = get_field( 'fotos' ); ?>
                            <?php if ( $fotos_images ) :  ?>
                            <div class="card text-bg-dark border-light border-opacity-25 rounded-3 mt-2">
                                <div class="card-body px-3 py-2">
                                    <div id="thumb-log-<?= get_the_ID(); ?>" data-id="thumb-log-<?= get_the_ID(); ?>" thumbsSlider="" class="swiper swiper-thumb px-0 position-relative">

                                        <!-- TODO: Hacer swipers dinamicos -->
                                        <div class="swiper-wrapper justify-content-md-center">
                                            <?php foreach ( $fotos_images as $fotos_image ): 
                                            //print_r($fotos_image['sizes']);
                                            ?>

                                            <div class="swiper-slide text-center animate" data-animate="zoomIn" data-duration=".8s" data-delay="<?php //echo $delay;?>s">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal-log-<?= get_the_ID(); ?>">
                                                    <img src="<?php echo esc_url( $fotos_image['sizes']['woocommerce_gallery_thumbnail'] ); ?>" alt="<?php echo esc_attr( $fotos_image['alt'] ); ?>" class="img-slider-thumb" />
                                                    <?php //echo '<img src="'.wp_get_attachment_url( $gallery_item_id ).'" class="img-slider-staff swiper-lazy rounded-10">'; ?>
                                                </a>
                                            </div>

                                            <!-- <p><?php echo esc_html( $fotos_image['caption'] ); ?></p> -->
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <!-- Inicio Modal - Slider Footer -->
                                    <div class="modal fade" id="modal-log-<?= get_the_ID(); ?>" tabindex="-1" aria-labelledby="modalLabel-log-<?= get_the_ID(); ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content bg-transparent border-0">
                                                <div class="modal-header border-0">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body ">
                                                    <div id="swipe-log-<?= get_the_ID(); ?>" data-id="swipe-log-<?= get_the_ID(); ?>" class="swiper swiper-modal position-relative">
                                                        <div class="swiper-wrapper">

                                                            <?php foreach ( $fotos_images as $fotos_image ): 
                                                            //print_r($fotos_image['sizes']);
                                                            ?>
                                                            <div class="swiper-slide text-center my-auto animate" data-animate="zoomIn" data-duration=".8s" data-delay="<?php //echo $delay; ?>s">
                                                                <img src="<?php echo esc_url( $fotos_image['sizes']['large'] ); ?>" alt="<?php echo esc_attr( $fotos_image['alt'] ); ?>" class="img-fluid" />
                                                                <?php //echo '<img src="'.wp_get_attachment_url( $gallery_item_id ).'" class="img-slider-staff swiper-lazy rounded-10">'; ?>
                                                            </div>
                                                            <?php endforeach; ?>


                                                        </div>
                                                        <div class="swiper-button-next"></div>
                                                        <div class="swiper-button-prev"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fin Modal - Slider Footer -->

                                </div>
                            </div>
                            <?php endif; ?>


                            <?php if ( comments_open() || bblpro_user_can_edit_post( get_current_user_id(), $post_id )) : ?>
                            <div class="card text-bg-dark border-light border-opacity-25 rounded-3 mt-2 post-actions">
                                <div class="card-body d-flex">

                                    <?php if ( comments_open()) : ?>
                                    <a class="btn btn-sm btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#comments-log-<?= get_the_ID(); ?>" aria-controls="comments-log-<?= get_the_ID(); ?>">
                                        <i class="bi bi-chat-text"></i>
                                        <?php
                                        $comment_count = get_comments_number();
                                        printf(
                                        /* translators: 1: comment count number. */
                                        esc_html( _nx( '%1$s comentario', '%1$s comentarios', $comment_count, 'strapword' ) ),
                                        number_format_i18n( $comment_count )
                                        );
                                    ?>
                                    </a>
                                    <div class="offcanvas offcanvas-end offcanvas-comments text-bg-dark" tabindex="-1" id="comments-log-<?= get_the_ID(); ?>" aria-labelledby="comments-log-<?= get_the_ID(); ?>Label">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title my-0" id="comments-log-<?= get_the_ID(); ?>Label">Comentarios log #<?= get_the_ID(); ?></h5>
                                            <a type="button" class="btn-close btn-close-light text-bg-light" data-bs-dismiss="offcanvas" aria-label="Close"></a>
                                        </div>

                                        <div class="offcanvas-body pt-0">
                                            <div>
                                                <?php
                                                    // This continues in the single post loop
                                                    if ( comments_open() || get_comments_number() ) :
                                                    //comments_template();
                                                    comments_template('/loops/single-post-comments.php');
                                                    endif;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if ( bblpro_user_can_edit_post( get_current_user_id(), $post_id ) ) { ?>
                                    <div class="d-inline-block ms-auto">
                                        <?php echo bblpro_get_post_edit_link( get_the_ID(), array('label' => 'Editar', 'class' => 'btn btn btn-sm btn-outline-secondary') ); ?>
                                        <?php echo bblpro_get_post_delete_link( get_the_ID(), array('label' => 'Borrar', 'class' => 'btn btn-sm btn-outline-danger ms-auto') ); ?>
                                    </div>
                                    <?php }; //end if is bblpro_user_can_edit_post ?>

                                </div>
                            </div>
                            <?php endif; ?>
                        </li>

                        <?php endwhile; ?>
                    </ul>
                </div>
                <?php wp_reset_postdata(); ?>
                <?php endif; ?>

            </div>
        </div>

        <?php }; //end if is planta ?>


        <footer class="entry-footer mt-5">

            <?php if ( bblpro_user_can_edit_post( get_current_user_id(), $post_id ) ) { ?>
            <div class="post-actions mb-2">

                <?php echo bblpro_get_post_edit_link( get_the_ID(), array('label' => 'Editar', 'class' => 'btn btn btn-sm btn-outline-secondary') ); ?>
                <?php echo bblpro_get_post_delete_link( get_the_ID(), array('label' => 'Borrar', 'class' => 'btn btn-sm btn-outline-danger ms-auto') ); ?>

            </div>
            <?php } ?>

            <div class="entry-meta-box small text-white-50">
                <!-- <span><?php //printf( _x( 'by %s', 'Post written by...', 'buddyblog-pro' ), bp_core_get_userlink( $post->post_author ) ); ?></span> -->
                <span class="date"><?php echo get_the_date(); ?></span>
                <?php the_tags( '<span class="tags">' . __( 'Tags: ', 'buddyblog-pro' ), ', ', '</span>' ); ?> |
                <span class="comments"><?php comments_popup_link( __( 'No Comments &#187;', 'buddyblog-pro' ), __( '1 Comment &#187;', 'buddyblog-pro' ), __( '% Comments &#187;', 'buddyblog-pro' ) ); ?></span>
            </div>

        </footer><!-- .entry-footer -->

    </div>

</article>

<?php //comments_template( '/comments.php' ); ?>

<?php
// used to hook back BuddyPress Theme compatibility comment closing function.
do_action( 'bblpro_after_blog_post' );
?>

<?php endwhile; ?>
<?php
	wp_reset_postdata();
	wp_reset_query();
	?>
<?php else : ?>
<p> <?php _e( 'No Posts found!', 'buddyblog-pro' ); ?></p>
<?php endif; ?>