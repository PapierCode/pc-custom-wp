<?php
/**
 *
 * Modification des pages
 * 
 ** Suppressions de fonctions
 ** Attributs de page
 *
 */


/*================================================
=            Suppression de fonctions            =
================================================*/

add_action( 'init', function() {
		
	remove_post_type_support( 'page', 'comments' ); 			// commentaires		
	remove_post_type_support( 'page', 'custom-fields' );		// champs personnalisés	
    remove_post_type_support( 'page', 'trackbacks' );           // rétroliens

});


add_action( 'admin_menu', function () use($pc_custom_settings) {
        
    if ( !isset($pc_custom_settings['seo-rewrite-url']) ) {
        remove_meta_box( 'slugdiv', array('page'), 'normal' );      // identifiant   
    }
    remove_meta_box( 'pageparentdiv', array('page'), 'normal' );    // attributs   

});


/*=====  FIN Suppression de fonctions  ======*/

/*=============================================
=            Sélection d'un modèle            =
=============================================*/

if ( isset($pc_custom_settings['page-template']) ) {

    add_action( 'admin_init', function() {

        add_meta_box(                   
            'pc-page-template',
            'Modèle de la page',
            'pc_page_metabox_template',
            'page',
            'side',
            'low'
        );

    } );

    function pc_page_metabox_template($post, $datas) {

        $currentTemplate = get_page_template_slug( $post->ID );
        $allTemplates = get_page_templates();
        ksort($allTemplates);
        
        echo '<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="page_template">Modèle</label></p>';
        echo '<select name="page_template" id="page_template"><option value="default">Modèle par défaut</option>';
        foreach ($allTemplates as $name => $file) {
            echo '<option value="'.$file.'"'.selected($currentTemplate,$file,false).'>'.$name.'</option>';
        }
        echo '</select>';

    }

} // FIN if $pc_custom_settings['page-model']


/*=====  FIN Sélection d'un modèle  ======*/