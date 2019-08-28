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
$('body:not(.post-type-shop_order) form').submit(function(event){
	
	// titre
	var $title = $('#title');
	if ( $title.val() == "" ) {
		event.preventDefault();
		$title.addClass('pc-field-alert').after('<em class="pc-message pc-message_false">Le titre est obligatoire</em>');
	}
	// custom field date
	var $datePicker = $('.pc-date-picker:required'), dateRequired = false, $dateError = false;
	if ( $datePicker.length > 0 ) {
		$datePicker.each(function() {
			if ( $(this).val() == '' ) {
				if ( !$(this).hasClass('pc-field-alert') ) {
					$(this).addClass('pc-field-alert').after('<p><em class="pc-message pc-message_false">Ce champ est obligatoire</em></p>');
				}
				dateRequired = true;
				if ( !$dateError ) { $dateError = $(this) };
			} else if ( $(this).hasClass('pc-field-alert') ) {
				$(this).removeClass('pc-field-alert').next('p').remove();
			}
		});
		if ( dateRequired ) {
			event.preventDefault();
			$('html, body').animate({ scrollTop: $dateError.offset().top - 50 }, 500);
		}
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