<?php

/**
 * 
 * Nettoyage wp_head() & wp_footer()
 * 
 */


// si ce n'est pas l'adminstration
if ( !is_admin() ) {

	/*----------  Admin bar  ----------*/
	
	add_filter( 'show_admin_bar', 'pc_remove_admin_bar' );

		function pc_remove_admin_bar() {

			if ( !current_user_can('administrator') ) { return FALSE; }
			else { return TRUE; }

		}


	/*----------  JS embed  ----------*/

	add_action( 'wp_footer', 'pc_remove_wp_embed' );
	
		function pc_remove_wp_embed(){

			if ( !current_user_can('administrator') ) { wp_deregister_script( 'wp-embed' ); }
	
		}
		

	/*----------  Nettoyage des option de wordpress  ----------*/

	remove_action( 'wp_head', 'rel_canonical' ); // lien canonical
	remove_action( 'wp_head', 'wp_resource_hints', 2 ); // lien prefetch

	// flux
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// divers
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );


	/*----------  Suppression des Emoji  ----------*/

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );


    /*----------  CSS Block Editor  ----------*/

    add_action( 'wp_enqueue_scripts', 'pc_remove_block_editor_css', 100 );

        function pc_remove_block_editor_css() {
            wp_dequeue_style( 'wp-block-library' );
        }
        

    /*----------  Tags attributs  ----------*/
    
    add_filter('script_loader_tag', 'pc_remove_tag_js_attribut', 10, 3);

        function pc_remove_tag_js_attribut( $tag, $handle, $src ) {
            $tag = str_replace( "type='text/javascript' ", '', $tag );
            return str_replace( "'", '"', $tag );
        }
 

}