<?php
/**
 * 
 * Diverses modification de l'admin
 * 
 */


/*----------  Masquer l'écran d'accueil  ----------*/

remove_action( 'welcome_panel', 'wp_welcome_panel' );


/*----------  Simplication de la barre d'admin  ----------*/

add_action( 'admin_bar_menu', 'pc_remove_adminbar_items', 999 );

	function pc_remove_adminbar_items( $wp_admin_bar ) {

	    $wp_admin_bar->remove_node( 'wp-logo' ); // logo WP
	    $wp_admin_bar->remove_node( 'comments' ); // commentaires en attente
	    $wp_admin_bar->remove_node( 'new-content' ); // créer
	    $wp_admin_bar->remove_node( 'view' ); // créer
	    $wp_admin_bar->remove_node( 'archive' ); // voir post
	    $wp_admin_bar->remove_node( 'customize' ); // voir post
	    $wp_admin_bar->remove_node( 'woocommerce-site-visibility-badge' ); // woo

	}


/*----------  Masquer l'onget d'aide  ----------*/

add_action( 'admin_head', function() { get_current_screen()->remove_help_tabs(); });


/*----------  Masquer la version de wordpress  ----------*/

remove_action( 'wp_head', 'wp_generator' );


/*----------  Masquer les mises à jour pour les non administrateur  ----------*/

add_action( 'admin_head', function() {

	if ( !current_user_can( 'administrator' ) ) { remove_action( 'admin_notices', 'update_nag', 3 ); }

}, 1 );


/*----------  Désactiver l'éditeur de code  ----------*/

define( 'DISALLOW_FILE_EDIT', true );

    
/*----------  Désactiver la mention en pied de apge  ----------*/

add_filter( 'admin_footer_text', function() {

	return '';

});


/*----------  Masquer la version de WP  ----------*/

add_action( 'admin_menu', function() {

	remove_filter( 'update_footer', 'core_update_footer' );

});


/*----------  Désactive les mots de passe d'application (profil)  ----------*/

add_filter( 'wp_is_application_passwords_available', '__return_false' );