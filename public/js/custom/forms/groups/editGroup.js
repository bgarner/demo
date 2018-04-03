$(".group-edit").click(function(){
    var hasError = false;

    var users = $("#users").val();
    var group_name = $("#group_name").val();
    var group_id = $("#group_id").val();

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
            url: '/form/group/' + group_id,
            type: 'PATCH',
            data: { 
            	// 'form_id': form_id,
            	'group_name' : group_name, 
            	'users': users,
            },
            dataType : 'json',
            success: function(data) {
                console.log(data);
                // if(data != null && data.validation_result == 'false') {
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
                // }
                // else{
                    // $("#event_type").val(""); // empty the form
                    swal("Nice!", "Group has been updated", "success");
                // }

            }
        });
    }

    return false;
});
