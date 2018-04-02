$(document).ready(function(){
	$("#users").closest('.form-group').hide();
});


$("#form").change(function(){
	
	var form = $('#form option:selected').val();
	console.log('/form/' + form + '/users');
	$.ajax({
		    url: '/form/' + form + '/users',
		    type: 'GET',
		    dataType: 'json',
		    success: function(result) {
		    	console.log(result);
		    	if( result.length >0 ) {
		    		$("#users option").remove();
		    		$('<option>').val("")
		    					 .text("Select one")
		    					 .appendTo('#users');
					for (var i = 0; i < result.length ; i++) {
						console.log(result[i].id);
						console.log(result[i].firstname);
						$('<option>').val(result[i].id)
									 .text(result[i].firstname + " " + 
									 		result[i].lastname + " ( " +
									 		result[i].fglposition + " )"
									 	)
									 .appendTo('#users');
					}
					console.log($("#users option"));
					$("#users").closest('.form-group').show();
					$("#users").trigger("chosen:updated");
					
		        }
		        else{
		        	$("#users").closest('.form-group').hide();
		        }
		        
		    }
		}).done(function(data){
			// console.log(data);
		});    
});

$(".group-create").click(function(){
    var hasError = false;

    var form_id = $("#form").val();
    var users = $("#users").val();
    var group_name = $("#group_name").val();
    console.log(users);

    // if(document_id == '') {
    //     swal("Oops!", "This we need a document to be marked as alert.", "error");
    //     hasError = true;
    //     $(window).scrollTop(0);
    // }

    // if(alert_type_id == '') {
    //     swal("Oops!", "This we need an alert type.", "error");
    //     hasError = true;
    //     $(window).scrollTop(0);
    // }

    if(hasError == false) {
        $.ajax({
            url: '/form/group',
            type: 'POST',
            data: { 
            	'form_id': form_id,
            	'group_name' : group_name, 
            	'users': users,
            },
            dataType : 'json',
            success: function(data) {
                console.log(data);
                if(data != null && data.validation_result == 'false') {
                    // var errors = data.errors;
                    // console.log(errors);
                    // if(errors.hasOwnProperty("document_id")) {
                    //     $.each(errors.document_id, function(index){
                    //         $("#search_document").parent().parent().append('<div class="req">' + errors.document_id[index]  + '</div>');
                    //     });
                    // }
                    // if(errors.hasOwnProperty("alert_type_id")) {
                    //     $.each(errors.alert_type_id, function(index){
                    //         $("#alert_type").parent().append('<div class="req">' + errors.alert_type_id[index]  + '</div>');
                    //     });
                    // }
                }
                else{
                    // $("#event_type").val(""); // empty the form
                    swal("Nice!", "Group has been created", "success");
                }

            }
        });
    }

    return false;
});
