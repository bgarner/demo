$(document).ready(function() {

    var updateDocument = $(document).on('click','.meta-data-add',function(){

        var token = $('meta[name="csrf-token"]').attr('content');
        var fileIdVal = $(this).attr('data-id');
        var titleVal = $("#title"+fileIdVal).val();
        var descriptionVal = $("#description"+fileIdVal).val();

        var tag_selector = "#select" + fileIdVal ;
        var tags = $(tag_selector).val();

        var selector = "#metadataform"+fileIdVal;
        var check = "#checkmark"+fileIdVal;
        
        console.log(tags);
        $.post("/admin/video/add-meta-data",{ video_id: fileIdVal, title: titleVal, description: descriptionVal, _token:token , tags: tags})
            .done( function(data){
                $(check).fadeIn(1000);
                $('.error').remove()
            });
        return false;
    });

    $(".meta-data-done").on("click", function(){
        var updateButtons = $(".meta-data-add");
        for (var i=0 ; i<updateButtons.length; i++) {
            updateButtons[i].click();
        }
        var folder_id = $("input[name='folder_id']").val()
        window.location ='/admin/video';
    });

});