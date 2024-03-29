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
				'html' => '<p style="margin-top:6px"><strong>Le titre est utilisé pour l\'organisation des médias dans l\'administration.<br/> Le texte alternatif pour le référencement et l\'accessibilité</strong>, décrivez l\'image en quelques mots.<br/><strong>La légende s\'affiche sous l\'image</strong> lorsque celle-ci est insérée dans le contenu d\'une page ou via une galerie.</p>',
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

/*----------  Post list  ----------*/

add_filter( 'manage_media_columns', 'pc_edit_manage_media_columns' );

	function pc_edit_manage_media_columns( $columns ) {
		
		unset( $columns['parent'] );
		unset( $columns['comments'] );
		return $columns;

	}

add_filter( 'media_row_actions', 'pc_edit_media_row_action' );

	function pc_edit_media_row_action( $actions ) {

		unset( $actions['view'] );
		return $actions;

	}