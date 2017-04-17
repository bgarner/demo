$(".flyerItem").on('click', function(e){

	var modal = $('#mmmm-modal');
    var modalBody = $('#mmmm-modal .modal-content');
    
    modalBody.empty();
    var flyerItemId = $(this).attr('data-flyer-item-id');
    var flyerEditLink = "/admin/flyeritem/" + flyerItemId + "/edit";
    
    modal
        .on('show.bs.modal', function() {
            modalBody.load(flyerEditLink);
        })
        .modal({show:true})
        .on("hidden.bs.modal", function() {
            modalBody.empty();
            modal.unbind('show.bs.modal');
        });
    
    e.preventDefault();
});

$('.cancel-modal').click(function(e) {

	var modalBody = $('#mmmm-modal .modal-content');
	modalBody.empty();
});


$(".addFlyerItem").on('click', function(e){

    e.preventDefault();
    var modal = $('#mmmm-modal');
    var modalBody = $('#mmmm-modal .modal-content');
    localStorage.setItem('lastClickedtoTriggerModal', $(this).attr('data-folderId') );

    modalBody.empty();
    var flyerId = $(this).attr('data-flyer-id');
    console.log(flyerId);
    var flyerEditLink = "/admin/flyeritem/create";
    
    modal
        .on('show.bs.modal', function() {
            modalBody.load(flyerEditLink);
        })
        .modal({show:true})
        .on('shown.bs.modal', function () {
            $('#flyer_id').val(flyerId);
        });
    
});


$(".editFlyer").on('click', function(e){

    e.preventDefault();
    var modal = $('#mmmm-modal');
    var modalBody = $('#mmmm-modal .modal-content');
    // localStorage.setItem('lastClickedtoTriggerModal', $(this).attr('data-folderId') );

    modalBody.empty();
    var flyerId = $(this).attr('data-flyer-id');
    var flyerEditLink = "/admin/flyer/" + flyerId +"/edit";
    
    modal
        .on('show.bs.modal', function() {
            console.log('hi');
            modalBody.load(flyerEditLink);
        })
        .modal({show:true})
        .on('shown.bs.modal', function () {
            $('#flyer_id').val(flyerId);
        })
        .on("hidden.bs.modal", function() {
            modalBody.empty();
            modal.unbind('show.bs.modal');
        });
    
});

$("body").on("change paste keyup",  ".pmm_number", function() {
   var updated_pmm = $(this).val(); 
   $(this).parent().find('img').attr('src', 'https://fgl.scene7.com/is/image/FGLSportsLtd/'+updated_pmm+
                                            '_99_a?bgColor=0,0,0,0&fmt=png-alpha&hei=150&resMode=sharp2&op_sharpen=1');

});


$("body").on("click", ".remove_pmm", function() {

   $(this).parent().hide(200).remove();

});

$("body").on("click",  ".add_more_pmm", function() {
    $(this).parent().find('.row').append(
            
                '<div class="col-sm-4 col-md-4">'+
                    '<i class="fa fa-times remove_pmm" title="Remove PMM" ></i>'+
                    '<input type="text" name="pmm[]" class="form-control pmm_number" placeholder="Add PMM">'+
                    '<img src="">'+
                '</div>'
            

        );

});
