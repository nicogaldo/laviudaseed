<?php
/*
 * Custom Feedback
 * ===============
 * https://codex.wordpress.org/Function_Reference/wp_list_comments#Comments_Only_With_A_Custom_Comment_Display
*/


/**!
 * Custom Comments Form
 */

// Do not delete this section
if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])){
  die ('Please do not load this page directly. Thanks!'); }
if ( post_password_required() ) { ?>
<section id="post-comments">
    <div class="comments-wrap wrap-md">
        <div class="alert alert-warning">
            <?php _e('This post is password protected. Enter the password to view comments.', 'strapword'); ?>
        </div>
    </div>
</section>
<?php
  return;
} // End do not delete section

?>


<?php if (comments_open()) : ?>
<section id="respond" class="wrap-md pb-3">
    <div class="comments-wrap border-bottom border-light border-opacity-25 pb-2">
        <div>
            <span class="fs-4 d-block"><?php comment_form_title(__('Dejá un comentario', 'strapword'), __('Respuestas de %s', 'strapword')); ?></span>
            <!-- <p class="small mb-0">Required fields are marked <span class="fs-4">*</span></p> -->
            <p class="small"><?php cancel_comment_reply_link(); ?></p>
            <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
            <p class="small"><?php printf(__('Debes <a href="%s">iniciar sesión</a> para dejar un comentario.', 'strapword'), wp_login_url(get_permalink())); ?></p>
            <?php else : ?>

            <form action="<?php echo site_url('/wp-comments-post.php') ?>" method="post" id="commentform">

                <?php if (is_user_logged_in()) : ?>
                <!-- <p class="small">
                    <?php printf(__('Ingresaste como ', 'strapword') . ' <a href="%s/wp-admin/profile.php">%s</a>.', get_option('url'), $user_identity); ?>
                    <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Salir de esta cuenta', 'strapword'); ?>"><?php echo __('Salir', 'strapword') . ' <i class="bi bi-arrow-right"></i>'; ?></a>
                </p> -->
                <?php else : ?>

                <div class="form-group">
                    <label for="author" class="mb-2">
                        <?php _e('Your name', 'strapword'); if ($req) echo '*'; ?>
                    </label>
                    <input type="text" class="form-control" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" <?php if ($req) echo 'aria-required="true"'; ?>>
                </div>

                <div class="form-group">
                    <label for="email" class="my-2">
                        <?php _e('Your email address', 'strapword'); if ($req) echo '*'; echo '<span class="text-muted">' . __('(will not be published)', 'strapword') . '</span>'; ?>
                    </label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" <?php if ($req) echo 'aria-required="true"'; ?>>
                </div>

                <div class="form-group">
                    <label for="url" class="my-2">
                        <?php echo __('Your website or blog', 'strapword') . '<span class="text-muted">' . __(' (not required)', 'strapword') . '</span>'; ?>
                    </label>
                    <input type="url" class="form-control" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>">
                </div>

                <?php endif; ?>

                <div class="form-group">
                    <!-- <label for="comment" class="my-2"><?php _e('Your comment:', 'strapword'); ?></label> -->
                    <textarea name="comment" class="form-control mt-1 mb-3" id="comment" rows="2" aria-required="true" placeholder="<?php _e('Tu comentario:', 'strapword'); ?>"></textarea>
                </div>

                <p><input name="submit" class="btn btn-primary" type="submit" id="submit" value="<?php _e('Publicar', 'strapword'); ?>"></p>

                <?php comment_id_fields($post->ID); ?>
                <?php do_action('comment_form', $post->ID); ?>
            </form>
            <?php endif; ?>


        </div>
    </div>
</section>
<?php endif; ?>



<?php
if (have_comments()) : ?>

<section id="post-comments">
    <div class="comments-wrap wrap-md">
        <!-- <h3 class="mt-5 mb-3">
                <?php printf(
          /* translators: 1: title. */
          esc_html__( 'Feedback', 'strapword' ),
          '<span>' . get_the_title() . '</span>'
        );?>
            </h3> -->

        <p class="mb-0"><i class="bi bi-chat-text"></i> <?php
          $comment_count = get_comments_number();
          if ( '1' === $comment_count ) {
            printf(
              /* translators: 1: title. */
              esc_html__( 'One comment on &ldquo;%1$s&rdquo;', 'strapword' ),
              '<span>' . get_the_title() . '</span>'
            );
          } else {
            printf(
              /* translators: 1: comment count number, 2: title. */
              /* esc_html( _nx( '%1$s comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'strapword' ) ), */
              esc_html( _nx( '%1$s comentario', '%1$s comentarios', $comment_count, 'strapword' ) ),
              number_format_i18n( $comment_count ),
              '<span>' . get_the_title() . '</span>'
            );
          }
        ?>
        </p>

        <ol class="comment-list list-unstyled">
            <?php wp_list_comments('type=comment&callback=strapword_comment');?>
        </ol><!-- /.comment-list -->

        <p class="text-muted">
            <?php paginate_comments_links(); ?>
        </p>
    </div>
</section>
<?php
else :
    if (comments_open()) :
        echo '<section id="post-comments"><div class="comments-wrap wrap-md"><p class="alert alert-info mt-4 py-2">' . __('Sé primero en comentar.', 'strapword') . '</p></div></section>';
    else :
        echo '<section id="post-comments"><div class="comments-wrap wrap-md"><p class="alert alert-info mt-4 py-2">' . __('Comentarios cerrados.', 'strapword') . '</p></div></section>';
    endif;
endif; ?>