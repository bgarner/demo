$( "#copy-communication").click(function(){

	var communicationId = $(this).attr('data-communicationid');
	var communicationName = $(this).attr('data-communicationname');
	if (localStorage.getItem('communicationId') != communicationId) {
		
		localStorage.removeItem('communicationId');
		localStorage.removeItem('communicationName');
		localStorage.setItem('communicationId', communicationId );
		localStorage.setItem('communicationName', communicationName );
	}
	swal("Nice!", "'" + communicationName +"' has been copied to clipboard", "success");        
});

