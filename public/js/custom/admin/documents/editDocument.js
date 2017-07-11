$("body").on('click', "#select_all", function(){
	console.log('all documents selected');
	if($(this).is(':checked')){
		$(".select_document").prop("checked", true);

	}
	else{
		$(".select_document").prop("checked", false);	
	}
});

// $("#edit_selected").click(function(){
// 	var selectedDocuments = $(".select_document:checked");
// 	console.log(selectedDocuments);
// 	$.each(selectedDocuments, function(index, doc){
// 		console.log($(this).attr('data-fileid'));
// 	});
// });

$("#edit_start_date").click(function(){
	$("#start_date_selector").modal('show');
});

$("#edit_end_date").click(function(){
	$("#end_date_selector").modal('show');
});

$("#update_start_date").click(function(){
	var start_date = $("#start_date").val();
	var selectedDocuments = $(".select_document:checked");
	$.each(selectedDocuments, function(index, doc){
		var document_id = $(this).attr('data-fileid');		
		$.ajax({
		    url: '/admin/document/' + document_id ,
		    type: 'PATCH',
		    data: { document_start: start_date},
		    async: false,
		    success: function(result) {
		       console.log(result);
		    }
		}).done(function(response){
			//console.log(response);
		});   
	}); 
});


$("#update_end_date").click(function(){
	var end_date = $("#end_date").val();
	var selectedDocuments = $(".select_document:checked");
	$.each(selectedDocuments, function(index, doc){
		var document_id = $(this).attr('data-fileid');		
		$.ajax({
		    url: '/admin/document/' + document_id ,
		    type: 'PATCH',
		    data: { document_end: end_date},
		    async: false,
		    success: function(result) {
		       console.log(result);
		    }
		}).done(function(response){
			//console.log(response);
		});   
	});
});
