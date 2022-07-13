<?php
/**
 *
 * Médias
 *
 */


/*----------  Masquer les boutons d'ajout de média  ----------*/

add_filter( 'media_library_show_video_playlist', function () { return false; } );
add_filter( 'media_library_show_audio_playlist', function () { return false; } );


/*----------  Options par défaut  ----------*/

add_action( 'after_setup_theme', function() {
    
    // taille sélectionnée par défaut lors de l'ajout
    update_option( 'image_default_size', 'large' );

});


/*----------  Champs médias  ----------*/

add_filter( 'attachment_fields_to_edit', 'pc_help_img_fields', 10, 2 );

    function pc_help_img_fields( $fields, $post ) {

		if ( str_contains( $post->post_mime_type, 'image' ) ) {

			$fields['pc_help'] = array(
				'label' => 'Aide',
				'input' => 'html',
				'html' => '<p style="margin-top:6px"><strong>Le texte alternatif : </strong>pour le référencement et l\'accessibilité, décrivez l\'image en quelques mots.<br/><strong>La légende</strong>, s\'affiche sous l\'image dans 2 cas :<br/>- dans une galerie d\'images en plein écran,<br/>- lorsque l\'image est insérée dans le contenu de la page.</p>',
				'show_in_edit' => true,
			);

		}

		if ( str_contains( $post->post_mime_type, 'pdf' ) ) {
			
		}

        return $fields;

    }

/*----------  404 pour les pages de médias  ----------*/

add_action( 'wp', 'pc_no_attachment_page' );

	function pc_no_attachment_page() {

		if ( is_attachment() ) {

			global $wp_query;
   			$wp_query->set_404();

		}

	}