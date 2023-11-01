<?php
/*
 * Setup
 */

if ( ! function_exists('strapword_setup') ) {
	function strapword_setup() {

        add_theme_support( 'buddypress' );

		add_theme_support( 'editor-styles' );
		add_editor_style('theme/css/editor.css');

		// Gutenberg Blocks
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );
		
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');

		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'strapword' ),
					'shortName' => __( 'S', 'strapword' ),
					'size'      => 14,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'strapword' ),
					'shortName' => __( 'M', 'strapword' ),
					'size'      => 16,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'strapword' ),
					'shortName' => __( 'L', 'strapword' ),
					'size'      => 22,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'strapword' ),
					'shortName' => __( 'XL', 'strapword' ),
					'size'      => 28,
					'slug'      => 'huge',
				),
			)
		);

		update_option('thumbnail_size_w', 285); /* internal max-width of col-3 */
		update_option('small_size_w', 350); /* internal max-width of col-4 */
		update_option('medium_size_w', 730); /* internal max-width of col-8 */
		update_option('large_size_w', 1110); /* internal max-width of col-12 */

		if ( ! isset($content_width) ) {
			$content_width = 1100;
		}

		add_theme_support( 'post-formats', array(
			'aside',
			'gallery',
			'link',
			'image',
			'quote',
			'status',
			'video',
			'audio',
			'chat'
		) );

		add_theme_support('automatic-feed-links');
	}
}
add_action('init', 'strapword_setup');

if ( ! function_exists( 'strapword_avatar_attributes' ) ) {
	function strapword_avatar_attributes($avatar_attributes) {
		$display_name = get_the_author_meta( 'display_name' );
		$avatar_attributes = str_replace('alt=\'\'', 'alt=\'Avatar for '.$display_name.'\' title=\'Gravatar for '.$display_name.'\'',$avatar_attributes);
		return $avatar_attributes;
	}
}
add_filter('get_avatar','strapword_avatar_attributes');

if ( ! function_exists( 'strapword_author_avatar' ) ) {
	function strapword_author_avatar() {

		echo get_avatar('', $size = '40');
	}
}

if ( ! function_exists( 'strapword_author_bio_avatar' ) ) {
	function strapword_author_bio_avatar() {

		echo get_avatar('', $size = '96');
	}
}

if ( ! function_exists( 'strapword_author_description' ) ) {
	function strapword_author_description() {
		echo get_the_author_meta('user_description');
	}
}

if ( ! function_exists( 'strapword_post_date' ) ) {
	function strapword_post_date() {
		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated" datetime="%3$s">(updated %4$s)</time>';
			}

			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				get_the_date(),
				esc_attr( get_the_modified_date( 'c' ) ),
				get_the_modified_date()
			);

			echo $time_string;
		}
	}
}

/**
 * Check if WooCommerce is activated
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}

//allow redirection, even if my theme starts to send output to the browser
//para habilitar la redireccion en la pag iniciar-sesion
//https://stackoverflow.com/a/7461813/3983624
add_action('init', 'do_output_buffer');
function do_output_buffer() {
        ob_start();
}


function strapword_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    ?>

<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>

        <div class="comment-author vcard d-flex">
            <div class="pe-3">
                <?php echo get_avatar( $comment->comment_author_email, $size = '52'); ?>
            </div>
            <div>
                <h4 class="fs-6 d-inline-block m-0"><?php comment_author(); ?></h4>
                <p class="comment-meta commentmetadata d-inline-block mb-1"><a class="small text-white-50" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf('%1$s ' . '-' . ' %2$s', get_comment_date('d/m/y'), get_comment_time('H:m')) ?></a></p>
                <?php if ($comment->comment_approved == '0') : ?>
                <p><em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'strapword') ?></em></p>
                <?php endif; ?>
                <?php comment_text() ?>
            </div>
        </div>

        <div class="reply">
            <p>
                <?php comment_reply_link( array_merge( $args, array(
                    'add_below' => $add_below,
                    'reply_text' => __('<i class="bi bi-reply"></i> Reply', 'textdomain'),
                    'depth' => $depth,
                    'max_depth' => $args['max_depth']
                    ))
                ); ?>
                <?php edit_comment_link('<span class="btn-reply">' . __('<i class="bi bi-pen"></i> Edit this reply', 'strapword') . '</span>',' ','' ); ?>
            </p>
        </div>

    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif;
}

add_filter( 'comment_post_redirect', 'redirect_comments', 10,2 );
function redirect_comments( $location, $commentdata ) {
    
    return wp_get_referer()."#log-".$_POST['comment_post_ID']; //$commentdata->comment_ID;
}