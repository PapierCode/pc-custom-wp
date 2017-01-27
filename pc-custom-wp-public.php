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
                
                $imgDatas = wp_prepare_attachment_for_js($imgId); // mais ne retourne pas les tailles personnalisées ! 
                $thumbnailDatas = wp_get_attachment_image_src($imgId,'gallerythumbnail');

                $return .= '<li class="wp-gallery-item">';
                $return .= '<a class="wp-gallery-link" href="'.$imgDatas['sizes']['large']['url'].'" data-lg-caption="'.$imgDatas['caption'].'" data-lg-responsive="'.$imgDatas['sizes']['medium']['url'].'" title="Afficher l\'image">';
                $return .= '<img class="wp-gallery-img" src="'.$thumbnailDatas[0].'" width="'.$thumbnailDatas[1].'" height="'.$thumbnailDatas[2].'" alt="'.$imgDatas['alt'].'"/>';
                $return .= '</a>';
                $return .= '</li>';

            }

        $return .= '</ul>';

        // affichage
        return $return;
    }


/*=====  End of Gallerie  ======*/