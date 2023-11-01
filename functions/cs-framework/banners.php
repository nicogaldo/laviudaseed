<?php

    // Create a sub-tab
    CSF::createSection( $prefix, array(
        'parent' => 'modules', // The slug id of the parent section
        'title'  =>  __('Sección Home', 'strapword'),
        'fields' => array(

            /* ------------ Inicio Slider ------------ */
            array(
                'id'     => 'slider_home',
                'type'   => 'group',
                'title'  => __('Módulo slider', 'strapword'),
                'fields' => array(

                    array(
                        'id'    => 'slider_home_name',
                        'type'  => 'text',
                        'title' => __('Nombre', 'strapword'),
                    ),

                    array(
                        'id'    => 'slider_home_img_mobile',
                        'type'  => 'media',
                        'title' => __('Banner Movil', 'strapword'),
                        'library' => 'image',
                        'desc'	=> __('Tamaño del banner no mayor a 1000px en proporción 4:', 'strapword'),
                    ),
                                        
                    array(
                        'id'    => 'slider_home_img_pc',
                        'type'  => 'media',
                        'title' => __('Banner PC', 'strapword'),
                        'library' => 'image',
                        //'desc'	=> __('Ej: Todos los días de 10 a 21 hs', 'strapword'),
                    ),

                    array(
                        'id'      => 'slider_home_text',
                        'type'    => 'switcher',
                        'title'   => __('Contenido', 'strapword'),
                        'label'   => __('Activar textos en Banner', 'strapword'),
                        'help'    => __('Al activar esta opción se mostrara distintos campos para agregar textos en el banner', 'strapword'),
                        'default' => false // or false
                      ),

                    array(
                        'id'    => 'slider_home_main_text',
                        'type'  => 'text',
                        'title' => __('Texto Principal', 'strapword'),
                        'dependency' => array( 'slider_home_text', '==', 'true' ),
                    ),

                    array(
                        'id'    => 'slider_home_secondary_text',
                        'type'  => 'textarea',
                        'title' => __('Sub-texto', 'strapword'),
                        'dependency' => array( 'slider_home_text', '==', 'true' ),
                    ),
                        
                    array(
                        'id'    => 'slider_home_vertical_position',
                        'type'  => 'slider',
                        'title' => __('Posición vertical', 'strapword'),
                        'dependency' => array( 'slider_home_text', '==', 'true' ),
                        'desc'	=> __('Posición vertical de la caja de texto', 'strapword'),
                        'min'     => 0,
                        'max'     => 100,
                        'step'    => 1,
                        'unit'    => '%',
                        'default' => 50,
                      ),

                    array(
                        'id'    => 'slider_home_link',
                        'type'  => 'text',
                        'title' => __('Enlace del Banner', 'strapword'),
                        'desc'	=> __('Enlace del banner al hacer click', 'strapword'),
                    ),

                    array(
                        'id'      => 'slider_home_button',
                        'type'    => 'switcher',
                        'dependency' => array( 'slider_home_link', '!=', '' ),
                        'title'   => __('Boton', 'strapword'),
                        'label'   => __('Activar boton', 'strapword'),
                        'help'    => __('Al activar esta opción se mostrara un boton en el banner', 'strapword'),
                        'default' => false // or false
                      ),

                    array(
                        'id'    => 'slider_home_button_text',
                        'type'  => 'text',
                        'dependency' => array( 'slider_home_button', '==', 'true' ),
                        'title' => __('Texto del boton', 'strapword'),
                        'desc'	=> __('Texto del Boton en el banne', 'strapword'),
                    ),

                    array(
                        'id'    => 'slider_home_button_id',
                        'type'  => 'text',
                        'dependency' => array( 'slider_home_button', '==', 'true'),
                        'title' => __('ID boton', 'strapword'),
                        'desc'	=> __('Asignar un nombre unico sin espacio', 'strapword'),
                    ),

                    array(
                        'id'            => 'slider_home_tabs',
                        'type'          => 'tabbed',
                        'dependency' => array( 'slider_home_button', '==', 'true' ),
                        'title'         => __('Personalización del boton', 'strapword'),
                        'tabs'          => array(    
                            array(
                                'title'     => __('Mobile', 'strapword'),
                                'icon'      => 'fa fa-mobile-alt',
                                'fields'    => array(
                            
                                    array(
                                        'id'            => 'slider_home_size_mobile',
                                        'type'          => 'spacing',
                                        'title'         => __('Tamaño del boton', 'strapword'),
                                        'desc'	        => __('Espacio entre el texto y el borde', 'strapword'),
                                        'right'         => false,
                                        'bottom'        => false,
                                        'default'       => array(
                                            'top'           => '8',
                                            'left'          => '20',
                                            'unit'          => 'px',
                                        ),
                                    ),
                
                                    array(
                                        'id'          => 'slider_home_fs_mobile',
                                        'type'        => 'number',
                                        'title'       => __('Tamaño de la fuente del boton', 'strapword'),
                                        'unit'        => 'px',
                                        'default'     => 12,
                                    ),

                                    /* array(
                                        'id'            => 'slider_home_position_mobile',
                                        'type'          => 'spacing',
                                        'title'         => __('Posición del boton', 'strapword'),
                                        'desc'	        => __('Ubicación del boton en el banner, se puede elegir px o %.', 'strapword'),
                                        'right'         => false,
                                        'bottom'        => false,
                                        'default'       => array(
                                            'top'           => '50',
                                            'left'          => '50',
                                            'unit'          => '%',
                                        ),
                                    ), */
                                )
                            ),
                      
                            array(
                                'title'     => __('Tablet', 'strapword'),
                                'icon'      => 'fa fa-tablet',
                                'fields'    => array(
                                    array(
                                        'id'            => 'slider_home_size_tablet',
                                        'type'          => 'spacing',
                                        'title'         => __('Tamaño del boton', 'strapword'),
                                        'desc'	        => __('Espacio entre el texto y el borde', 'strapword'),
                                        'right'         => false,
                                        'bottom'        => false,
                                        'default'       => array(
                                            'top'           => '12',
                                            'left'          => '50',
                                            'unit'          => 'px',
                                        ),
                                    ),
                            
                                    array(
                                        'id'          => 'slider_home_fs_tablet',
                                        'type'        => 'number',
                                        'title'       => __('Tamaño de la fuente del boton', 'strapword'),
                                        'unit'        => 'px',
                                        'default'     => 14,
                                    ),

                                    /* array(
                                        'id'            => 'slider_home_position_tablet',
                                        'type'          => 'spacing',
                                        'title'         => __('Posición del boton', 'strapword'),
                                        'desc'	        => __('Ubicación del boton en el banner, se puede elegir px o %.', 'strapword'),
                                        'right'         => false,
                                        'bottom'        => false,
                                        'default'       => array(
                                            'top'           => '50',
                                            'left'          => '50',
                                            'unit'          => '%',
                                        ),
                                    ), */
                                )
                            ),

                            array(
                                'title'     => __('Desktop', 'strapword'),
                                'icon'      => 'fa fa-desktop',
                                'fields'    => array(
                                    array(
                                        'id'            => 'slider_home_size_desktop',
                                        'type'          => 'spacing',
                                        'title'         => __('Tamaño del boton', 'strapword'),
                                        'desc'	        => __('Espacio entre el texto y el borde', 'strapword'),
                                        'right'         => false,
                                        'bottom'        => false,
                                        'default'       => array(
                                            'top'           => '12',
                                            'left'          => '50',
                                            'unit'          => 'px',
                                        ),
                                    ),
                            
                                    array(
                                        'id'          => 'slider_home_fs_desktop',
                                        'type'        => 'number',
                                        'title'       => __('Tamaño de la fuente del boton', 'strapword'),
                                        'unit'        => 'px',
                                        'default'     => 14,
                                    ),

                                    array(
                                        'id'            => 'slider_home_position_desktop',
                                        'type'          => 'spacing',
                                        'title'         => __('Posición del boton', 'strapword'),
                                        'desc'	        => __('Ubicación del boton en el banner, se puede elegir px o %.', 'strapword'),
                                        'right'         => false,
                                        'bottom'        => false,
                                        'default'       => array(
                                            'top'           => '50',
                                            'left'          => '50',
                                            'unit'          => '%',
                                        ),
                                    ),

                                    /* array(
                                        'id'            => 'slider_home_position_desktop',
                                        'type'          => 'spacing',
                                        'title'         => __('Posición del boton', 'strapword'),
                                        'desc'	        => __('Ubicación del boton en el banner, se puede elegir px o %.', 'strapword'),
                                        'right'         => false,
                                        'bottom'        => false,
                                        'default'       => array(
                                            'top'           => '50',
                                            'left'          => '50',
                                            'unit'          => '%',
                                        ),
                                    ), */
                                )
                            ), //end tab
                        ) 
                    ), //end tabs field
                ),
            ), // end group

        
            array(
                'id'     => 'slider_home_height',
                'type'   => 'dimensions',
                'title'  => __('Altura del slider', 'strapword'),
                'desc'  => __('Modificar altura del slider, por defecto mide 550px', 'strapword'),
                'width'  => false,           
            ),
        
            /* -------------- Fin Slider ------------- */
        
        )    
    ) );// end: sub-tab