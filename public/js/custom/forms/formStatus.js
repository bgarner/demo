// var statusDropdown = document.getElementById('status_code_id');

$("#update_status").on('click', function () {

	//var codeSelected = $("#status_code_id").children("option").filter(":selected").val();
	var codeSelected = $("#status_code_id").val();
	var comment = $("#comment").val();
	var formInstanceId = $('#form_instance_id').val();
	var origin = $('#origin').val();

	console.log(codeSelected);
    console.log(comment);

    $.ajax({
        url: "/forms/updateStatus",
        type: 'post',
        dataType: 'json',
        data: {
        	origin: origin,
        	form_instance_id: formInstanceId,
        	status_code_id: codeSelected,
            comment: comment
        },
        success: function(result) {

        	console.log(result);
       		// swal({
        	// 	title : '',
        	// 	text : "Status Updated",
        	// 	type : 'success',

        	// },
        	// function(){
        	// 	//reload the partial
        	// })
        }
    }).done(function(response){
       $(element).closest("tr").after( table );
    });
	
});


	