$(".group-edit").click(function(){
    var hasError = false;

    var users = $("#users").val();
    var group_name = $("#group_name").val();
    var group_id = $("#group_id").val();
    var businessUnit = $("#businessUnit").val();

    if(group_name == '') {
        swal("Oops!", "We need a group name.", "error");
        hasError = true;
        $(window).scrollTop(0);
    }

    if(businessUnit == null) {
        swal("Oops!", "We need a Business Unit.", "error");
        hasError = true;
        $(window).scrollTop(0);
    }
    if(users == null) {
        swal("Oops!", "We need some users for the group.", "error");
        hasError = true;
        $(window).scrollTop(0);
    }

    if(hasError == false) {
        $.ajax({
            url: '/form/group/' + group_id,
            type: 'PATCH',
            data: { 
            	'group_name' : group_name, 
            	'users': users,
                'businessUnit' : businessUnit
            },
            dataType : 'json',
            success: function(data) {
                if(data.validation_result == 'false'){
                    var errors = data.errors;
                    console.log(errors);
                    $( ".error" ).remove();
                    if(errors.hasOwnProperty("group_name")) {
                        $.each(errors.group_name, function(index){
                            $("#group_name").parent().append('<div class="req error">' + errors.group_name[index]  + '</div>'); 
                        });     
                    }
                    if(errors.hasOwnProperty("users")) {
                        $.each(errors.users, function(index){
                            $("#users").parent().append('<div class="req error">' + errors.users[index]  + '</div>'); 
                        });     
                    }
                    if(errors.hasOwnProperty("businessUnit")) {
                        $.each(errors.businessUnit, function(index){
                            $("#businessUnit").parent().append('<div class="req error">' + errors.businessUnit[index]  + '</div>'); 
                        });     
                    }

                }
                else{

                
                    swal("Nice!", "Group has been created", "success");
                }

            }
        });
    }

    return false;
});
