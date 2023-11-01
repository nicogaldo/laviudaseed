<?php
/*
 * The Index Post (or excerpt)
 * ===========================
 * Used by index.php, category.php and author.php
 */
?>


<article role="article" id="post_<?php the_ID()?>" <?php post_class("card card-post novedades shadow mb-4 mb-md-5"); ?> >
  <a href="<?php echo the_permalink(); ?>">
  <?php if ( has_post_thumbnail( get_the_ID() ) ) { ?>
    <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ) ?>" style="height: 220px; object-fit: cover;" class="card-img-top">
  <?php } else { ?>
    <img src="<?php echo get_template_directory_uri(); ?>/theme/img/placeholder.webp" style="height: 220px; object-fit: cover;" class="card-img-top">
  <?php }; ?>
  </a>

  <div class="card-body p-4 text-center">
    <div class="index-post-category mb-2 text-muted">
      <span class="d-inline-block me-2"><i class="bi bi-calendar3 me-0 "></i> <?php strapword_post_date(); ?></span>
      <span class="d-inline-block me-2"><i class="small bi bi-bookmark"></i> <span class="small text-uppercase"><?php the_category(', '); ?></span></span>
    </div>

    <h1 style="font-weight: 400;" class="fs-4 card-title  mb-2"><a href="<?php echo the_permalink(); ?>" class="text-dark"><?php echo the_title(); ?></a></h1>        

    <section class="mt-3">
      <?php the_excerpt(); ?>
      <?php /*if ( has_excerpt( $post->ID ) ) {
      the_excerpt();
      ?><a href="<?php the_permalink(); ?>">
        <?php _e( 'Seguir leyendo →', 'b5st' ) ?>
        </a>
      <?php } else {
        the_content( __('Seguir leyendo →', 'b5st' ) );
      }*/ ?>
    
      <!-- <div class="text-muted mb-3">
        <i class="bi bi-calendar3 me-0 "></i> <?php strapword_post_date(); ?>
        <i class="bi bi-person-circle ms-3"></i> <?php _e('Por ', 'b5st'); the_author_posts_link(); ?>
        <i class="bi bi-chat-text ms-3"></i> <a href="<?php comments_link(); ?>"><?php printf( _nx( 'Un comentario', '%1$s Comentarios', get_comments_number(), '', 'b5st' ), number_format_i18n( get_comments_number() ) ); ?></a>
      </div> -->
      
    </section>
    

    <a href="<?php echo the_permalink(); ?>" class="btn btn-outline-secondary text-uppercase btn-home fs-7">Ver más</a>

  </div>

</article>