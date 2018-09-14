$(document.body).on('click', '.check-link', function (e) {

    e.preventDefault();
    handleTaskUpdate($(this));

});
$(".check-link").click(function(e){
    e.preventDefault();
    handleTaskUpdate($(this));
    
});


var handleTaskUpdate = function(elem){

    var task_id = elem.attr('data-task-id');

    var pathname = window.location.pathname;

    var isTasklistTask = new RegExp('/\*\/tasklist\/\*/');

    if (isTasklistTask.test(pathname)) {
        var url =  window.location.href + "/task/" + task_id ;            
    }
    else{

        var isManagerTask = new RegExp(/getTasksBy/);
        
        if (isManagerTask.test(window.location.href)){
            var url = window.location.href.split('/');
            url.pop(); //remove getTasksBy* segment 
            url = url.join('/') + "/" + task_id;
        }
        else{
            var url =  window.location.href + "/" + task_id ;    
        }
        
    }

    var task_checkbox_status = elem.attr('data-task-completed');

    $.ajax({
        url: url,
        type: 'PATCH',
        dataType: 'json',
        data: {
            current_task_status : task_checkbox_status
        },
        success: function(result) {
            
        }
    }).done(function(response){

        $("#sidenav-task-count").text(response.allIncompleteTasks + " / " + (response.tasksCompleted + response.allIncompleteTasks) );
        $("#task-container").html(response.html);

    });     

}