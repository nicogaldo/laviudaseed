<?php 
// Register Custom Post Type
function sw_custom_post_type() {

	/* Locales */
	$labels = array(
		'name'                  => _x( 'Ambientes de cultivo', 'Post Type General Name', 'strapword' ),
		'singular_name'         => _x( 'Ambiente de cultivo', 'Post Type Singular Name', 'strapword' ),
		'menu_name'             => __( 'Ambientes de cultivo', 'strapword' ),
		'name_admin_bar'        => __( 'Ambiente de cultivo', 'strapword' ),
		'add_new_item'          => __( 'Añadir nuevo ambiente de cultivo', 'strapword' ),
		'add_new'               => __( 'Añadir nuevo', 'strapword' ),
	);
	$args = array(
		'label'                 => __( 'Ambiente de cultivo', 'strapword' ),
		'description'           => __( 'Ambientes de cultivo', 'strapword' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'content', 'comments' ),
		'taxonomies'            => array(  ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'menu_icon'				=> 'dashicons-image-filter',
		'capability_type'       => 'post',
        'rewrite'           	=> array( 'slug' => 'ambientes' ),
	);
	register_post_type( 'ambiente', $args );

	/* Locales */
	$labels2 = array(
		'name'                  => _x( 'Plantas', 'Post Type General Name', 'strapword' ),
		'singular_name'         => _x( 'Planta', 'Post Type Singular Name', 'strapword' ),
		'menu_name'             => __( 'Plantas', 'strapword' ),
		'name_admin_bar'        => __( 'Planta', 'strapword' ),
		'add_new_item'          => __( 'Añadir nueva planta', 'strapword' ),
		'add_new'               => __( 'Añadir nueva', 'strapword' ),
	);
	$args2 = array(
		'label'                 => __( 'Planta', 'strapword' ),
		'description'           => __( 'Plantas', 'strapword' ),
		'labels'                => $labels2,
		'supports'              => array( 'title', 'thumbnail', 'content', 'comments' ),
		'taxonomies'            => array(  ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'menu_icon'				=> 'dashicons-palmtree',
		'capability_type'       => 'post',
        'rewrite'           	=> array( 'slug' => 'plantas' ),
	);
	register_post_type( 'planta', $args2 );

	/* Locales */
	$labels3 = array(
		'name'                  => _x( 'Logs', 'Post Type General Name', 'strapword' ),
		'singular_name'         => _x( 'Log', 'Post Type Singular Name', 'strapword' ),
		'menu_name'             => __( 'Logs', 'strapword' ),
		'name_admin_bar'        => __( 'Log', 'strapword' ),
		'add_new_item'          => __( 'Añadir nuevo log', 'strapword' ),
		'add_new'               => __( 'Añadir nuevo', 'strapword' ),
	);
	$args3 = array(
		'label'                 => __( 'Log', 'strapword' ),
		'description'           => __( 'Logs', 'strapword' ),
		'labels'                => $labels3,
		'supports'              => array( 'title', 'thumbnail', 'content', 'comments' ),
		'taxonomies'            => array(  ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'menu_icon'				=> 'dashicons-insert',
		'capability_type'       => 'post',
        'rewrite'           	=> array( 'slug' => 'logs' ),
	);
	register_post_type( 'log', $args3 );

}
add_action( 'init', 'sw_custom_post_type', 0 );

/*=============================================
=             Locales Taxonomies              =
=============================================*/
function sw_create_ambiente_taxonomies() {
    $labels = array(
        'name'              => _x( 'Categorías', 'taxonomy general name' ),
        'singular_name'     => _x( 'Categoría', 'taxonomy singular name' ),
        'menu_name'         => __( 'Categorías' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_admin_column' => true,
		'show_in_rest'		=> true,
		'has_archive'       => false,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'ambiente' ),
    );
    register_taxonomy( 'categoria_ambiente', array( 'ambiente' ), $args );
}
add_action( 'init', 'sw_create_ambiente_taxonomies', 0 );