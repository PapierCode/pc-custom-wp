<?php
/**
 * 
 * Gestion des sitemaps par défaut
 * 
 */


/*----------  Type de xml  ----------*/

add_filter( 'wp_sitemaps_add_provider',

	function( $provider, $name ) {

		$to_remove = array( 'users' );
		if ( in_array( $name, $to_remove ) ) { return false; }

		return $provider;

	}, 10, 2 );


/*----------  Type de posts  ----------*/
 
add_filter( 'wp_sitemaps_post_types',

    function( $posts ) {

		unset(
			$posts['post']
		);
		
		return $posts;
		
    }, 10, 2 );


/*----------  Taxonomies  ----------*/

add_filter( 'wp_sitemaps_taxonomies',

    function( $taxonomies ) {

		unset( 
			$taxonomies['category'], 
			$taxonomies['post_tag'],  
			$taxonomies['post_format']
		);
		
		return $taxonomies;
		
    }, 10, 2 );