<?php

/**
*
* Médias
*
**/

/*----------  Renomme les tailles par défaut dans WP  ----------*/

add_filter( 'image_size_names_choose', 'pc_rename_default_sizes' );

    function pc_rename_default_sizes( $sizes ) {

        return $sizes = array(
            'thumbnail' => '1/4 de page', 
            'medium'    => '1/2 page', 
            'large'     => 'Pleine largeur',
            'full'      => 'Originale'
        );

    }
    

/*----------  Options par défaut  ----------*/

add_action('after_setup_theme', 'custom_image_size');
    
    function custom_image_size() {
    
        // taille sélectionnée par défaut lors de l'ajout
        update_option( 'image_default_size', 'large' );

    }