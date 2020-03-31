/**
*
* Champs obligatoires
*
**/


jQuery(document).ready(function($){

/*===========================================
=            Champs obligatoires            =
===========================================*/

$('form#post').submit(function(event){

	// custom field date
	var $datePicker = $('.pc-date-picker:required'), error = false, $fieldError = false;

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
	
});


/*=====  FIN Champs obligatoires  ======*/

});