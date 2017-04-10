/**
*
* Champs obligatoires
*
**/


jQuery(document).ready(function($){

/*===========================================
=            Champs obligatoires            =
===========================================*/

/*----------  titre des posts & pages  ----------*/

$('#post').submit(function(event){
	
	var $title = $('#title');

	if ( $title.val() == "" ) {

		event.preventDefault();
		$title.addClass('pc-field-alert').after('<em class="pc-message pc-message_false">Le titre est obligatoire</em>');

	}

})


/*=====  FIN Champs obligatoires  ======*/

});