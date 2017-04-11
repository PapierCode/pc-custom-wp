<?php

/**
*
* Suppressions de fonctions
* Attributs de page
* SEO
*
**/


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

// Remplace la metabox par défaut

add_action( 'admin_init', function() use($pcSettings) {

    add_meta_box(                   
        'pc-page-attributs',
        'Attributs de la page',
        'pc_metabox_attributes',
        'page',
        'side',
        'low',
        $pcSettings
    );

} );

function pc_metabox_attributes($post, $datas) {

    // ID page courante
    $currentId = $post->ID;

    /*----------  Parent  ----------*/

    if( isset($datas['args']['page-parent']) ) {
        
        $currentParent = wp_get_post_parent_id($currentId);
        echo '<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="parent_id">Parent</label></p>';
        wp_dropdown_pages(array(
            'name'                  => 'parent_id',
            'id'                    => 'parent_id',
            'show_option_none'      => '(pas de parent)',
            'show_option_value'     => '',
            'exclude_tree'          => $currentId,
            'selected'              => $currentParent
        ));

    }


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


/*=====  FIN Attributs de page  ======*/

/*===========================
=            SEO            =
===========================*/

add_action('plugins_loaded', function() use($pcSettings) {

    if ( class_exists('PC_Add_metabox') ) {

        $pageMetaboxSeoContent = array(
            'desc'          => $pcSettings['help-seo'],
            'prefix'        => 'seo',
            'fields'        => array(
                array(
                    'type'  => 'text',
                    'label' => 'Titre',
                    'desc'  => '',
                    'id'    => 'meta-title',
                    'attr'  => 'class="pc-counter" data-counter-max="70"',
                    'css'   => 'width:100%'
                ),
                array(
                    'type'  => 'textarea',
                    'label' => 'Description',
                    'desc'  => '',
                    'id'    => 'meta-desc',
                    'attr'  => 'class="pc-counter" data-counter-max="200"',
                    'css'   => 'width:100%'
                )
            )
        );

        $pageMetaboxSeo = new PC_Add_Metabox( array('page'), 'Référencement', 'page-metabox-seo', $pageMetaboxSeoContent, 'normal', 'low' );

    }

});

/*=====  FIN SEO  ======*/