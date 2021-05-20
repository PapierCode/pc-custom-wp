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

		global $menu, $submenu, $settings_pc;


		/*----------  Pour les utilisateurs non administrateur  ----------*/

		if ( !current_user_can( 'administrator' ) ) {

			// Outils
			remove_menu_page( 'tools.php' );

		}


		/*----------  Tous les utilisateurs  ----------*/

		// Articles
		remove_menu_page( 'edit.php' ); 

		// Apparence	
		remove_menu_page( 'themes.php' );
		foreach ( $submenu['themes.php'] as $key => $submenu_item ) {
			if ( 'themes.php' != $submenu_item[2] ) { unset( $submenu['themes.php'][$key] ); }
		}

		// Commentaires
		if ( !isset($settings_pc['comments-menu']) ) { remove_menu_page( 'edit-comments.php' ); }

		// Médias, sous-menu Ajouter
		remove_submenu_page('upload.php', 'media-new.php');
		// Médias, icône
		$menu[10][6] = 'dashicons-format-gallery';

		// déplace l'item menus
		$menu[60] = array(
			'Menus',				// Nom
			'edit_pages',			// droits
			'nav-menus.php',		// cible
			'',						// ??
			'menu-top menu-nav',	// classes CSS
			'menu-nav',				// id CSS
			'dashicons-menu'		// icône
		);
		// déplace l'item thèmes
		$menu[82] = array(
			'Thèmes',				// Nom
			'switch_themes',		// droits
			'themes.php',			// cible
			'',						// ??
			'menu-top',				// classes CSS
			'menu-themes',			// id CSS
			'dashicons-art'			// icône
		);
		
	}


/*----------  Ajout de droits  ----------*/

add_action( 'admin_init', 'pc_admin_menu_capabilities', 999 );

	function pc_admin_menu_capabilities() {
		
		// active le menu apparence pour l'accès aux menus
		$editor = get_role( 'editor' );
		$editor->add_cap( 'edit_theme_options' );

	}


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