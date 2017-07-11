$(document).ready(function(){
	$("#edit_multiple_documents").hide();	
});

$("body").on('click', "#select_all", function(){
	if($(this).is(':checked')){
		$(".select_document").prop("checked", true);
		$("#edit_multiple_documents").show();
	}
	else{
		$(".select_document").prop("checked", false);
		$("#edit_multiple_documents").hide();	
	}
});
$("body").on('click', '.select_document', function(){
	if(!$(this).is(":checked")){
		$("#select_all").prop('checked', false);
	}
	if($(".select_document:checked").length >0){
		$("#edit_multiple_documents").show();
	}
	else{
		$("#edit_multiple_documents").hide();
	}
});


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
		       $("tr[data-fileid='"+result.id+"']").find(".start").html(result.prettyDateStart);
		    }
		}).done(function(response){
			
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
		       $("tr[data-fileid='"+result.id+"']").find(".end").html(result.prettyDateEnd);
		    }
		}).done(function(response){
			
		});   
	});
});
