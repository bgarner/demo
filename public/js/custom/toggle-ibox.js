$("body").on("click", ".toggle-ibox", function(e){

	$visable = $('.ibox').is(":visible"); 

	if($visable){
		$(this).removeClass('fa-eye');
		$(this).addClass('fa-eye-slash');
		$( '.ibox' ).addClass( 'hide' );
	} else {
		$(this).removeClass('fa-eye-slash');
		$(this).addClass('fa-eye');
		$( '.ibox' ).removeClass( 'hide' );
	}

});	