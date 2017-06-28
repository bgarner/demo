$(document).ready(function(){
	$(".document_name").each(function(){
   		$("#document-list").append('<ul class="filtered-document" data-document-id="'+ $(this).prev().val() +
   									'" data-search-term="'+$(this).text().toLowerCase()+'">'+
   										'<a href="#">'+$(this).text()+'</a>'+
   									'</ul>');
	});


});

$('#search_document').on('keyup', function(){

	var searchTerm = $(this).val().toLowerCase();
	$("#document-list").show();

    $('#document-list ul').each(function(){

        if ($(this).filter('[data-search-term *= ' + searchTerm + ']').length > 0 || searchTerm.length < 1) {
            $(this).show();
        } else {
            $(this).hide();
        }

    });

});


$('#search_document').on('blur', function(){
	setTimeout(function(){
		$("#document-list").fadeOut();
		$("#search_document").val('');
	}, 3000);
	
});

$("body").on('click', '.filtered-document', function(){

    if($(".selected-files[data-fileid='"+$(this).attr('data-document-id')+"']").length == 0){
        $("#files-selected tbody").append('<tr class="communication-documents" data-fileid='+ $(this).attr('data-document-id') +'>'+
                      '<td class="selected-files col-sm-10 col-sm-offset-2 feature-documents" '+
                          'data-fileid='+ $(this).attr('data-document-id') +'>'+
                      $(this).text()+
                      '</td>'+
                      '<td></td>'+
                      '<td><a data-file-id="'+ $(this).attr('data-document-id')+'" id="file'+ $(this).attr('data-document-id')+
                          '" class="remove-staged-file btn btn-danger btn-sm">'+
                          '<i class="fa fa-trash"></i></a></td>'+
                      '</tr>');
    }
    $(this).find("i").remove();
    $('<i class="fa fa-check"></i>').insertBefore($(this).find("a"));
    $(".communication-documents-table").removeClass('hidden').addClass('visible');
    $("#document-list").hide();

});


$("#add-documents").click(function(){
    $("#document-listing").modal('show');
});

$(".document-checkbox").click( function(){
   if( $(this).is(':checked') ){
        clearTimeout();
        setTimeout(function(){
            $("#attach-selected-files").trigger('click');
            $("#document-listing").modal('hide');
        }, 3000);
   }
});


$('body').on('click', '#attach-selected-files', function(){
    
    $('input[name^="package_files"]').each(function(){
        if($(this).is(":checked")){
            
            console.log($(".selected-files[data-fileid='"+$(this).val()+"']").length);
            if($(".selected-files[data-fileid='"+$(this).val()+"']").length == 0){
              $("#files-selected tbody").append('<tr class="communication-documents" data-fileid="'+ $(this).val()+'">'+
                                                    '<td class="selected-files col-sm-10 col-sm-offset-2" '+
                                                        'data-fileid='+ $(this).val() +'>'+
                                                        $(this).attr("data-filename")+
                                                    '</td>'+
                                                '<td></td>'+
                                                '<td><a data-file-id="'+ $(this).val()+'" id="file'+ $(this).val()+
                                                        '" class="remove-staged-file btn btn-danger btn-sm">'+
                                                        '<i class="fa fa-trash"></i></a></td>'+
                                                '</tr>');
            }
            $(".communication-documents-table").removeClass('hidden').addClass('visible');

            
        }
    });
});

$("body").on('click', ".remove-staged-file", function(){
    
    var document_id = $(this).attr('data-file-id');
    $(this).closest('.communication-documents').fadeOut(200);
    $(this).closest('.communication-documents').remove();

});