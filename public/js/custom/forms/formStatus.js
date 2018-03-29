$("#update_status").on('click', function () {
	
	var codeSelected = $("#status_code_id").val();
	var comment = $("#comment").val();
	var formInstanceId = $('#form_instance_id').val();
	var origin = $('#origin').val();
    var reply = $('#ask_for_reply:checked').val()

    $.ajax({
        url: "/forms/updateStatus",
        type: 'post',
        data: {
        	origin: origin,
        	form_instance_id: formInstanceId,
        	status_code_id: codeSelected,
            comment: comment,
            reply: reply
        },
        success: function(result) {
        
       		swal({
        		title : "",
        		text : "Status Updated",
        		type : "success",
        	},
        	function(){
                $('#logContainer').load("/form/productrequestform/log/"+formInstanceId);
        		$("#comment").val("");
        		$("#status_code_id").val(0);
                $('#ask_for_reply').prop('checked', false);
        	})
        }
    }).done(function(response){
      	
    });
	
});


	