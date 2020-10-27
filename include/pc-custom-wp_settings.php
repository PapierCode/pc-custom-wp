<?php
/**
 *
 * Réglages Papier Codé (page d'administration)
 *
 */


add_action('plugins_loaded', function() { // en attente du plugin [PC] Tools

	/*----------  Valeurs par défaut  ----------*/

	// si l'option n'existe pas
	if ( !get_option( 'pc-settings-option' ) ) {

		$optionsValues = array(
			'tinymce-medias'		=> 1,
			'tinymce-toolbar1'		=> 'fullscreen,undo,redo,removeformat,|,formatselect,bullist,numlist,blockquote,|,bold,italic,strikethrough,superscript,charmap,|,alignleft,aligncenter,|,link,unlink,|,media',
			'tinymce-toolbar2'		=> '',
			'tinymce-block'			=> 'Paragraph=p;Heading 2=h2;Heading 3=h3',

			'help-seo'				=> '<p>Ces deux champs sont utiles au référencement et s\'affichent dans les résultats des moteurs de recherche, par exemple dans Google : le <em>Titre</em> correspond à la ligne de texte bleue, la <em>Description</em> aux 2 lignes en noir en dessous. <br/><strong>Nombre de signes maximum conseillés : respectivement 70 et 200.</strong></p></p>',

			'page-model'			=> 1,
		);

		add_option( 'pc-settings-option', $optionsValues ,'', 'no');

	}


	/*----------  Page d'options  ----------*/

	if ( class_exists('PC_Add_Admin_Page') ) {

		$pc_custom_settings_fields = array(
		    array(
		        'title'     => 'Développement',
		        'id'        => 'dev',
		        'prefix'    => 'dev',
		        'fields'    => array(
		            array(
		                'type'      => 'checkbox',
		                'label_for' => 'class-examples',
		                'label'     => 'Customs exemples'
					)
		        )
		    ),
		    array(
		        'title'     => 'TinyMCE',
		        'id'        => 'tinymce',
		        'desc'      => 'Configuration par défaut.',
		        'prefix'    => 'tinymce',
		        'fields'    => array(
						array(
							'type'      => 'checkbox',
							'label_for' => 'medias',
							'label'     => 'Ajouter des médias'
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
		            )
		        )
		    ),
		    array(
		        'title'     => 'Google',
		        'id'        => 'google',
		        'prefix'    => 'google',
		        'fields'    => array(
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
		        'title'     => 'Matomo',
		        'id'        => 'matomo',
		        'prefix'    => 'matomo',
		        'fields'    => array(
					array(
		                'type'      => 'text',
		                'label_for' => 'analytics-code',
		                'label'     => 'Identifiant pour les statistiques'
		            ),
		        )
		    ),
		    array(
		        'title'     => 'Pages',
		        'id'        => 'page',
		        'prefix'    => 'page',
		        'fields'    => array(
		            array(
		                'type'      => 'checkbox',
		                'label_for' => 'template',
		                'label'     => 'Sélection d\'un modèle'
		            )
		        )
		    ),
		    array(
		        'title'     => 'Help',
		        'id'        => 'help',
		        'prefix'    => 'help',
		        'fields'    => array(
		            array(
		                'type'      => 'textarea',
		                'label_for' => 'seo',
		                'label'     => 'Metaboxe SEO <br/>(compatibilité)',
		        		'css'		=> 'width:100%;'
					),
					array(
		                'type'      => 'checkbox',
		                'label_for' => 'manuals',
						'label'     => 'Guides PDF à télécharger',
		            )
		        )
		    ),
		    array(
				'title'     => 'Actualités (compatibilité)',
		        'id'        => 'news',
		        'prefix'    => 'news',
		        'fields'    => array(
		            array(
		                'type'      => 'checkbox',
		                'label_for' => 'active',
		                'label'     => 'Actualités'
		            ),
		            array(
		                'type'      => 'checkbox',
		                'label_for' => 'tax',
		                'label'     => 'Catégories'
		            )
		        )
		    ),
		    array(
				'title'     => 'SEO',
		        'id'        => 'seo',
		        'prefix'    => 'seo',
		        'fields'    => array(
		            array(
		                'type'      => 'checkbox',
		                'label_for' => 'rewrite-url',
		                'label'     => 'Réécriture des URL'
		            )
		        )
		    ),
		    array(
				'title'     => 'Commentaires',
		        'id'        => 'comments',
		        'prefix'    => 'comments',
		        'fields'    => array(
		            array(
		                'type'      => 'checkbox',
		                'label_for' => 'menu',
		                'label'     => 'Afficher le menu'
		            )
		        )
		    )
		);
		

		/*----------  Filtre  ----------*/

		$pc_custom_settings_fields = apply_filters( 'pc_filter_settings_pc_fields', $pc_custom_settings_fields );


		/*----------  Création de la page  ----------*/
		
		$pc_custom_settings_page = new PC_Add_Admin_Page( 'Papier Codé réglages', '', 'PC Réglages', 'pc-settings', $pc_custom_settings_fields, 'admin', '81', 'dashicons-admin-settings' );


	} // FIN if class_exists('PC_Add_Admin_Page')


}); // FIN add_action(plugins_loaded)
