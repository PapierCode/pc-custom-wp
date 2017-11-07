<?php

/**
*
* Médias
*
**/
    

/*----------  Options par défaut  ----------*/

add_action( 'after_setup_theme', function() {
    
    // taille sélectionnée par défaut lors de l'ajout
    update_option( 'image_default_size', 'large' );

});


/*----------  Caption  ----------*/

add_filter( 'img_caption_shortcode', function( $empty, $attr, $content ) {

    return '<figure class="wp-caption '.$attr['align'].'">'.$content.'<figcaption style="max-width:'.$attr['width'].'px">'.$attr['caption'].'</figcaption></figure>';

}, 10, 3 );