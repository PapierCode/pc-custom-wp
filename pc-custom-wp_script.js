/**
*
* Champs obligatoires
*
**/


jQuery(document).ready(function($){

/*===========================================
=            Champs obligatoires            =
===========================================*/

/*----------  Titre des posts & pages  ----------*/

// .post-type-shop_order = woocommerce nouvelle commande
$('body:not(.post-type-shop_order) #post').submit(function(event){
	
	var $title = $('#title');

	if ( $title.val() == "" ) {

		event.preventDefault();
		$title.addClass('pc-field-alert').after('<em class="pc-message pc-message_false">Le titre est obligatoire</em>');

	}

});


/*----------  Sélection d'un parent  ----------*/

if ( $('body').hasClass('page-parent-select') ) {

	var checkParent = false;
	$('#post').submit(function(event){

		if( checkParent==false ){

			event.preventDefault();
			$('#pc-page-attributs').css('border-color','red').prepend('<p style="color:white; background-color:red; padding:8px 12px; margin:0">Vérifiez les attributs de la page.</p>');
			checkParent = true;

		}

	});

}


/*=====  FIN Champs obligatoires  ======*/

});