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

		// pc_display_var($wp_admin_bar);
		// return;

	    $wp_admin_bar->remove_node( 'wp-logo' ); // logo WP
	    $wp_admin_bar->remove_node( 'comments' ); // commentaires en attente
	    $wp_admin_bar->remove_node( 'new-content' ); // créer
	    $wp_admin_bar->remove_node( 'view' ); // créer
	    $wp_admin_bar->remove_node( 'archive' ); // voir post

	}


/*----------  Masquer l'onget d'aide  ----------*/

add_action( 'admin_head', function() { get_current_screen()->remove_help_tabs(); });


/*----------  Masquer la version de wordpress  ----------*/

remove_action( 'wp_head', 'wp_generator' );


/*----------  Masquer les mises à jour pour les non administrateur  ----------*/

add_action( 'admin_head', function() {

	if ( !current_user_can( 'update_core' ) ) { remove_action( 'admin_notices', 'update_nag', 3 ); }

}, 1 );


/*----------  Désactiver l'éditeur de code  ----------*/

define( 'DISALLOW_FILE_EDIT', true );


/*----------  Masquer le lien "Modifications rapide" dans les listes de pages et posts  ----------*/

add_filter( 'post_row_actions', 'pc_remove_quick_link', 10, 2 );
add_filter( 'page_row_actions', 'pc_remove_quick_link', 10, 2 );

    function pc_remove_quick_link( $actions ) {

        unset( $actions['inline hide-if-no-js'] );
        return $actions;

    }

    
/*----------  Désactiver la mention en pied de apge  ----------*/

add_filter( 'admin_footer_text', function() {

	return '';

});


/*----------  Masquer la version de WP  ----------*/

add_action( 'admin_menu', function() {

	remove_filter( 'update_footer', 'core_update_footer' );

});