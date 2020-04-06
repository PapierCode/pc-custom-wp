<?php
/**
 * 
 * Nettoyage wp_head() & wp_footer()
 * 
 */


/*=============================
=            Admin            =
=============================*/

if ( is_admin() ) {

	/*----------  Suppression des Emoji  ----------*/
	
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script', 10 ); // admin
	remove_action( 'admin_print_styles', 'print_emoji_styles', 10 ); // admin


/*=====  FIN Admin  =====*/

/*==============================
=            Public            =
==============================*/

} else {

	/*----------  Admin bar  ----------*/
	
	add_filter( 'show_admin_bar', 'pc_remove_admin_bar' );

		function pc_remove_admin_bar() {

			if ( !current_user_can('administrator') ) { return FALSE; }
			else { return TRUE; }

		}


	/*----------  JS embed  ----------*/

	add_action( 'wp_head', 'pc_remove_wp_embed', 20 );
	
		function pc_remove_wp_embed(){

			if ( !current_user_can('administrator') ) {
				
				wp_deregister_script( 'wp-embed' );
				wp_dequeue_script( 'wp-embed' );
			
			}
	
		}


	/*----------  Nettoyage des option de wordpress  ----------*/

	remove_action( 'wp_head', 'rel_canonical', 10 ); // lien canonical
	remove_action( 'wp_head', 'wp_resource_hints', 2 ); // lien prefetch

	// flux
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'rsd_link', 10 );
	remove_action( 'wp_head', 'wlwmanifest_link', 10 );

	// divers
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 ); // link prev/next


	/*----------  Suppression des Emoji  ----------*/

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles', 10 );


    /*----------  CSS Block Editor  ----------*/

    remove_action( 'wp_enqueue_scripts', 'wp_common_block_scripts_and_styles', 10 );
        

    /*----------  Tags attributs  ----------*/
    
    add_filter('script_loader_tag', 'pc_remove_tag_js_attribut', 10, 3);

        function pc_remove_tag_js_attribut( $tag, $handle, $src ) {
            $tag = str_replace( "type='text/javascript' ", '', $tag );
            return str_replace( "'", '"', $tag );
        }

}

/*=====  FIN Public  =====*/