$(document).ready(function(){

	if (localStorage.getItem("showHelpSection") === null){
		$(".helpSection").css('visibility', 'hidden');
		$("#toggleHelp").css('color', '#c2c2c2');		
	}else{
		$(".helpSection").css('visibility', 'visible');
	}
})

$("#toggleHelp").click(function(){

	if (localStorage.getItem("showHelpSection") === null){
		localStorage.setItem("showHelpSection", true);
		$(".helpSection").css('visibility', 'visible');
		$("#toggleHelp").css('color', '#337ab7');
	}
	else{
		localStorage.removeItem('showHelpSection');
		$(".helpSection").css('visibility', 'hidden');	
		$("#toggleHelp").css('color', '#c2c2c2');
	}
})

$("body").on("click", ".helpSection", function(){
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

		if(data){
			$('#helpmodal #modalTitle').html(data.title);
    		$('#helpmodal #modalBody').html(data.description);
			$("#helpmodal").modal('show');	
		}
		
	});
});