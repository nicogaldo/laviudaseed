<?php
/*
 * Enqueues
 */

if ( ! function_exists('strapword_enqueues') ) {
	function strapword_enqueues() {

		// Styles

		//wp_register_style('bootstrap5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css', false, '5.3.1', null);
		//wp_enqueue_style('bootstrap5');

		//wp_register_style('fontawesome5', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', false, '5.15.4');
		//wp_enqueue_style('fontawesome5');

		wp_register_style('fontawesome6', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', false, '6.4.2');
		wp_enqueue_style('fontawesome6');

		wp_register_style('bootstrapIcons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css', false, '1.10.5');
		wp_enqueue_style('bootstrapIcons');
		
		wp_register_style('animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', false, '4.1.1',);
		wp_enqueue_style('animate');

		wp_register_style('swiper', 'https://unpkg.com/swiper@10.2.0/swiper-bundle.min.css', false, '10.2.0');
		wp_enqueue_style('swiper');

		wp_enqueue_style( 'gutenberg-blocks', get_template_directory_uri() . '/theme/css/blocks.css' );

		wp_register_style('theme', get_template_directory_uri() . '/theme/css/strapword.css', false, null);
		wp_enqueue_style('theme');

        
        //wp_dequeue_style( 'bp-nouveau' );

	  
		// Scripts

		wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', false, '3.6.0', true);
		wp_enqueue_script('jquery');

		wp_register_script('bootstrap5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js', false, '5.3.1', true);
		wp_enqueue_script('bootstrap5');

		wp_register_script('swiper', 'https://unpkg.com/swiper@10.2.0/swiper-bundle.min.js', false, '10.2.0', true);
		wp_enqueue_script('swiper');

		wp_register_script('scrolla', 'https://cdn.jsdelivr.net/npm/jquery-scrolla@0.0.3/dist/js/jquery.scrolla.min.js', array('jquery'), '0.0.3', true);
		wp_enqueue_script('scrolla');
        
        wp_register_script('fixed-top-on-scroll', get_template_directory_uri() . '/theme/js/fixed-top-on-scroll.js', false, null, true);
        wp_enqueue_script('fixed-top-on-scroll');

		wp_register_script('theme', get_template_directory_uri() . '/theme/js/strapword.js', false, null, true);
		wp_enqueue_script('theme');

		if (is_singular() && comments_open() && get_option('thread_comments') || is_buddypress()) {
			wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'strapword_enqueues', 100);
