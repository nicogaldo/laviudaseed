<?php
/* =============================== */
/*           Tab Contacto          */
/* =============================== */
CSF::createSection( $prefix, array(
    'id'        => 'social_media',
    'title'       => __('Medios de Contacto', 'strapword'),
    'icon'        => 'fa fa-envelope',
    'fields'    => array(

        array(
            'id'    => 'activate_menu_redes',
            'type'  => 'switcher',
            'default' => 0,
            'title' => __('Activar menú de redes sociales', 'strapword'),
            'help' => __('Al activar esta opción se mostrara un menú en el footer con las distintas redes sociales.', 'strapword'),
        ),

        array(
            'id'    => 'title_redes',
            'type'  => 'text',
            'title' => __('Titulo', 'strapword'),
            'desc' => __('Titulo a mostrar en el menu del footer.', 'strapword'),
            'default' => 'Seguinos!',
            'dependency' => array( 'activate_menu_redes', '==', 'true' ),
        ),

        array(
            'id'        => 'menu_redes',
            'type'      => 'sortable',
            'title'     => 'Menu',
            'dependency' => array( 'activate_menu_redes', '==', 'true' ),
            'fields'    => array(

                array(
                    'id'    => 'email_general',
                    'type'  => 'text',
                    'title' => __('Email', 'strapword'),
                    'desc' => __('Email de contacto', 'strapword'),
                    'validate' => 'csf_validate_email',
                ),
    
                array(
                    'id'    => 'facebook_general',
                    'type'  => 'text',
                    'title' => __('Facebook', 'strapword'),
                    'desc' => __('Usuario de Facebook', 'strapword'),
                ),
    
                array(
                    'id'    => 'instagram_general',
                    'type'  => 'text',
                    'title' => __('Instagram', 'strapword'),
                    'desc' => __('Usuario de Instagram sin @', 'strapword'),
                ),
    
                array(
                    'id'    => 'telegram_general',
                    'type'  => 'text',
                    'title' => __('Telegram', 'strapword'),
                    'desc' => __('Usuario de Telegram sin @', 'strapword'),
                ),
    
                array(
                    'id'    => 'tiktok_general',
                    'type'  => 'text',
                    'title' => __('Tiktok', 'strapword'),
                    'desc' => __('Usuario de Tiktok sin @', 'strapword'),
                ),
    
                array(
                    'id'    => 'twitter_general',
                    'type'  => 'text',
                    'title' => __('Twitter', 'strapword'),
                    'desc' => __('Usuario de Twitter sin @', 'strapword'),
                ),
    
                array(
                    'id'    => 'linkedin_general',
                    'type'  => 'text',
                    'title' => __('Linkedin', 'strapword'),
                    'desc' => __('Usuario de Linkedin', 'strapword'),
                ),
    
                /* array(
                    'id'    => 'tripadvisor_general',
                    'type'  => 'text',
                    'title' => __('Tripadvisor', 'strapword'),
                    'desc' => __('Enlace de Tripadvisor', 'strapword'),
                ), */
    
                array(
                    'id'    => 'youtube_general',
                    'type'  => 'text',
                    'title' => __('Youtube', 'strapword'),
                    'desc' => __('Usuario de Youtube', 'strapword'),
                ),


            ),
        ),

        array(
            'id'    => 'whatsapp_floating_button',
            'type'  => 'switcher',
            'default' => 0,
            'title' => __('Boton flotante Whatsapp', 'strapword'),
            'help' => __('Al activar esta opción se mostrara un boton flotante en la esquina inferior derecha del sitio', 'strapword'),
        ),
    
        array(
            'id'     => 'whatsapp_general',
            'type'   => 'fieldset',
            'title' => __('Whatsapp', 'strapword'),
            'dependency' => array( 'whatsapp_floating_button', '==', 'true' ),
            'fields' => array(
                array(
                    'id'    => 'whatsapp_number',
                    'type'  => 'text',
                    'title' => __('Numero', 'strapword'),
                    'desc' => __('Ej: 549351234567', 'strapword'),
                    'help' => __('Al completar el numero se activara la opción para usar el boton flotante.', 'strapword'),
                ),
                array(
                    'id'    => 'whatsapp_text',
                    'type'  => 'text',
                    'title' => __('Texto a enviar en el mensaje.', 'strapword'),
                    'desc' => __('Ej: Hola, quisiera comunicarme', 'strapword'),
                ),
                
            ),
        ),
    )
));// end: sub-tab