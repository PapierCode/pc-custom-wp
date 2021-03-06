<?php

/**
*
* [PC] Tools : exemple de création de metabox avec des champs
*
*
*/

// si la class est disponible
if ( class_exists('PC_Add_Metabox') ) {

/*----------  Contenu  ----------*/

// pour le champ de type wysiwig
// cf. page 'PC réglages' généré par le widget '[PC] Custom WP'
$tinymceDefault = get_option( 'pc-settings-option' );

// contenu de la metabox
$customMetaboxAContent = array(	    
    'desc'      => '<p>Un contenu HTML libre.</p>',
    'prefix'    => 'prefix',                                // obligatoire
    'fields'    => array(
        array(
            'type'      => 'url',                           // obligatoire
            'id'        => 'input-link',                    // obligatoire
            'label'     => 'Custom url',                    // obligatoire
            'desc'      => 'Aide ou description du champ',
            'clean'     => true,
            'required'  => false
        ),
        array(
            'type'      => 'text',                          // ou number, ou email, obligatoire
            'id'        => 'input-txt',                     // obligatoire
            'label'     => 'Custom input txt',              // obligatoire
            'desc'      => 'Aide ou description du champ',
            'attr'      => 'class="" data-attr=""',
            'css'       => 'width:100%;',
            'clean'     => true,
            'required'  => false
        ),
        array(
            'type'      => 'textarea',                      // obligatoire
            'id'        => 'textarea',                      // obligatoire
            'label'     => 'Custom textarea',               // obligatoire
            'desc'      => 'Aide ou description du champ',
            'attr'      => 'class="" data-attr=""',
            'css'       => 'width:100%;',
            'clean'     => true,
            'required'  => false
        ),
        array(
            'type'      => 'checkbox',                      // obligatoire
            'id'        => 'checkbox',                      // obligatoire
            'label'     => 'Custom checkbox',               // obligatoire
            'desc'      => 'Aide ou description du champ',
            'attr'      => 'class="" data-attr=""'
        ),
        array(
            'type'      => 'radio',                         // obligatoire
            'id'        => 'radio',                         // obligatoire
            'label'     => 'Custom radio',                  // obligatoire
            'desc'      => 'Aide ou description du champ',
            'attr'      => 'class="" data-attr=""',
            'css'       => '',
            'required'  => false,
            'options'   => array(                           // obligatoire
                'Valeur A' => 'a',
                'Valeur B' => 'b',
                'Valeur C' => 'c'
            )
        ),
        array(
            'type'      => 'checkboxes',                    // obligatoire
            'id'        => 'checkboxes',                    // obligatoire
            'label'     => 'Custom checkboxes',                  // obligatoire
            'desc'      => 'Aide ou description du champ',
            'attr'      => 'class="" data-attr=""',
            'css'       => '',
            'required'  => false,
            'options'   => array(                           // obligatoire
                'Valeur A' => 'a',
                'Valeur B' => 'b',
                'Valeur C' => 'c'
            )
        ),
        array(
            'type'      => 'select',                        // obligatoire
            'id'        => 'select',                        // obligatoire
            'label'     => 'Custom select',                 // obligatoire
            'desc'      => 'Aide ou description du champ',
            'attr'      => 'class="" data-attr=""',
            'css'       => '',
            'required'  => false,
            'options'   => array(                           // obligatoire
                'Valeur A' => 'a',
                'Valeur B' => 'b',
                'Valeur C' => 'c'
            )
        )
    )
);

$customMetaboxBContent = array(     
    'desc'      => '<p>Un contenu HTML libre.</p>',
    'prefix'    => 'prefix',                                // obligatoire
    'fields'    => array(
        array(
            'type'      => 'img',                           // obligatoire
            'id'        => 'img',                           // obligatoire
            'label'     => 'Custom image',                  // obligatoire
            'desc'      => 'Aide ou description du champ',
            'options'   => array(                           // obligatoire
                'btnremove' => true
            )
        ),
        array(
            'type'      => 'pdf',                           // obligatoire
            'id'        => 'pdf',                           // obligatoire
            'label'     => 'Custom pdf',                    // obligatoire
            'desc'      => 'Aide ou description du champ',
            'options'   => array(                           // obligatoire
                'btnremove' => true
            )
        ),
        array(
            'type'      => 'gallery',                       // obligatoire
            'id'        => 'gallery',                       // obligatoire
            'label'     => 'Custom gallerie',               // obligatoire
            'desc'      => 'Aide ou description du champ',
            'options'   => array(                           // obligatoire
                'btnremove' => true
            )
        ),
        array(
            'type'      => 'date',                          // obligatoire
            'id'        => 'date',                          // obligatoire
            'label'     => 'Custom date',                   // obligatoire
            'desc'      => 'Aide ou description du champ',
            'required'  => false
        ),
        array(
            'type'      => 'wysiwyg',                       // obligatoire
            'id' 		=> 'wysiwyg',                       // obligatoire
            'label'     => 'Custom wysiwyg',                // obligatoire
            'desc'      => 'Aide ou description du champ',
            'default'   => '' // contenu par défaut
            /* 'options'   => array( // cf. plugins/pc-custom-wp/pc-custom-wp_settings
                'media_buttons'                     => '', // true/false
                'quicktags'                         => '', // true/false
                'textarea_rows'                     => '', // number
                'tinymce'                           => array (
                    'toolbar1'                          => '', // liste des boutons séparés par une virgule
                    'toolbar2'                          => '', // liste des boutons séparés par une virgule
                    'block_formats'                     => '', // liste des élements de type bloc à afficher dans le select "Formats"
                    'visualblocks_default_state'        => '', // true/false
                    'paste_as_text'                     => '' // true/false
                )
            ) */
        )
    )
);


/*----------  Création  ----------*/

// cf. https://developer.wordpress.org/reference/functions/add_meta_box/

$customMetaboxA = new PC_Add_Metabox(
    array( 'custompost' ), // obligatoire, posts concernés
    'Custom Metabox A',      // obligatoire, titre
    'custom-metabox-a',      // obligatoire, id
    $customMetaboxAContent  // obligatoire, contenu
);

$customMetaboxB = new PC_Add_Metabox(
	array( 'custompost' ), // obligatoire, posts concernés
	'Custom Metabox B',      // obligatoire, titre
	'custom-metabox-b',      // obligatoire, id
	$customMetaboxBContent  // obligatoire, contenu
);


} // FIN if class_exists