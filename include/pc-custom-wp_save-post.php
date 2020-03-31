<?php
/**
 * 
 * Actions à la sauvegarde d'un post
 * 
 */

/*=================================================
=            Enregistrement sans titre            =
=================================================*/
  
if ( !isset( $pc_custom_settings['seo-rewrite-url'] ) ) {

    add_action( 'save_post', 'pc_update_slug' );

        function pc_update_slug( $post_id ) {

            // si ce n'est pas une révision
            if ( ! wp_is_post_revision( $post_id ) ) {

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

}


/*=====  FIN Enregistrement sans titre  =====*/
