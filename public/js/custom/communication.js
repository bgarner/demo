$(document).ready(function(){
	
	formatDate();

	$('#attach-selected-packages').on('click', function(){
		$("#packages-selected").append('<p>Packages Attached:</p>');
		$('input[name^="packages"]').each(function(){			
			if($(this).is(":checked")){
				$("#packages-selected").append('<ul class="selected-packages" data-package-id='+ $(this).val() +'>'+$(this).attr("data-package-name")+'</ul>')
			}
		});
	});

	$('#attach-selected-files').on('click', function(){
		$("#files-selected").append('<p>Files attached :</p>');
		$('input[name^="package_files"]').each(function(){
			if($(this).is(":checked")){
				$("#files-selected").append('<ul class="selected-files" data-fileid='+ $(this).val() +'>'+$(this).attr("data-filename")+'</ul>')
			}
		});
	});

	$(".chosen").chosen({
		width:"50%",
	});
});

$(".remove-document").on('click', function(){
	var document_id = $(this).attr('data-document-id');
	$(this).parent().fadeOut(200);
	$("#documents-staged-to-remove").append('<input name=remove_document[] value='+ document_id +'>');

});

$(".remove-package").on('click', function(){
	var package_id = $(this).attr('data-package-id');
	$(this).parent().fadeOut(200);
	$("#packages-staged-to-remove").append('<input name=remove_package[] value='+ package_id +'>');

});


var formatDate = function(){
	
	if ( typeof(start) === "number") {
		var offset = new Date().getTimezoneOffset();
		var offsetSeconds = offset*60;
		var startTime = moment.unix(start + offsetSeconds).format('YYYY-MM-DD HH:mm:ss');
		var endTime = moment.unix(end + offsetSeconds ).format('YYYY-MM-DD HH:mm:ss');
		$("input[name='send_at']").val(startTime);
		$("input[name='archive_at']").val(endTime);			
	}
	
}

$(".delete-communication").click(function(){

	var commId = $(this).attr('data-communication');
	var selector = "#communication"+commId;

	swal({
		title: "Are you sure?",
		//text: "You will not be able to recover this imaginary file!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, delete it!",
		closeOnConfirm: false
    	}, function () {
	    
		$.ajax({
		    url: '/admin/communication/'+ commId,
		    type: 'DELETE',

		    success: function(result) {
		        $(selector).closest('tr').fadeOut(1000);
		        swal("Deleted!", "This communication has been deleted.", "success");
		    }

		});
        
    });

    return false;
});


$("#allStores").change(function(){

	if ($("#allStores").is(":checked")) {

		$("#storeSelect option").each(function(index){			
			$(this).attr('selected', 'selected');
		});
		$("#storeSelect").chosen();
		
	}
	else if ($("#allStores").not(":checked")) {
		$("#storeSelect option").each(function(){
			$(this).removeAttr('selected');
		});
		$("#storeSelect").chosen();
		
	}
});