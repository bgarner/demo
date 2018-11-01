$(".delete-report").click(function(){

    var report = $(this).attr('data-report-id');
    var selector = "#report"+report;

    swal({
        title: "Are you sure?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
        }, function () {
        
        $.ajax({
            url: '/manager/storevisitreport/'+ report,
            type: 'DELETE',

            success: function(result) {
                $(selector).closest('tr').fadeOut(1000);
                swal("Deleted!", "This task has been deleted.", "success");
            }

        });
        
    });

    return false;
});
