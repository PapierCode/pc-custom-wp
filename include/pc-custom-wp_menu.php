<?php
/**
 *
 * Menu de l'administration 
 * Gestionnaire de navigation
 *
 */

/*===========================================
=            Menu administration            =
===========================================*/

add_action( 'admin_menu', 'pc_admin_menu', 999 );

	function pc_admin_menu() {

		global $menu, $submenu, $pc_custom_settings;

		/*----------  Pour les utilisateurs non administrateur  ----------*/

		if ( !current_user_can('update_core') ) {

			remove_menu_page( 'tools.php' ); 	// menu Outils
			remove_menu_page( 'themes.php' );	// menu Apparence
			remove_menu_page( 'wppusher' );		// menu Wppusher

			remove_submenu_page('upload.php', 'tiny-bulk-optimization'); // sous-menu Tinypng

		}


		/*----------  Tous les utilisateurs  ----------*/

		remove_menu_page( 'edit.php' ); 						// menu Articles
		remove_submenu_page('upload.php', 'media-new.php');		// sous-menu Ajouter un média
		unset($submenu['themes.php'][6]);						// sous-menu Personnaliser
		unset($submenu['themes.php'][10]);						// sous-menu Menus

		// en option la page Commentaires
		if ( !isset($pc_custom_settings['comments-menu']) ) { remove_menu_page( 'edit-comments.php' ); }

		// déplace l'accès aux menus
		$menu[31] = array(
			'Menus',				// Nom
			'edit_pages',			// droits
			'nav-menus.php',		// cible
			'',						// ??
			'menu-top menu-nav',	// classes CSS
			'menu-nav',				// id CSS
			'dashicons-menu'		// icône
		);

		// nouvel icône pour Médias
		$menu[10][6] = 'dashicons-format-gallery';

	};


/*----------  Ajout de droits  ----------*/

add_action( 'admin_init', 'pc_admin_menu_capabilities', 999 );

	function pc_admin_menu_capabilities() {
		
		// active le menu apparence pour l'accès aux menus
		$role = get_role( 'editor' );
		$role->add_cap( 'edit_theme_options' );

	};


/*=====  FIN Menu administration  =====*/

/*==================================================
=            Gestionnaire de navigation            =
==================================================*/

/*----------  Suppressions de metaboxes  ----------*/

add_action( 'admin_head-nav-menus.php' , function() {

	// metaboxes liées aux articles par défaut
	remove_meta_box( 'add-category' , 'nav-menus' , 'side' );
	remove_meta_box( 'add-post_tag' , 'nav-menus' , 'side' );
	remove_meta_box( 'add-post-type-post' , 'nav-menus' , 'side' );

});


/*=====  FIN Gestionnaire de navigation  =====*/