<?php
/**
 *
 * Page et post en général
 * 
 ** Page
 ** Enregistrement sans titre
 ** Options de liste
 *
 */


/*============================
=            Page            =
============================*/
 
/*----------  Suppression de fonctions  ----------*/

add_action( 'init', function() {
		
	remove_post_type_support( 'page', 'comments' ); 			// commentaires		
	remove_post_type_support( 'page', 'custom-fields' );		// champs personnalisés	
	remove_post_type_support( 'page', 'trackbacks' );           // rétroliens
	remove_post_type_support( 'page', 'revisions' );			// révisions
	remove_post_type_support( 'page', 'author' );				// auteur

});


add_action( 'admin_menu', function () use($pc_custom_settings) {
        
    if ( !isset($pc_custom_settings['seo-rewrite-url']) ) {
        remove_meta_box( 'slugdiv', array('page'), 'normal' );      // identifiant   
    }
    remove_meta_box( 'pageparentdiv', array('page'), 'normal' );    // attributs   

});


/*----------  Sélection d'un modèle  ----------*/

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

  
/*=====  FIN Page  =====*/

/*=================================================
=            Enregistrement sans titre            =
=================================================*/
  
if ( !isset( $pc_custom_settings['seo-rewrite-url'] ) ) {

    add_action( 'save_post', 'pc_update_slug' );

        function pc_update_slug( $post_id ) {

			if ( wp_is_post_revision( $post_id ) || get_post_type( $post_id ) == 'nav_menu_item' || get_post_type( $post_id ) == 'attachment' ) { return; }

			// prévention contre une boucle infinie 1/2
			remove_action( 'save_post', 'pc_update_slug' );

			$post_update_args = array( 'ID' => $post_id );
			
			$post_title = get_the_title( $post_id) ;
			if ( $post_title != '' ) {
				$post_update_args['post_name'] = sanitize_title( $post_title );
			} else {
				$post_update_args['post_name'] = 'sans-titre-'.$post_id;
				$post_update_args['post_title'] = '(sans titre)';
			}

			// mise à jour post
			wp_update_post( $post_update_args );

			// prévention contre une boucle infinie 2/2
			add_action( 'save_post', 'pc_update_slug' );
				
        }

}


/*=====  FIN Enregistrement sans titre  =====*/

/*===========================================================
=            Désactivation sauvegarde autmatique            =
===========================================================*/

add_action( 'wp_print_scripts','pc_disable_autosave', 20 );

	function pc_disable_autosave() {
		
		wp_deregister_script( 'autosave' );
		wp_dequeue_script( 'autosave' );
	
	}


/*=====  FIN Désactivation sauvegarde autmatique  =====*/

/*========================================
=            Options de liste            =
========================================*/

/*----------  Masquer le lien "Modifications rapide"  ----------*/

add_filter( 'post_row_actions', 'pc_remove_quick_link', 10, 2 );
add_filter( 'page_row_actions', 'pc_remove_quick_link', 10, 2 );

    function pc_remove_quick_link( $actions ) {

        unset( $actions['inline hide-if-no-js'] );
        return $actions;

    }


/*=====  FIN Options de liste  =====*/

/*===================================================
=            Protection par mot de passe            =
===================================================*/

/*----------  Préfixe titre  ----------*/

add_filter( 'protected_title_format', 'pc_edit_protected_title_format' );

	function pc_edit_protected_title_format() {

		return '%s';

	}


/*----------  Formulaire  ----------*/
	
add_filter( 'the_password_form', 'pc_edit_password_form' );

	function pc_edit_password_form( $output ) {
		 
		$output = '<form action="'.esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ).'" method="post" class="form--page-protected">';
		$output .= '<p>'.__( 'This content is password protected. To view it please enter your password below:' ) . '</p>';
		$output .= '<ul class="form-list reset-list">';
			$output .= '<li class="form-item form-item--password">';
			$output .= '<label for="post-password" class="form-label">'.__( 'Password:' ).'</label>';
			$output .= '<div class="form-item-inner"><input name="post_password" id="post-password" type="password" /></div>';
			$output .= '</li>';
			$output .= '<li class="form-item form-item--submit"><button type="submit" title="'.esc_attr_x( 'Enter', 'post password form' ).'" class="form-submit button"><span class="form-submit-inner">'.esc_attr_x( 'Enter', 'post password form' ).'</span></button></li>';
		$output .= '</ul></form>';

		return $output;

	}


/*=====  FIN Protection par mot de passe  =====*/