var document_id = $('#document_id').val();

$("body").on("click", ".fileinput-upload-button", function(e) {

	event.stopPropagation(); 
	event.preventDefault(); 

	var file = $('input[id="updatedDocument"]')[0].files[0];

    console.log(document_id);
    console.log(file);

    var data = new FormData();
        
	// data.append("document_id", document_id);        
    data.append('document', file);

    console.log(data);
        
        $.ajax({
            url: '/admin/document/' + document_id,
            type: 'POST',
            data: data, 
            dataType : 'json',
  			processData: false,  
  			contentType: false,
            success: function(result) {
                console.log(result); 
                if(result.validation_result == 'false') {
                    var errors = result.errors;
                    if(errors.hasOwnProperty("filename")) {
                        $.each(errors.filename, function(index){
                            $(".file-preview").append('<div class="req">' + errors.filename[index]  + '</div>'); 
                        });   
                    }
                }

                else{
                  console.log(result);
                  swal("Nice!", "'" + $("#title").val() +"' has been replaced", "success");   
                  $('.fileinput-remove').trigger( "click" ); //reset the form 
                }
                
            }
            
        });        
});
