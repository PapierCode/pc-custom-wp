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
	var $title = $('input#title[name=post_title]'), $datePicker = $('.pc-date-picker:required'), error = false, $fieldError = false;

	if ( $title.val() == "" ) {

		if ( !$title.hasClass('pc-field-error') ) {
			$title.addClass('pc-field-error').after('<p class="description pc-message-error pc-message-error--title">Le titre est obligatoire</p>');
		}
		if ( !error ) {
			error = true;
			$fieldError = $title;
		}

	} else if ( $title.hasClass('pc-field-error') )  {

		$title.removeClass('pc-field-error').next('p').remove();

	}

	// custom field date
	if ( $datePicker.length > 0 ) {
		$datePicker.each(function() {
			if ( $(this).val() == '' ) {
				if ( !$(this).hasClass('pc-field-error') ) {
					$(this).addClass('pc-field-error').after('<p><em class="description pc-message-error">Ce champ est obligatoire</em></p>');
				}
				dateRequired = true;
				if ( !error ) {
					error = true;
					$fieldError = $(this);
				}
			} else if ( $(this).hasClass('pc-field-error') ) {
				$(this).removeClass('pc-field-error').next('p').remove();
			}
		});
	}
	
	if ( error ) {
		event.preventDefault();
		$('html, body').animate({ scrollTop: $fieldError.offset().top - 50 }, 500);
	}

	console.log(error);
	
	
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