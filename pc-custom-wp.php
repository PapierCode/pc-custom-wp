<?php
/*
Plugin Name: [PC] Custom WP
Plugin URI: www.papier-code.fr
Description: Customisations admin & public
Version: 1.6.0
Author: Papier Codé
*/


/*----------  Réglages projets  ----------*/

include 'include/pc-custom-wp_settings.php';
$settings_pc = get_option( 'pc-settings-option' );


/*----------  CSS  ----------*/

add_action( 'admin_enqueue_scripts', function() {
	
	$css_admin_path = 'include/pc-custom-wp_style.css';
	wp_enqueue_style( 'pc-custom-wp-css', plugin_dir_url( __FILE__ ).$css_admin_path, null, filemtime(plugin_dir_path( __FILE__ ).$css_admin_path) );

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
// articles
include 'include/pc-custom-wp_posts.php';
// Tiny MCE
include 'include/pc-custom-wp_tinymce.php';
// medias
include 'include/pc-custom-wp_medias.php';
// wp_head public
include 'include/pc-custom-wp_head.php';
// sitemaps par défaut
include 'include/pc-custom-wp_sitemap.php';
// emails
include 'include/pc-custom-wp_mail.php';