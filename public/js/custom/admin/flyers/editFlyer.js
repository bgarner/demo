$(".flyerItem").on('click', function(e){

	var modal = $('#mmmm-modal');
    var modalBody = $('#mmmm-modal .modal-content');
    localStorage.setItem('lastClickedtoTriggerModal', $(this).attr('data-folderId') );

    modalBody.empty();
    var flyerItemId = $(this).attr('data-flyer-record-id');
    var flyerEditLink = "/admin/flyer/" + flyerItemId + "/edit";
    console.log(flyerEditLink);
    
    modal
        .on('show.bs.modal', function() {
            modalBody.load(flyerEditLink);
        })
        .modal({show:true})
        .on('shown.bs.modal', function () {
            // $('#foldername').focus();
        });
    
    e.preventDefault();
});

$('.cancel-modal').click(function(e) {

	var modalBody = $('#mmmm-modal .modal-content');
	modalBody.empty();
});