$("#send_response_to_question").on('click', function () {
	
    var formInstanceId = $("#formInstanceId").val();
	var logActivityId = $("#logActivityId").val();
	var submitted_by = $("#submitted_by").val();
	var submitted_by_position = $('#submitted_by_position').val();
    var answer = $('#answer').val();

    $.ajax({
        url: "/form/updateStatus/" + logActivityId,
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
                $('#logContainer').load("/form/productrequestform/log/"+formInstanceId);

        	})
        }
    }).done(function(response){
      	
    });
	
});