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

		$options_values = array(
			'tinymce-medias'		=> 1,
			'tinymce-toolbar1'		=> 'fullscreen,undo,redo,removeformat,|,formatselect,bullist,numlist,blockquote,|,styleselect,bold,italic,strikethrough,superscript,charmap,|,alignleft,aligncenter,|,link,unlink,|,media',
			'tinymce-toolbar2'		=> '',
			'tinymce-block'			=> 'Paragraph=p;Heading 2=h2;Heading 3=h3',

			'help-seo'				=> '<p>Ces deux champs sont utiles au référencement et s\'affichent dans les résultats des moteurs de recherche, par exemple dans Google : le <em>Titre</em> correspond à la ligne de texte bleue, la <em>Description</em> aux 2 lignes en noir en dessous. <br/><strong>Nombre de signes maximum conseillés : respectivement 70 et 200.</strong></p></p>',

			'page-model'			=> 1,
			'hcaptcha-site'			=> '',
			'hcaptcha-secret'			=> '',
		);

		add_option( 'pc-settings-option', $options_values ,'', 'no');

	}


	/*----------  Page d'options  ----------*/

	if ( class_exists('PC_Add_Admin_Page') ) {

		$settings_pc_fields = array(
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
		        'title'     => 'hCaptcha',
		        'id'        => 'hcaptcha',
		        'prefix'    => 'hcaptcha',
		        'fields'    => array(
		            array(
		                'type'      => 'text',
		                'label_for' => 'site',
		                'label'     => 'Clé du site',
		                'css'		=> 'width:100%'
		            ),
		            array(
		                'type'      => 'text',
		                'label_for' => 'secret',
		                'label'     => 'Clé secrète',
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
			),
		    array(
				'title'     => 'WPréformaté',
		        'id'        => 'wpreform',
		        'prefix'    => 'wpreform',
		        'fields'    => array(
		            array(
		                'type'      => 'checkbox',
		                'label_for' => 'fullscreen',
		                'label'     => 'Images associées en pleine page'
					),
		            array(
		                'type'      => 'checkbox',
		                'label_for' => 'breadcrumb',
		                'label' 	=> 'Fil d\'ariane',
					),
		            array(
		                'type'      => 'checkbox',
		                'label_for' => 'search',
		                'label'     => 'Recherche'
		            )
		        )
		    )
		);
		

		/*----------  Filtre  ----------*/

		$settings_pc_fields = apply_filters( 'pc_filter_settings_pc_fields', $settings_pc_fields );


		/*----------  Création de la page  ----------*/
		
		$settings_pc_page = new PC_Add_Admin_Page( 'Papier Codé réglages', '', 'PC Réglages', 'pc-settings', $settings_pc_fields, 'admin', '81', 'dashicons-admin-settings' );


	} // FIN if class_exists('PC_Add_Admin_Page')


}); // FIN add_action(plugins_loaded)
