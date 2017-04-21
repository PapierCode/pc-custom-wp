<?php

/**
*
* Menu de l'administration
*
**/


/*====================================
=            Modifiations            =
====================================*/

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


/*=====  FIN Modifiations  ======*/

/*=======================================
=            Ajout de droits            =
=======================================*/

add_action( 'admin_init', function() {

    // objet role
    $role = get_role( 'editor' );
    // active le menu apparence 
    // !!! valeur enregistrée en bdd, utiliser remove_cap pour inverser
    $role->add_cap( 'edit_theme_options' );

});


/*=====  FIN Ajout de droits  ======*/

/*======================================================================================
=            Metaboxes liées aux Articles dans la page de gestion des menus            =
======================================================================================*/

add_action( 'admin_head-nav-menus.php' , function() {
	
	remove_meta_box( 'add-category' , 'nav-menus' , 'side' );
	remove_meta_box( 'add-post_tag' , 'nav-menus' , 'side' );
	remove_meta_box( 'add-post-type-post' , 'nav-menus' , 'side' );

});


/*=====  FIN Metaboxes liées aux Articles dans la page de gestion des menus  ======*/