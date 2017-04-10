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


/*----------  Boutons personnalisés  ----------*/

add_filter( 'tiny_mce_before_init', function( $settings ) use( $pcSettings ) {

    if ( post_type_supports( get_current_screen()->post_type, 'editor' ) ) {
        
        // Debug:
        // pc_var( $settings, true );
        // exit();

        // contenu des barres d'outils
        $settings['toolbar1']                     = $pcSettings['tinymce-toolbar1'];
        $settings['toolbar2']                     = $pcSettings['tinymce-toolbar2'];
        // menu type de block
        $settings['block_formats']                = $pcSettings['tinymce-block'];
        // plugin visual block activation
        $settings['visualblocks_default_state']   = ($pcSettings['tinymce-visualblocks'] == 1 ? true : false);
        // copier comme texte activation
        $settings['paste_as_text']                = ($pcSettings['tinymce-paste'] == 1 ? true : false);
        // options plugin media
        $settings['media_alt_source']             = false;
        $settings['media_poster']                 = false;

    }

    return $settings;

});


/*=====  FIN TinyMCE  ======*/