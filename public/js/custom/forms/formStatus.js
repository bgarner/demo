$("#update_status").on('click', function () {
	
	var codeSelected = $("#status_code_id").val();
	var comment = $("#comment").val();
	var formInstanceId = $('#form_instance_id').val();
	var origin = $('#origin').val();

    $.ajax({
        url: "/forms/updateStatus",
        type: 'post',
        data: {
        	origin: origin,
        	form_instance_id: formInstanceId,
        	status_code_id: codeSelected,
            comment: comment
        },
        success: function(result) {
        
       		swal({
        		title : "",
        		text : "Status Updated",
        		type : "success",
        	},
        	function(){
        		$("#comment").val("");
        		$("#status_code_id").val(0);
        	})
        }
    }).done(function(response){
      	
    });
	
});


	