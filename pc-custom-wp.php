<?php

/*
Plugin Name: [PC] Custom WP
Plugin URI: www.papier-code.fr
Description: Customisations admin & public
Version: 1.0.0
Author: Papier Codé
*/

/**
 *
 ** Include
 ** Classes CSS particulières
 ** Mise à jour slug à la sauvegarde
 *
 */

/*===============================
=            Include            =
===============================*/

/*----------  Réglages projets  ----------*/

include 'include/pc-custom-wp_settings.php';

$pc_custom_settings = get_option( 'pc-settings-option' );   // cf. fichier ci-dessus


/*----------  JS & CSS  ----------*/

add_action( 'admin_enqueue_scripts', function() {

    // scripts pour admin
    wp_enqueue_script( 'pc-custom-wp-scripts', plugin_dir_url( __FILE__ ).'include/pc-custom-wp_script.js' );
    // css pour admin
    wp_enqueue_style( 'pc-custom-wp-css', plugin_dir_url( __FILE__ ).'include/pc-custom-wp_style.css' );
    // media uploader
    wp_enqueue_media();

});


/*----------  Classes CSS  utiles  ----------*/

add_filter( 'admin_body_class', function( $classes ) use ( $pc_custom_settings ) {

    // pour masquer certaines actions
    if ( !isset( $pc_custom_settings['seo-rewrite-url'] ) ) { $classes .= ' no-url-rewriting'; }

    return $classes;

});


/*----------  Modules  ----------*/

// page de connexion
include 'include/pc-custom-wp_login.php';
// diverses modifications de l'admin
include 'include/pc-custom-wp_various.php';
// dashboard
include 'include/pc-custom-wp_dashboard.php';
// navigation
include 'include/pc-custom-wp_menu.php';
// page
include 'include/pc-custom-wp_page.php';
// sauvegarde post
include 'include/pc-custom-wp_save-post.php';
// Tiny MCE
include 'include/pc-custom-wp_tinymce.php';
// medias
include 'include/pc-custom-wp_medias.php';


/*----------  Custom Class exemples  ----------*/

add_action('plugins_loaded', function() use ($pc_custom_settings) { // en attente du plugin [PC] Tools

    if ( isset( $pc_custom_settings['dev-class-examples'] ) ) {

        include 'class-examples/ex_add-custom-post.php';
        include 'class-examples/ex_add-metabox.php';
        include 'class-examples/ex_add-field-to-tax.php';
        include 'class-examples/ex_add-custom-admin.php';

    }

});


/*=====  FIN Include  ======*/

/*=================================================
=            Classes CSS particulières            =
=================================================*/



/*=====  FIN Classes CSS particulières  =====*/