<?php
/**
 *
 * Tiny MCE
 *
 */


/*----------  Plugins  ----------*/

add_filter( 'mce_external_plugins', function( $plugins ) {

    // afficher les blocs
    $plugins['visualblocks'] = plugin_dir_url( __FILE__ ).'tinymce/visualblocks/plugin.min.js';
    // ajouter une ancre
    $plugins['pcanchor'] = plugin_dir_url( __FILE__ ).'tinymce/pc-plugin_anchor/pc-plugin_anchor.js';
    // ajouter une vidéo
    $plugins['pcembed'] = plugin_dir_url( __FILE__ ).'tinymce/media/plugin.min.js';

    return $plugins;

});


/*----------  Feuille de style  ----------*/

add_action( 'admin_init', function() {

    add_editor_style( plugin_dir_url( __FILE__ ).'pc-custom-wp_style.css' );

});


/*----------  Bouton Medias  ----------*/

if ( !isset( $settings_pc['tinymce-medias'] ) ) {

   add_action('admin_head', function() { remove_action( 'media_buttons', 'media_buttons' ); });

}


/*----------  Configuration par défaut  ----------*/

add_filter( 'tiny_mce_before_init', function( $settings ) use( $settings_pc ) {

    if ( $settings['selector'] == '#content') {

        // contenu des barres d'outils
        $settings['toolbar1']                     = $settings_pc['tinymce-toolbar1'];
        $settings['toolbar2']                     = $settings_pc['tinymce-toolbar2'];
        // menu type de block
        $settings['block_formats']                = $settings_pc['tinymce-block'];
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


/*----------  Onglet texte seulement pour les administrateurs  ----------*/

add_filter( 'wp_editor_settings', function ($settings) {

    if ( !current_user_can('administrator') ) { $settings['quicktags'] = false; }

    return $settings;

} );
