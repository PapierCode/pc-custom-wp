<?php

/*
Plugin Name: [PC] Custom WP
Plugin URI: www.papier-code.fr
Description: Customisations admin & public 
Version: 1.001
Author: Papier Codé
*/

/**
*
* * Include
* * Divers
* * Page de connexion
* * Barre d'admin
* * Footer
* * DashBoard
* * Menu admin
* * TinyMCE
* * Widgets par défaut
* * Mise à jour slug à la sauvegarde
*
*
**/

/*===============================
=            Include            =
===============================*/

/*----------  php  ----------*/

include 'pc-custom-wp-page.php';                    // [admin] customisation du module Pages
include 'pc-custom-wp-public.php';                  // [public] customisations publiques (shortcode,...)

include 'pc-custom-wp-settings.php';                // [admin] page d'admin pour de configurations personnalisées de WP (TinyMCE,...)
$pcSettings = get_option( 'pc-settings-option' );   // cf fichier ci-dessus


/*----------  JS & CSS  ----------*/

add_action( 'admin_enqueue_scripts', function($hook) use( $pcSettings ) {

    // scripts pour admin
    wp_enqueue_script( 'custom-wp-scripts', plugin_dir_url( __FILE__ ).'pc-custom-wp-script.js' );
    // css pour admin
    wp_enqueue_style( 'custom-wp-css', plugin_dir_url( __FILE__ ).'pc-custom-wp-style.css' );
    // media uploader
    wp_enqueue_media();


    /*----------  Choix du parent dans les pages  ----------*/
    
    // si l'on peut choisir un parent aux pages
    if( isset($pcSettings['page-parent']) ) {

    	// alerte pour vérifier les attributs de la page (metabox)
    	wp_add_inline_script( 'custom-wp-scripts', 'jQuery(document).ready(function($){var checkParent = false;$(\'#post\').submit(function(event){if(checkParent==false&&$(\'#pageparentdiv\').length>0){event.preventDefault();$(\'#pageparentdiv\').css(\'border-color\',\'red\').prepend(\'<p style="color:white; background-color:red; padding:8px 12px; margin:0">Vérifiez les attributs de la page.</p>\');checkParent = true;}});});' );

   	} else {

   		// masque le champ de sélection de parent
   		wp_add_inline_style( 'custom-wp-css', "#pageparentdiv .inside > :nth-child(-n+2) { display:none; }" );

   	}


});


/*=====  End of Include  ======*/

/*==============================
=            Divers            =
==============================*/

/*----------  masquer les mises à jour pour les non administrateur  ----------*/

add_action( 'admin_head', function() {

	if ( !current_user_can('update_core') ) { remove_action( 'admin_notices', 'update_nag', 3 ); }

}, 1 );


/*----------  mime/types  ----------*/

add_filter('upload_mimes', function($mimes) {

	return $mimes = array (
		'jpg|jpeg' => 'image/jpeg',
		'png' => 'image/png',
		'pdf' => 'application/pdf'
	);

});

/*----------  Désactiver l'éditeur de code  ----------*/

define( 'DISALLOW_FILE_EDIT', true );


/*=====  End of Divers  ======*/

/*=========================================
=            Page de connexion            =
=========================================*/

/*----------  css  ----------*/

add_action('login_head', function() {

	echo '<link rel="stylesheet" type="text/css" href="'.plugin_dir_url( __FILE__ ).'pc-custom-wp-style.css" />';

});


/*----------  logo  ----------*/

// url du lien contenant le logo
add_filter( 'login_headerurl', function( $url ) { 

	return get_bloginfo( 'url' ); 

});

// title du lien contenant le logo
add_filter('login_headertitle', function($message) { 

	return get_bloginfo('name'); 

});


/*=====  End of Page de connexion  ======*/

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


/*=====  End of Barre d'admin  ======*/

/*==============================
=            Footer            =
==============================*/

/*----------  Texte  ----------*/

add_filter( 'admin_footer_text', function() {

	return '';

});


/*----------  cache version WP  ----------*/

add_action( 'admin_menu', function() { 
		
	remove_filter( 'update_footer', 'core_update_footer' );

});


/*=====  End of Footer  ======*/

/*=================================
=            Dashboard            =
=================================*/

/*----------  supprimer l'écran d'acceuil  ----------*/

remove_action( 'welcome_panel', 'wp_welcome_panel' );


/*----------  suppression de widgets  ----------*/

add_action( 'wp_dashboard_setup', function() {

    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   		// Right Now
    remove_meta_box( 'dashboard_quick_press',   'dashboard', 'side' );      // Quick Press widget
    //remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );    // Recent Drafts
    remove_meta_box( 'dashboard_primary',       'dashboard', 'side' );      // WordPress.com Blog
    remove_meta_box( 'dashboard_secondary',     'dashboard', 'side' );      // Other WordPress News
    //remove_meta_box( 'dashboard_incoming_links','dashboard', 'normal' );  // Incoming Links
    remove_meta_box( 'dashboard_plugins',       'dashboard', 'normal' );    // Plugins
    remove_meta_box( 'dashboard_activity',   'dashboard', 'normal' );      	// activity

});


/*----------  Box personnalisée d'accueil  ----------*/

add_action( 'wp_dashboard_setup', function() {

    wp_add_dashboard_widget(
		'welcome',         			// Widget slug.
		'Salutations',         		// Title.
		'welcome_widget_content' 	// Display function.
    );

});

	function welcome_widget_content() {

	    echo 'Bienvenue dans l\'administration du site '.get_bloginfo('name').'.';

	}

/*=====  End of Dashboard  ======*/

/*==================================
=            Menu admin            =
==================================*/

/*----------  simplification pour les non administrateurs  ----------*/

add_action( 'admin_menu', function(){

	global $menu;
	global $submenu;
	// echo '<pre style="margin-left:150px">';
	// print_r($menu);
	// echo '</pre>';
	// return;

	$menu[10][6] = 'dashicons-format-gallery'; // Nouvel icône pour Médias
	$menu[60][0] = 'Composants'; // Apparence devient Composants
	$menu[60][6] = 'dashicons-welcome-widgets-menus'; // Nouvel icon pour Composants

	// pour les utilisateurs non administrateur
    if ( !current_user_can('update_core') ) {

	    remove_menu_page( 'tools.php' ); 	// outils
	    remove_menu_page( 'plugins.php' );	// plugins

	    // voir aussi ci-dessous "ajout de droits aux éditeurs"
        unset($submenu['themes.php'][5]); 	// gestion des thèmes

    }
	
	// tous les utilisateurs
	remove_menu_page( 'edit.php' ); 			// articles
	remove_menu_page( 'edit-comments.php' );	// commentaires
    unset($submenu['upload.php'][5]); 			// sous menu bibliothèque médias
    unset($submenu['upload.php'][10]); 			// sous menu  ajouter médias
    unset($submenu['themes.php'][6]);			// personnaliser le thème

});


/*----------  ajout de droits aux éditeurs  ----------*/

add_action( 'admin_init', function() {

    // objet role
    $role = get_role( 'editor' );
    // active le menu apparence 
    // !!! valeur enregistrée en bdd, utiliser remove_cap pour inverser
    $role->add_cap( 'edit_theme_options' );

});


/*=====  End of Menu admin  ======*/

/*===============================
=            TinyMCE            =
===============================*/

/*----------  plugin TinyMCE pour afficher les blocs dans le contenu  ----------*/

add_filter( 'mce_external_plugins', function( $plugins ) {

    $plugins['visualblocks'] = plugin_dir_url( __FILE__ ).'tinymce/visualblocks/plugin.min.js';
    return $plugins;

});


/*----------  feuille de style  ----------*/

add_action( 'admin_init', function() {

	add_editor_style( plugin_dir_url( __FILE__ ).'pc-custom-wp-style.css' );

});


/*----------  custom functions  ----------*/

add_filter( 'tiny_mce_before_init', function( $settings ) use( $pcSettings ) {

    if ( post_type_supports( get_current_screen()->post_type, 'editor' ) ) {

	    // Debug:
	    // echo '<pre>';
	    // print_r( $settings );
	    // echo '</pre>';
	    // exit();

        // customize the buttons
        $settings['toolbar1']                     = $pcSettings['tinymce-toolbar1'];
        $settings['toolbar2']                     = $pcSettings['tinymce-toolbar2'];
        $settings['block_formats']                = $pcSettings['tinymce-block'];
        $settings['visualblocks_default_state']   = ($pcSettings['tinymce-visualblocks'] == 1 ? true : false);
        $settings['paste_as_text']                = ($pcSettings['tinymce-paste'] == 1 ? true : false);

    }

    return $settings;

});


/*=====  End of TinyMCE  ======*/

/*========================================================
=            Mise à jour slug à la sauvegarde            =
========================================================*/

// https://codex.wordpress.org/Plugin_API/Action_Reference/save_post

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


/*=====  FIN Mise à jour slug à la sauvegarde  ======*/