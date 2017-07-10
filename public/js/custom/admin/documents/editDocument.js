$("body").on('click', "#select_all", function(){
	console.log('all documents selected');
	if($(this).is(':checked')){
		$(".select_document").prop("checked", true);

	}
	else{
		$(".select_document").prop("checked", false);	
	}
});

$("#edit_selected").click(function(){
	var selectedDocuments = $(".select_document:checked");
	console.log(selectedDocuments);
	$.each(selectedDocuments, function(index, doc){
		console.log($(this).attr('data-fileid'));
	});
});