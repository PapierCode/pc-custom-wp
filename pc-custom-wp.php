<?php

/*
Plugin Name: [PC] Custom WP
Plugin URI: www.papier-code.fr
Description: Customisations admin & public 
Version: 0.5.6
Author: Papier Codé
*/

/**
*
* Include
* Divers
* Page de connexion
* Barre d'admin
* Footer
* Mise à jour slug à la sauvegarde
* Modification rapide
*
**/


/*===============================
=            Include            =
===============================*/

/*----------  Réglages projets  ----------*/

include 'pc-custom-wp_settings.php';

$pcSettings = get_option( 'pc-settings-option' );   // cf fichier ci-dessus


/*----------  JS & CSS  ----------*/

add_action( 'admin_enqueue_scripts', function() {

    // scripts pour admin
    wp_enqueue_script( 'custom-wp-scripts', plugin_dir_url( __FILE__ ).'pc-custom-wp_script.js' );
    // css pour admin
    wp_enqueue_style( 'custom-wp-css', plugin_dir_url( __FILE__ ).'pc-custom-wp_style.css' );
    // media uploader
    wp_enqueue_media();

});


/*----------  Modules  ----------*/

// page de connexion
include 'pc-custom-wp_login.php';
// dashboard
include 'pc-custom-wp_dashboard.php';
// navigation
include 'pc-custom-wp_menu.php';
// page
include 'pc-custom-wp_page.php';
// Tiny MCE
include 'pc-custom-wp_tinymce.php';


/*----------  Admin body class  ----------*/

add_filter( 'admin_body_class', function($classes) use ($pcSettings) {

    $currentScreen = get_current_screen();

    // pour du CSS
    if ( !isset($pcSettings['seo-rewrite-url']) ) { $classes .= ' no-url-rewriting'; }

    // pour du JS
    if ( isset($pcSettings['page-parent']) && $currentScreen->id == 'page' ) { $classes .= ' page-parent-select'; }

    return $classes;

}); 


/*=====  FIN Include  ======*/

/*==============================
=            Divers            =
==============================*/

/*----------  masquer la version de wordpress  ----------*/

// si wp_head() présent dans header.php
remove_action("wp_head", "wp_generator");


/*----------  Masquer les mises à jour pour les non administrateur  ----------*/

add_action( 'admin_head', function() {

	if ( !current_user_can('update_core') ) { remove_action( 'admin_notices', 'update_nag', 3 ); }

}, 1 );


/*----------  Désactiver l'éditeur de code  ----------*/

define( 'DISALLOW_FILE_EDIT', true );


/*----------  Ajout de média  ----------*/

// supprime les liens pour créer une playlist audio et vidéo
add_filter( 'media_library_show_video_playlist', function () { return false; } );
add_filter( 'media_library_show_audio_playlist', function () { return false; } );


/*=====  FIN Divers  ======*/

/*=====================================
=            Barre d'admin            =
=====================================*/

/*----------  Simplification  ----------*/

add_action( 'admin_bar_menu', 'remove_adminbar_items', 999 );

	function remove_adminbar_items( $wp_admin_bar ) {

		// pc_display_var($wp_admin_bar);
		// return;

	    $wp_admin_bar->remove_node( 'wp-logo' ); // logo WP
	    $wp_admin_bar->remove_node( 'comments' ); // commentaires en attente
	    $wp_admin_bar->remove_node( 'new-content' ); // créer
	    $wp_admin_bar->remove_node( 'view' ); // créer
	    $wp_admin_bar->remove_node( 'archive' ); // voir post

	}


/*=====  FIN Barre d'admin  ======*/

/*==============================
=            Footer            =
==============================*/

/*----------  Texte  ----------*/

add_filter( 'admin_footer_text', function() {

	return '';

});


/*----------  Masquer version WP  ----------*/

add_action( 'admin_menu', function() { 
		
	remove_filter( 'update_footer', 'core_update_footer' );

});


/*=====  FIN Footer  ======*/

/*========================================================
=            Mise à jour slug à la sauvegarde            =
========================================================*/

// https://codex.wordpress.org/Plugin_API/Action_Reference/save_post

if ( !isset($pcSettings['seo-rewrite-url']) ) {

    add_action( 'save_post', 'pc_update_slug' );

        function pc_update_slug( $post_id ) {

            // si ce n'est pas une révision
            if ( ! wp_is_post_revision( $post_id ) ) {

                // prévention contre une boucle infinie 1/2
                remove_action( 'save_post', 'pc_update_slug' );

                // mise à jour slug
                wp_update_post( array(
                    'ID' => $post_id,
                    'post_name' => sanitize_title(get_the_title($post_id))
                ));

                // prévention contre une boucle infinie 2/2
                add_action( 'save_post', 'pc_update_slug' );

            }
        }

}


/*=====  FIN Mise à jour slug à la sauvegarde  ======*/

/*===========================================
=            Modification Rapide            =
===========================================*/

// supprime le lien "Modifications rapide" dans les listes de pages et posts

add_filter( 'post_row_actions', 'pc_remove_quick_link', 10, 2 );
add_filter( 'page_row_actions', 'pc_remove_quick_link', 10, 2 );

    function pc_remove_quick_link( $actions ) {
      
        unset( $actions['inline hide-if-no-js'] );
        return $actions;

    }

/*=====  FIN Modification Rapide  ======*/