<?php

/**
*
* * Suppressions de fonctions
* * SEO
*
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


add_action( 'admin_menu', function () {
        
    remove_meta_box( 'slugdiv', array('page'), 'normal' );      // identifiant      

});


/*=====  End of Suppression de fonctions  ======*/

/*===========================
=            SEO            =
===========================*/

add_action('plugins_loaded', function() {

    if ( class_exists('PC_Add_metabox') ) {

        $pageMetaboxSeoContent = array(
            'desc'          => pc_txt('seoIntro'),
            'prefix'        => 'seo',
            'fields'        => array(
                array(
                    'type'  => 'text',
                    'label' => 'Titre',
                    'desc'  => '',
                    'id'    => 'meta-title',
                    'attr'  => '',
                    'css'   => 'width:100%'
                ),
                array(
                    'type'  => 'textarea',
                    'label' => 'Description',
                    'desc'  => '',
                    'id'    => 'meta-desc',
                    'attr'  => '',
                    'css'   => 'width:100%'
                )
            )
        );

        $pageMetaboxSeo = new PC_Add_Metabox( array('page'), 'Référencement', 'page-metabox-seo', $pageMetaboxSeoContent, 'normal', 'low' );

    }

})


/*=====  FIN SEO  ======*/

?>