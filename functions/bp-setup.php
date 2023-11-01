<?php 
if (!function_exists('write_log')) {

    function write_log($log) {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }

}

// use buddypress scss in theme
function strapword_dequeue_style() {
    $handle = 'bp-nouveau';
    $inline_styles =  wp_styles()->get_data( $handle, 'after' );
    wp_deregister_style( $handle );
    // a new style from child theme with the same handle
    wp_enqueue_style( $handle, get_stylesheet_directory_uri() . '/theme/css/nouveau.css' );
    if( ! empty( $inline_styles ) ) {
        wp_add_inline_style( $handle, implode( "\n", $inline_styles ) );
    }
}
add_action( 'wp_enqueue_scripts', 'strapword_dequeue_style', 20 );

// Redirecting Wordpress's Login/Register page to a custom login/registration page
// https://stackoverflow.com/a/57277488/3983624
add_action('init', 'prevent_wp_login');
function prevent_wp_login() {
    // WP tracks the current page - global the variable to access it
    global $pagenow;
    // Check if a $_GET['action'] is set, and if so, load it into $action variable
    $action = (isset($_GET['action'])) ? $_GET['action'] : '';
    // Check if we're on the login page, and ensure the action is not 'logout'
    if( $pagenow == 'wp-login.php' && ( ! $action || ( $action && ! in_array($action, array('logout', 'lostpassword', 'rp', 'resetpass'))))) {
        // Load the home page url
        $page = get_bloginfo('url').'/iniciar-sesion/?rtn='.urlencode($_SERVER['REQUEST_URI']).'';
        // Redirect to the home page
        wp_redirect($page);
        // Stop execution to prevent the page loading for any reason
        exit();
    }
}

/* =============================== */
/*       Default profile pic       */
/* =============================== */
add_filter( 'bp_core_fetch_avatar_no_grav', '__return_true' );
function buddydev_set_default_use_avatar_based_on_member_type( $avatar, $params) {
    $n = get_stylesheet_directory_uri() . '/theme/img/laviuda-avatar-3.webp';
    return $n ;
}
add_filter( 'bp_core_default_avatar_user', 'buddydev_set_default_use_avatar_based_on_member_type', 10, 2 );

// Default member cover image
function custom_default_xprofile_cover_image( $settings = array() ) {
    $settings['default_cover'] = get_stylesheet_directory_uri() . '/theme/img/profile-cover-'.rand(1,3).'.webp'; // path to your image
    return $settings;
}
add_filter( 'bp_before_members_cover_image_settings_parse_args', 'custom_default_xprofile_cover_image', 10, 1 );

/* =============================== */
/*   Format fields with boostrap   */
/* =============================== */
add_filter('acf/prepare_field', 'acf_form_fields_bootstrap_styles');
function acf_form_fields_bootstrap_styles($field){
    
    // Target ACF Form Front only
    if(is_admin() && !wp_doing_ajax())
        return $field;

    /* if (!in_array($field['type'], array('upload_image', 'text', 'select', 'number', 'radio', 'textarea', 'fields_select'))) {
        //echo '<pre>';
        print_r($field);
        //echo '</pre>';
    } */

    if (in_array($field['type'], array('text', 'select', 'number', 'date_picker', 'textarea'))) {
        $field['class'] .= ' form-control';
    }

    /* if (in_array($field['type'], array('relationship'))) {
        echo '<pre>';
        print_r($field);
        echo '</pre>';
    } */

    if (in_array($field['type'], array('radio'))) {
        $field['class'] .= ' form-check form-check-inline';
        $field['wrapper']['class'] .= ' form-group col-12';
    }

    if (in_array($field['type'], array('range'))) {
        $field['class'] .= ' form-range';
    }
    
    return $field;
}

add_filter('acf/get_field_label', 'acf_form_fields_required_bootstrap_styles');
function acf_form_fields_required_bootstrap_styles($label){
    
    // Target ACF Form Front only
    if(is_admin() && !wp_doing_ajax())
        return $label;
    
    // Add .text-danger
    $label = str_replace('<span class="acf-required">*</span>', '<span class="acf-required text-danger">*</span>', $label);
    
    return $label;
}

/* =============================== */
/*     ACF post title and slug     */
/* =============================== */
// Update Post Title Value
add_filter('acf/update_value/name=my_post_title', 'my_acf_post_title_save_value', 10, 3);
function my_acf_post_title_save_value($value, $post_id, $field){

    // Retrieve Post ID Info
    $data = acf_get_post_id_info($post_id);
    $fecha = get_post_field('fecha', $post_id);
    $formated_fecha = date("d/m/Y", strtotime($fecha));

    // Bail early if not Post
    if($data['type'] !== 'post')
        return $value;

    $log_title = 'Log '. $formated_fecha .' - #'. $post_id;
    wp_update_post(array(
        'ID'            => $data['id'],
        'post_title'    => $log_title,
    ));

    return $value;
}

// Load Post Title Value
/* add_filter('acf/load_value/name=my_post_title', 'my_acf_post_title_load_value', 10, 3);
function my_acf_post_title_load_value($value, $post_id, $field){

    // Retrieve Post ID Info
    $data = acf_get_post_id_info($post_id);

    // Bail early if not Post
    if($data['type'] !== 'post')
        return $value;

    // Retrieve current Post Title
    $value = get_post_field('my_post_title', $data['id']);

    return $value;

} */

/* =============================== */
/*   Log form current user posts   */
/* =============================== */
function my_post_object_query( $args ) {
    $args['author'] = get_current_user_id();
    return $args;
}
add_filter('acf/fields/post_object/query/name=log_ambiente', 'my_post_object_query', 10, 3);
add_filter('acf/fields/post_object/query/name=log_planta', 'my_post_object_query', 10, 3);

/* =============================== */
/*     Redirect log after save     */
/* =============================== */
add_action('acf/save_post', 'my_fa_save_post');
function my_fa_save_post( $post_id ) {

    $log_type = get_field('log_type', $post_id);
        
    switch ($log_type) {
        case 'Planta':
            $return_id = get_field('log_planta', $post_id);
            break;
        
        case 'Ambiente':
            $return_id = get_field('log_ambiente', $post_id);
            break;
        
        default:
            $return_id = $post_id;
            break;
    }
    
    wp_redirect(get_permalink($return_id).'#log-'.$post_id);
    exit;
}

/* =============================== */
/*   Custom reply comment button   */
/* =============================== */
function custom_comment_reply_link($content) {
    $extra_classes = 'btn-reply';
    return preg_replace( '/comment-reply-link/', 'comment-reply-link '. $extra_classes, $content);
}
add_filter('comment_reply_link', 'custom_comment_reply_link', 99);
