<?php

/**
*
* Tableau de bord
*
**/


/*=======================================
=            Écran d'accueil            =
=======================================*/

remove_action( 'welcome_panel', 'wp_welcome_panel' );


/*=====  FIN Écran d'accueil  ======*/

/*===============================
=            Widgets            =
===============================*/

/*----------  Suppressions  ----------*/

add_action( 'wp_dashboard_setup', function() {

    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   		// Right Now
    remove_meta_box( 'dashboard_quick_press',   'dashboard', 'side' );      // Quick Press widget
    //remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );    // Recent Drafts
    remove_meta_box( 'dashboard_primary',       'dashboard', 'side' );      // WordPress.com Blog
    remove_meta_box( 'dashboard_secondary',     'dashboard', 'side' );      // Other WordPress News
    //remove_meta_box( 'dashboard_incoming_links','dashboard', 'normal' );  // Incoming Links
    remove_meta_box( 'dashboard_plugins',       'dashboard', 'normal' );    // Plugins
    remove_meta_box( 'dashboard_activity',   'dashboard', 'normal' );      	// activity

});


/*----------  Widget "Bienvenue"  ----------*/

add_action( 'wp_dashboard_setup', function() {

    wp_add_dashboard_widget(
		'welcome',         			// Widget slug.
		'Salutations',         		// Title.
		'welcome_widget_content' 	// Display function.
    );

});

	function welcome_widget_content() {

	    echo 'Bienvenue dans l\'administration du site '.get_bloginfo('name').'.';

	}

/*=====  FIN of Widgets  ======*/