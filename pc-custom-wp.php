<?php
/*
Plugin Name: [PC] Custom WP
Plugin URI: www.papier-code.fr
Description: Customisations admin & public
Version: 1.0.1
Author: Papier Codé
*/


/*----------  Réglages projets  ----------*/

include 'include/pc-custom-wp_settings.php';
$pc_custom_settings = get_option( 'pc-settings-option' );


/*----------  CSS  ----------*/

add_action( 'admin_enqueue_scripts', function() {
	
	wp_enqueue_style( 'pc-custom-wp-css', plugin_dir_url( __FILE__ ).'include/pc-custom-wp_style.css' );

});

add_filter( 'admin_body_class', function( $classes ) use ( $pc_custom_settings ) {

    // pour masquer l'édition du permalien
    if ( !isset( $pc_custom_settings['seo-rewrite-url'] ) ) { $classes .= ' no-url-rewriting'; }

    return $classes;

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


/*----------  Custom Class exemples  ----------*/

add_action('plugins_loaded', function() use ($pc_custom_settings) { // en attente du plugin [PC] Tools

    if ( isset( $pc_custom_settings['dev-class-examples'] ) ) {

        include 'class-examples/ex_add-custom-post.php';
        include 'class-examples/ex_add-metabox.php';
        include 'class-examples/ex_add-field-to-tax.php';
        include 'class-examples/ex_add-custom-admin.php';

    }

});