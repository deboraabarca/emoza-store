/* Select 2 Control */
jQuery( document ).ready(function($) {

	"use strict";

	$( '.emoza-select2' ).each( function(){
		const options = $( this ).data( 'select2-options' );

		$( this ).select2( options );
	} );

	$( '.emoza-select2' ).on( 'change', function(){
		const hidden_input = $( this ).prev();

		hidden_input.val( $(this).val() ).trigger( 'change' );
	} );
  
});