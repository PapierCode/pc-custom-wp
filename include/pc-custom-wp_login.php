<?php
/**
 *
 * Page de connexion
 *
 */

/*----------  CSS  ----------*/

add_action('login_head', function() {

	echo '<link rel="stylesheet" type="text/css" href="'.plugin_dir_url( __FILE__ ).'pc-custom-wp_style.css" />';

});


/*----------  Logo  ----------*/

// url du lien contenant le logo
add_filter( 'login_headerurl', function( $url ) { 

	return get_bloginfo( 'url' ); 

});

// text du lien contenant le logo
add_filter('login_headertext', function( $message ) { 

	return get_bloginfo('name'); 

});


/*----------  Masquer les erreurs de connexion à l'administration  ----------*/

add_filter( 'login_errors', function () {

	return "L'identifiant ou le mot de passe est incorrect.";

} );