$("#update_status").on('click', function () {
	var formInstanceId = $('#form_instance_id').val();
    updateFormInstanceStatus(formInstanceId);
	
});


var updateFormInstanceStatus =  function(formInstanceId){


    var statusCodeSelected = $("#status_code_id").val();
    var resolutionCodeSelected = $("#resolution_code_id").val();
    var comment = $("#comment").val();
    
    if(formInstanceId == 'undefined'){
        var formInstanceId = $('#form_instance_id').val();    
    }
    
    var origin = $('#origin').val();
    var reply = $('#ask_for_reply:checked').val()

    $.ajax({
        url: "/form/updateStatus",
        type: 'post',
        dataType : 'JSON',
        data: {
            origin: origin,
            form_instance_id: formInstanceId,
            status_code_id: statusCodeSelected,
            resolution_code_id : resolutionCodeSelected,
            comment: comment,
            reply: reply
        },
        success: function(data) {
            
            if(data.validation_result == 'false'){
                    var errors = data.errors;
                    var errorString = '';
                    if(errors.hasOwnProperty("form_data_id")){
                        $.each(errors.form_data_id, function(index){
                            errorString +=  errors.form_data_id[index] + "\n" ; 
                        });     
                    }
                    if(errors.hasOwnProperty("status_code_id")){
                        $.each(errors.status_code_id, function(index){
                            errorString += errors.status_code_id[index] + "\n"; 
                        });     
                    }
                    if(errors.hasOwnProperty("resolution_code_id")){
                        $.each(errors.resolution_code_id, function(index){
                            errorString += errors.resolution_code_id[index] + "\n"; 
                        });     
                    }
                    console.log(errorString);

                    swal({
                        title : "",
                        text : errorString,
                        type : "error",
                    })    

                }
                else{

                    swal({
                        title : "",
                        text : "Status Updated",
                        type : "success",
                    },
                    function(){
                        if($('#logContainer').length>0){
                            $('#logContainer').load("/form/productrequestform/log/"+formInstanceId);
                            $("#comment").val("");
                            $("#status_code_id").val(0);
                            $('#ask_for_reply').prop('checked', false);    
                        }
                        else{
                            window.location.reload();
                        }
                        
                    })
                }


            
        }
    }).done(function(response){
        
    });
    

}

	