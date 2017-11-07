$(document).ready(function() {

    var updateDocument = $(document).on('click','.meta-data-add',function(){

        var token = $('meta[name="csrf-token"]').attr('content');
        var fileIdVal = $(this).attr('data-id');
        var titleVal = $("#title"+fileIdVal).val();
        var descriptionVal = $("#description"+fileIdVal).val();

        var tag_selector_container = "#tag-selector-container-" + fileIdVal ;
        var tags = $(tag_selector_container).find(".tags").val();

        var selector = "#metadataform"+fileIdVal;
        var check = "#checkmark"+fileIdVal;
        
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
    initializeTagSelector();
});

var initializeTagSelector = function(selectedTags){
    
    $(".tags").select2({ 
        width: '100%' , 
        tags: true,
        multiple: true,
        createTag: function (params) {
            var term = $.trim(params.term);

            if (term === ''  && $("#tags").find('option').attr("tagname", term).length >0) {
              return null;
            }

            return {
              id: term, //id of new option 
              text: term, //text of new option 
              newTag: true
            }
        }
    });
}

$("body").on('select2:select', $(".tags"), function (evt) {

    var tagContainer = evt.target.closest('.tag-selector-container');
    var video_id = tagContainer.getAttribute('data-videoid');

    if(evt.params.data.newTag){
        $.post("/admin/tag",{ tag_name: evt.params.data.text })
        .done(function(tag){
            
            //change the id of the newly added tag to be the id from db
            $('#tags_' + video_id +' option[value="'+tag.name+'"]').val(tag.id);
            var selectedTags = $("#tags_"+ video_id).val();

            //update tag video mapping
            $.post("/admin/videotag",{ 'video_id' : video_id, 'tags': selectedTags })
            .done(function(){
                $('.tags').select2('destroy');
                $(".tag-selector-container").each(function(index, element){
                    
                    var video = element.getAttribute('data-videoid');
                    $("#tag-selector-container-"+video).load("/admin/videotag/"+video);

                });
                $("#tag-selector-container-"+video_id).load("/admin/videotag/"+video_id, function(){
                    initializeTagSelector();
                    $("#tags_"+ video_id).focus();
                });     
                
            });             

        });
    }

});