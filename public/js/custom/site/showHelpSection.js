$(".helpSection").click(function(){
	var parentView = $(this).attr('data-parent-view');
	var section = $(this).attr('data-section');

	$.ajax({
		url : "/showHelpSection",
	    type: 'GET',
	    data: {
	    	parentView: parentView,
	  		section: section
	    },
	}).done(function( data ){
		
		$('#helpmodal #modalTitle').html(data.title);
    	$('#helpmodal #modalBody').html(data.description);
		$("#helpmodal").modal('show');
	});
});