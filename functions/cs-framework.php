<?php 

// Control core classes for avoid errors
if( class_exists( 'CSF' ) ) {

	//
	// Set a unique slug-like ID
	$prefix = 'strapword_options';

	//
	// Create options
	CSF::createOptions( $prefix, array(
        'menu_title'      => 'Configuración Strapword',
        'menu_type'       => 'menu', // menu, submenu, options, theme, etc.
        'menu_slug'       => 'strapword-options',
        'framework_title' => 'Configuración Strapword <small>by Codestar</small>',
	));

	/* =============================== */
	/*           Tab General           */
	/* =============================== */
	CSF::createSection( $prefix, array(
		'id'        => 'general',
		'title'       => __('General', 'strapword'),
		'icon'        => 'fa fa-cog',
		'fields' => array(
			
			array(
				'id'      => 'logo_header',
				'type'    => 'fieldset',
				'title'   => __('Logo Header', 'strapword'),
                'fields' => array(
                    array(
                        'id'      => 'logo_header_img',
                        'type'    => 'media',
                        'library' => 'image',
                        'title'   => __('Image', 'strapword'),
                    ),
                    array(
                        'id'    => 'logo_header_width',
                        'type'  => 'number',
                        'unit'  => 'px',
                        'title' => __('Width', 'strapword'),
                    )
                )
			),
			
			array(
				'id'      => 'logo_footer',
				'type'    => 'fieldset',
				'title'   => __('Logo Footer', 'strapword'),
                'fields' => array(
                    array(
                        'id'      => 'logo_footer_img',
                        'type'    => 'media',
                        'library' => 'image',
                        'title'   => __('Image', 'strapword'),
                    ),
                    array(
                        'id'    => 'logo_footer_width',
                        'type'  => 'number',
                        'unit'  => 'px',
                        'title' => __('Width', 'strapword'),
                    )
                )
			),

			array(
				'id'      	=> 'gotop_button',
				'type'  	=> 'switcher',
				'title' 	=> __('Button "Go to top"', 'strapword'),
				'help'		=> __('Al activar esta opción se mostrara un boton flotante en la esquina inferior derecha del sitio que nos llevara a la parte superior del sitio.', 'strapword'),
			),

			/* array(
				'id'     => 'brands',
				'type'   => 'fieldset',
				'title'	 => __('Brands', 'strapword'),
				'fields' => array(


					 array(
						'id'       => 'brands_title',
						'type'     => 'text',
						'title'    => __('Título sección Marcas', 'strapword')
					),

					array(
						'id'     			=> 'brands_gallery',
					  	'type'        		=> 'gallery',
					  	'title'       		=> 'Gallery',
					  	'add_title'   		=> 'Add Images',
					  	'edit_title'  		=> 'Edit Images',
					  	'clear_title' 		=> 'Remove Images',
					),
				)
			), */ // end fieldset
		)
	) );

	/* =============================== */
	/*           Tab Contacto          */
	/* =============================== */
	require get_template_directory() . '/functions/cs-framework/medios-de-contacto.php';

    /* ==================================== */
    /*              Tab Banner              */
    /* ==================================== */
    CSF::createSection( $prefix, array(
        'id'     => 'modules',
        'title'    => __('Banners', 'strapword'),
        'icon'     => 'fas fa-images',
    ) );

    require get_template_directory() . '/functions/cs-framework/banners.php';

	/* =============================== */
	/*            Tab Backup           */
	/* =============================== */
	CSF::createSection( $prefix, array(
		'id'     => 'backup',
		'title'    => __('Backup', 'strapword'),
		'icon'     => 'fa fa-shield',
		'fields' => array(
			
			array(
			  'type' => 'backup',
			),

		)
	) );
}