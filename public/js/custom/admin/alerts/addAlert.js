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

var showDocumentListing = function(){                
    $("#document-listing").modal('show');
}

$('#search_document').on('blur', function(){
	setTimeout(function(){
		$("#document-list").fadeOut();
	}, 3000);
	
});

$("body").on('click', '.filtered-document', function(){

    $("input[name='alert_document']").val($(this).text())
                        .attr('data-document-id', $(this).attr('data-document-id') );


});


$("#add-documents").click(function(){
    $("#document-listing").modal('show');
});

$(".document-checkbox").on('click', function(){
    $(".document-checkbox").prop("checked", false);
    $(this).prop("checked", true);
    $('.document-checkbox').each(function(){
        if($(this).is(":checked")){
            $("input[name='alert_document']").val($(this).attr("data-filename")).attr('data-document-id', $(this).val());
        }
    });
 });

$("#attach-selected-files").on('click', function(){
    $("#document-listing").modal('hide');
});

$(".alert-create").click(function(){
    var hasError = false;

    var document_id = $("input[name='alert_document']").attr('data-document-id')
    var alert_type_id = $("#alert_type").val();
    var bannerId = localStorage.getItem('admin-banner-id');

    if(document_id == '') {
        swal("Oops!", "This we need a document to be marked as alert.", "error");
        hasError = true;
        $(window).scrollTop(0);
    }

    if(alert_type_id == '') {
        swal("Oops!", "This we need an alert type.", "error");
        hasError = true;
        $(window).scrollTop(0);
    }

    if(hasError == false) {
        $.ajax({
            url: '/admin/alert',
            type: 'POST',
            data: { 'document_id': document_id, alert_type_id: alert_type_id, banner_id: bannerId},
            dataType : 'json',
            success: function(data) {
                console.log(data);
                if(data != null && data.validation_result == 'false') {
                    var errors = data.errors;
                    console.log(errors);
                    if(errors.hasOwnProperty("document_id")) {
                        $.each(errors.document_id, function(index){
                            $("#search_document").parent().parent().append('<div class="req">' + errors.document_id[index]  + '</div>');
                        });
                    }
                    if(errors.hasOwnProperty("alert_type_id")) {
                        $.each(errors.alert_type_id, function(index){
                            $("#alert_type").parent().append('<div class="req">' + errors.alert_type_id[index]  + '</div>');
                        });
                    }
                }
                else{
                    // $("#event_type").val(""); // empty the form
                    swal("Nice!", "Alert has been created", "success");
                }

            }
        });
    }

    return false;
});
