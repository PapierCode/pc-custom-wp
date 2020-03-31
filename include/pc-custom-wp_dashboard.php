<?php
/**
 * 
 * Widgets du tableau de bord
 * 
 ** Suppressions
 ** Ajout "Bienvenue"
 *  
 */


/*====================================
=            Suppressions            =
====================================*/

add_action( 'wp_dashboard_setup', function() use($pc_custom_settings) {

    // wordpress
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );   		// Right Now
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );        // Quick Press widget
    remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );      // Recent Drafts
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );            // WordPress.com Blog
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );          // Other WordPress News
    remove_meta_box( 'dashboard_incoming_links','dashboard', 'normal' );    // Incoming Links
    remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );          // Plugins
    if ( !isset($pc_custom_settings['comments-menu']) ) {
        remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );     // activity
    }

    // plugins
    remove_meta_box( 'tinypng_dashboard_widget', 'dashboard', 'normal' );   // TinyPng

});


/*=====  FIN Suppressions  =====*/

/*==========================================
=            Widget "Bienvenue"            =
==========================================*/

add_action( 'wp_dashboard_setup', function() {

    wp_add_dashboard_widget(
		'welcome',         			// Widget slug.
		'Salutations',         		// Title.
		'welcome_widget_content' 	// Display function.
    );

});

	function welcome_widget_content() {

        echo '<p>Bienvenue dans l\'administration du site <strong>'.get_bloginfo('name').'</strong>.</p>';
        
        global $pc_custom_settings;
        if ( isset($pc_custom_settings['help-manuals']) ) {
            echo '<div class="welcome-manuals"><p>Documentation à télécharger :</p>';
            echo '<ul>';
            echo '<li><a href="'.plugin_dir_url( __FILE__ ).'files/papier-code-wp-manuel.pdf'.'" target="_blank">Manuel d\'utilisation de l\'administration</a></li>';
            echo '<li><a href="'.plugin_dir_url( __FILE__ ).'files/papier-code-ecrire-pour-le-web.pdf'.'" target="_blank">Guide pour la rédaction et le référencement</a></li>';
            echo '</ul></div>';
        }

	}


/*=====  FIN Widget "Bienvenue"  =====*/