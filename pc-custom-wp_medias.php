<?php
/**
 *
 * Médias
 *
 */


/*----------  Masquer les les boutons d'ajout de média  ----------*/

add_filter( 'media_library_show_video_playlist', function () { return false; } );
add_filter( 'media_library_show_audio_playlist', function () { return false; } );


/*----------  Options par défaut  ----------*/

add_action( 'after_setup_theme', function() {
    
    // taille sélectionnée par défaut lors de l'ajout
    update_option( 'image_default_size', 'large' );

});

/*----------  Aidee pour les champs d'images  ----------*/

add_filter( 'attachment_fields_to_edit', 'pc_help_img_fields', 10, 2 );

    function pc_help_img_fields( $fields, $post ) {

        $fields['partner_url'] = array(
            'label' => 'Aide',
            'input' => 'html',
            'html' => '<p style="margin-top:6px"><strong>Le texte alternatif : </strong>pour le référencement et l\'accessibilité, décrivez l\'image en quelques mots.<br/><strong>La légende</strong>, s\'affiche sous l\'image dans 2 cas :<br/>- dans une galerie d\'images en plein écran,<br/>- lorsque l\'image est insérée dans le contenu de la page.</p>',
            'show_in_edit' => true,
        );
        return $fields;

    }