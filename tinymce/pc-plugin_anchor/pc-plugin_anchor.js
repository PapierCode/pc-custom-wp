/**
*
* TinyMce plugin pour ajouter une ancre (attribut id) aux éléments
*
**/


(function() {

    tinymce.PluginManager.add('pcanchor', function( editor ) {

        editor.addButton( 'pcanchor', {

            title: 'Ajouter/supprimer une ancre',
            icon: 'anchor',
            onclick: function() {

            	if ( jQuery( editor.selection.getNode() ).attr( 'id' ) =='tinymce' ) {

					editor.windowManager.alert('Sélectionnez un élément.');

            	} else {

					editor.windowManager.open({

						title: 'Ajouter/supprimer une ancre',
						body: [
							{type: 'textbox', name: 'ancre', label: 'Nom', value : jQuery( editor.selection.getNode() ).attr( 'id' )},
							{type: 'container', html: '- Nommez l\'ancre sans espace ni caractères accentués<br/>- Laissez le champ vide pour supprimer l\'ancre.'}
						],
						onsubmit: function(e) {
							if ( e.data.ancre ) {
								jQuery( editor.selection.getNode() ).attr( 'id', e.data.ancre );
							} else {
								jQuery( editor.selection.getNode() ).removeAttr( 'id' );
							}
							
						}

					}); // FIN windowManager.open()

				} // FIN if id == 'tinymce'

            } // FIN onclick

        }); // FIN addButton()

    }); // FIN PluginManager.add()

})();