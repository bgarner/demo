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

    var module = new RegExp('/\*\/tasklist\/\*/');

    if (module.test(pathname)) {
        var url =  window.location.href + "/task/" + task_id ;            
    }
    else{
        var url =  window.location.href + "/" + task_id ;
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
        $("#task-container").html(response.html);

    });     

}