jQuery( function( $ ) {
  var selector = 'input[name=searchE],input[name=searchA]';
  $( selector ).on( 'input', function() {
    $( selector ).not( this ).prop( 'required', !$( this ).val().length );
  } );
} );