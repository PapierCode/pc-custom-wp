<?php

/**
*
* * Divers
* * Gallerie
*
*
**/


/*==============================
=            Divers            =
==============================*/

/*----------  masquer la version de wordpress  ----------*/

// si wp_head() présent dans header.php
remove_action("wp_head", "wp_generator");


/*=====  End of Divers  ======*/

/*================================
=            Gallerie            =
================================*/

add_filter( 'post_gallery', 'my_gallery_shortcode', 10, 3 );

    function my_gallery_shortcode( $output = '', $atts, $instance ) {

        // liste des images
        $imgIdList = explode( ',' , $atts['ids'] );

        // html contruction
        $return = '<ul class="wp-gallery reset-list">';

            foreach ( $imgIdList as $imgId ) {       
                
                $imgThumbnail = wp_get_attachment_image_src( $imgId, 'thumbnail' );

                $return .= '<li class="wp-gallery-item">';
                $return .= '<a class="wp-gallery-link" href="'.wp_get_attachment_image_src( $imgId, 'large' )[0].'">';
                $return .= '<img class="wp-gallery-img" src="'.$imgThumbnail[0].'" width="'.$imgThumbnail[1].'" height="'.$imgThumbnail[2].'" alt=""/>';
                $return .= '</a>';
                $return .= '</li>';

            }

        $return .= '</ul>';

        // affichage
        return $return;
    }


/*=====  End of Gallerie  ======*/

?>