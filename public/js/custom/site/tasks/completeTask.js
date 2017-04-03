$('.check-link').click(function () {

        

        //TODO: ajax to mark the task as complete

        // if(duedateicon.is('.fa-clock-o')){
        //     //TODO: get original due date from server via ajax, instead of "not done"...
        //     duedatetext.text("not done");
        //     //TODO: ajax - mark the task as incomplete


        // }
        // return false;

        var task_id = $(this).attr('data-task-id');
        var url = 'task/' + task_id ;
        var task_checkbox_status = $(this).attr('data-task-completed');


        console.log(url);
        $.ajax({
            url: url,
            type: 'PATCH',
            dataType: 'json',
            data: {
                current_task_status : task_checkbox_status
            },
            success: function(result) {
                console.log(result);
                
            }
        }).done(function(response){
            console.log(response);
        });     
    });