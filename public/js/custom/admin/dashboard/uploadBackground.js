var banner_id = $('#banner_id').val();

$("body").on("click", ".fileinput-upload-button", function(e) {

	event.stopPropagation(); 
	event.preventDefault(); 

	var file = $('input[id="dashboardbackground"]')[0].files[0];

    var data = new FormData();
        
	data.append("banner_id", banner_id);        
    data.append('background', file);

    console.log(banner_id);
        
        $.ajax({
            url: '/admin/dashboardbackground',
            type: 'POST',
            data: data, 
            dataType : 'json',
      			processData: false,  
      			contentType: false,
                success: function(result) {
                    console.log(result); 
                    if(result.validation_result == 'false') {
                        var errors = result.errors;
                        if(errors.hasOwnProperty("background")) {
                            $.each(errors.background, function(index){
                                $(".file-preview").parent().parent().append('<div class="req">' + errors.background[index]  + '</div>'); 
                            });   
                        }
                    }

                    else{
                        console.log(result);
                        swal("Nice!", "'" + file.name +"' has been uploaded", "success");   
                        $('.fileinput-remove').trigger( "click" ); //reset the form 
                      
                        $.get( "/admin/dashboardbackground/"+banner_id, { },
                            function(data) {
                              $("#background-preview").attr("src", "/images/dashboard-banners/"+data);
                            }
                        );   
                    }
                    
                }
            
        });        
});
