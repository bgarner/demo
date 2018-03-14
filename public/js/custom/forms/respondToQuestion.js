$("#send_response_to_question").on('click', function () {
	
    var formInstanceId = $("#formInstanceId").val();
	var logActivityId = $("#logActivityId").val();
	var submitted_by = $("#submitted_by").val();
	var submitted_by_position = $('#submitted_by_position').val();
    var answer = $('#answer').val();

    $.ajax({
        url: "/forms/updateStatus/" + logActivityId,
        type: 'patch',
        data: {
        	submitted_by: submitted_by,
        	submitted_by_position: submitted_by_position,
            answer: answer
        },
        success: function(result) {
        
       		swal({
        		title : "",
        		text : "Response Sent",
        		type : "success",
        	},
        	function(){
                $('#logContainer').load("/admin/forms/storefeedbackform/log/"+formInstanceId);
        		// $("#comment").val("");
        		// $("#status_code_id").val(0);
          //       $('#ask_for_reply').prop('checked', false);
        	})
        }
    }).done(function(response){
      	
    });
	
});