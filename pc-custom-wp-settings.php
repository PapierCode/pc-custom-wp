<?php

/**
*
* * Réglages Papier Codé
*
*
**/

// 09/12/16 : ajout config actualités
// 09/12/16 : ajout config attributs page
// 12/10/16 : ajout section formulaire de contact
// 03/10/16 : renommage et déplacement dans le menu
// 14/09/16 : Création

add_action('plugins_loaded', function() { // en attente du plugin [PC] Tools

	/*----------  Valeurs par défaut  ----------*/

	// si l'option n'existe pas
	if ( !get_option( 'pc-settings-option' ) ) {

		$optionsValues = array(
			'tinymce-media'			=> '1',
			'tinymce-quicktags'		=> '1',
			'tinymce-rows'			=> '6',
			'tinymce-toolbar1'		=> 'fullscreen,undo,redo,removeformat,|,formatselect,bullist,numlist,blockquote,|,bold,italic,strikethrough,superscript,charmap,|,alignleft,aligncenter,alignright,outdent,indent,|,link,unlink',
			'tinymce-toolbar2'		=> '',
			'tinymce-block'			=> 'Paragraph=p;Heading 2=h2;Heading 3=h3',
			'tinymce-visualblocks'	=> '1',
			'tinymce-paste'			=> '1',

			'contact-to'			=> 'papiercode@gmail.com',
			'contact-subject'		=> 'Formulaire de contact'
		);

		add_option( 'pc-settings-option', $optionsValues ,'', 'no');

	}


	/*----------  Page d'options  ----------*/

	if ( class_exists('PC_Add_Admin_Page') ) {

		$pcSettingsContent = array(
		    array(
		        'title'     => 'Formulaire de contact',
		        'id'        => 'contact-form',
		        'prefix'    => 'contact',
		        'fields'    => array(
		            array(
		                'type'      => 'text',
		                'label_for' => 'to',
		                'label'     => 'Destinataire',
		                'css'		=> 'width:100%',
		                'help'		=> 'Un ou plusieurs emails séparés par des virgules.'
		            ),
		            array(
		                'type'      => 'text',
		                'label_for' => 'subject',
		                'label'     => 'Sujet',
		                'css'		=> 'width:100%'
		            )
		        )
		    ),
		    array(
		        'title'     => 'TinyMCE',
		        'id'        => 'wp-config-tinymce',
		        'desc'      => 'Configuration par défaut.',
		        'prefix'    => 'tinymce',
		        'fields'    => array(
		            array(
		                'type'      => 'checkbox',
		                'label_for' => 'media',
		                'label'     => 'Ajouter des médias'
		            ),
		            array(
		                'type'      => 'checkbox',
		                'label_for' => 'quicktags',
		                'label'     => 'Mode texte'
		            ),
		            array(
		                'type'      => 'text',
		                'label_for' => 'rows',
		                'label'     => 'Nombre de ligne',
		                'css'       => 'width:5em'
		            ),
		            array(
		                'type'      => 'text',
		                'label_for' => 'toolbar1',
		                'label'     => 'Barre d\'outils 1',
		                'css'       => 'width:100%'
		            ),
		            array(
		                'type'      => 'text',
		                'label_for' => 'toolbar2',
		                'label'     => 'Barre d\'outils 2',
		                'css'       => 'width:100%'
		            ),
		            array(
		                'type'      => 'text',
		                'label_for' => 'block',
		                'label'     => 'Type de blocs',
		                'css'       => 'width:100%'
		            ),
		            array(
		                'type'      => 'checkbox',
		                'label_for' => 'visualblocks',
		                'label'     => 'Afficher les blocs'
		            ),
		            array(
		                'type'      => 'checkbox',
		                'label_for' => 'paste',
		                'label'     => 'Coller comme texte'
		            )
		        )
		    ),
		    array(
		        'title'     => 'Outils Google',
		        'id'        => 'google-tools',
		        'prefix'    => 'google',
		        'fields'    => array(
		            array(
		                'type'      => 'checkbox',
		                'label_for' => 'analytics-active',
		                'label'     => 'Analytics activation'
		            ),
		            array(
		                'type'      => 'text',
		                'label_for' => 'analytics-code',
		                'label'     => 'Analytics code de suivi'
		            ),
		            array(
		                'type'      => 'text',
		                'label_for' => 'recaptcha-site',
		                'label'     => 'reCAPTCHA clé du site',
		                'css'		=> 'width:100%'
		            ),
		            array(
		                'type'      => 'text',
		                'label_for' => 'recaptcha-secret',
		                'label'     => 'reCAPTCHA Clé secrète',
		                'css'		=> 'width:100%'
		            )
		        )
		    ),
		    array(
		        'title'     => 'Pages',
		        'id'        => 'page-config',
		        'prefix'    => 'page',
		        'fields'    => array(
		            array(
		                'type'      => 'checkbox',
		                'label_for' => 'parent',
		                'label'     => 'Sélection d\'un parent'
		            )
		        )
		    )
		);

		// si plugin "[PC] Actualités & Catégories" activé
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( 'pc-news-tax/pc-news-tax.php' ) ) {

			$pcSettingsContent[] = array(
				'title'     => 'Actualités',
		        'id'        => 'news-config',
		        'prefix'    => 'news',
		        'fields'    => array(
		            array(
		                'type'      => 'checkbox',
		                'label_for' => 'tax',
		                'label'     => 'Activer les catégories'
		            )
		        )
			);

		}

		// création de la page
		$pcSettings = new PC_Add_Admin_Page( 'Papier Codé réglages', '', 'PC Réglages', 'pc-settings', $pcSettingsContent, 'admin', '81', 'dashicons-admin-settings' );


	} // FIN if class_exists('PC_Add_Admin_Page')


}); // FIN add_action(plugins_loaded)