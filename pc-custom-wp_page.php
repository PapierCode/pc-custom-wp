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


add_action( 'admin_menu', function () use($pcSettings) {
        
    if ( !isset($pcSettings['seo-rewrite-url']) ) {
        remove_meta_box( 'slugdiv', array('page'), 'normal' );      // identifiant   
    }
    remove_meta_box( 'pageparentdiv', array('page'), 'normal' );    // attributs   

});


/*=====  FIN Suppression de fonctions  ======*/

/*=========================================
=            Attributs de page            =
=========================================*/

// si activée, remplace la metabox par défaut
// cf. pc-custom-wp_script.js (alerte "Vérifiez les attributs de la page")
// cf. pc-custom-wp.php (ajout d'une class css sur el body)

if ( isset($pcSettings['page-model']) ) {

    add_action( 'admin_init', function() {

        add_meta_box(                   
            'pc-page-attributs',
            'Attributs de la page',
            'pc_page_metabox_attributes',
            'page',
            'side',
            'low'
        );

    } );

    function pc_page_metabox_attributes($post, $datas) {

        // ID page courante
        $currentId = $post->ID;

        /*----------  Parent  ----------*/

        // if( wp_count_posts('page')->publish > 1 ) {
            
        //     $currentParent = wp_get_post_parent_id($currentId);
        //     echo '<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="parent_id">Parent</label></p>';
        //     wp_dropdown_pages(array(
        //         'name'                  => 'parent_id',
        //         'id'                    => 'parent_id',
        //         'show_option_none'      => '(pas de parent)',
        //         'show_option_value'     => '',
        //         'exclude_tree'          => $currentId,
        //         'selected'              => $currentParent
        //     ));

        // }


        /*----------  Modèle de page  ----------*/

        $currentTemplate = get_page_template_slug($currentId);
        $allTemplates = get_page_templates();
        ksort($allTemplates);
        
        echo '<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="page_template">Modèle</label></p>';
        echo '<select name="page_template" id="page_template"><option value="default">Modèle par défaut</option>';
        foreach ($allTemplates as $name => $file) {
            echo '<option value="'.$file.'"'.selected($currentTemplate,$file,false).'>'.$name.'</option>';
        }
        echo '</select>';

    }

} // FIN if $pcSettings['page-model']


/*=====  FIN Attributs de page  ======*/