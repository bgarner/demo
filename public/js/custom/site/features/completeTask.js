$(document.body).on('click', '.check-link', function (e) {

    e.preventDefault();
    handleTaskUpdate($(this));

});
$(".check-link").click(function(e){
    e.preventDefault();
    handleTaskUpdate($(this));
    
});


var handleTaskUpdate = function(elem){

    var origin = window.location.origin;
    var store_number = localStorage.getItem('userStoreNumber');
    var featureID = $("#featureID").val();
    var task_id = elem.attr('data-task-id');
    
    var url = origin + "/" + store_number + "/feature/"+ featureID +"/task/" + task_id; 
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

        var updateTasklistUrl = origin + "/" + store_number + "/feature/" + featureID + "/tasklist";
        console.log(updateTasklistUrl);
        $("#task-container").load(updateTasklistUrl);

    });     

}