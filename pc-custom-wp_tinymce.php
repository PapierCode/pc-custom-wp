<?php

/**
*
* Tiny MCE
*
**/


/*===============================
=            TinyMCE            =
===============================*/

/*----------  Plugin TinyMCE pour afficher les blocs dans le contenu  ----------*/

add_filter( 'mce_external_plugins', function( $plugins ) {

    $plugins['visualblocks'] = plugin_dir_url( __FILE__ ).'tinymce/visualblocks/plugin.min.js';
    $plugins['pcanchor'] = plugin_dir_url( __FILE__ ).'tinymce/pc-plugin_anchor/pc-plugin_anchor.js';
    $plugins['pcembed'] = plugin_dir_url( __FILE__ ).'tinymce/media/plugin.min.js';
    return $plugins;

});


/*----------  Feuille de style  ----------*/

add_action( 'admin_init', function() {

    add_editor_style( plugin_dir_url( __FILE__ ).'pc-custom-wp_style.css' );

});


/*----------  Défaut  ----------*/

add_filter( 'tiny_mce_before_init', function( $settings ) use( $pcSettings ) {

    if ( $settings['selector'] == '#content') {
        
        // Debug:
        // pc_var( $settings, true );
        // exit();

        // contenu des barres d'outils
        $settings['toolbar1']                     = $pcSettings['tinymce-toolbar1'];
        $settings['toolbar2']                     = $pcSettings['tinymce-toolbar2'];
        // menu type de block
        $settings['block_formats']                = $pcSettings['tinymce-block'];
        // plugin visual block activation
        $settings['visualblocks_default_state']   = true;
        // copier comme texte activation
        $settings['paste_as_text']                = true;
        // options plugin media
        $settings['media_alt_source']             = false;
        $settings['media_poster']                 = false;

    }

    return $settings;

});

// onglet texte seulement pour les administrateurs

add_filter('wp_editor_settings', function ($settings) {

    if ( current_user_can('editor') ) { $settings['quicktags'] = false; }

    return $settings;

});


/*=====  FIN TinyMCE  ======*/