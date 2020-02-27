<?php

/*
Plugin Name: [PC] Custom WP
Plugin URI: www.papier-code.fr
Description: Customisations admin & public
Version: 1.0.1
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

include 'pc-custom-wp_settings.php';

$pcSettings = get_option( 'pc-settings-option' );   // cf. fichier ci-dessus


/*----------  JS & CSS  ----------*/

add_action( 'admin_enqueue_scripts', function() {

    // scripts pour admin
    wp_enqueue_script( 'pc-custom-wp-scripts', plugin_dir_url( __FILE__ ).'pc-custom-wp_script.js' );
    // css pour admin
    wp_enqueue_style( 'pc-custom-wp-css', plugin_dir_url( __FILE__ ).'pc-custom-wp_style.css' );
    // media uploader
    wp_enqueue_media();

});


/*----------  Modules  ----------*/

// page de connexion
include 'pc-custom-wp_login.php';
// diverses modifications de l'admin
include 'pc-custom-wp_various.php';
// dashboard
include 'pc-custom-wp_dashboard.php';
// navigation
include 'pc-custom-wp_menu.php';
// page
include 'pc-custom-wp_page.php';
// Tiny MCE
include 'pc-custom-wp_tinymce.php';
// medias
include 'pc-custom-wp_medias.php';


/*----------  Custom Class exemples  ----------*/

add_action('plugins_loaded', function() use ($pcSettings) { // en attente du plugin [PC] Tools

    if ( isset( $pcSettings['dev-class-examples'] ) ) {

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

add_filter( 'admin_body_class', function( $classes ) use ( $pcSettings ) {

    $currentScreen = get_current_screen();

    // pour du CSS
    if ( !isset( $pcSettings['seo-rewrite-url'] ) ) { $classes .= ' no-url-rewriting'; }

    // pour du JS
    if ( isset( $pcSettings['page-parent'] ) && $currentScreen->id == 'page' ) { $classes .= ' page-parent-select'; }

    return $classes;

});



/*=====  FIN Classes CSS particulières  =====*/

/*========================================================
=            Mise à jour slug à la sauvegarde            =
========================================================*/

if ( !isset($pcSettings['seo-rewrite-url']) ) {

    add_action( 'save_post', 'pc_update_slug' );

        function pc_update_slug( $postId ) {

            // si ce n'est pas une révision
            if ( ! wp_is_post_revision( $postId ) ) {

                // prévention contre une boucle infinie 1/2
                remove_action( 'save_post', 'pc_update_slug' );

                // mise à jour slug
                wp_update_post( array(
                    'ID' => $postId,
                    'post_name' => sanitize_title(get_the_title($postId))
                ));

                // prévention contre une boucle infinie 2/2
                add_action( 'save_post', 'pc_update_slug' );

            }
        }

}


/*=====  FIN Mise à jour slug à la sauvegarde  ======*/
