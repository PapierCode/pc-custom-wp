<?php

/**
*
* Médias
*
**/
    

/*----------  Options par défaut  ----------*/

add_action('after_setup_theme', 'custom_image_size');
    
    function custom_image_size() {
    
        // taille sélectionnée par défaut lors de l'ajout
        update_option( 'image_default_size', 'large' );

    }