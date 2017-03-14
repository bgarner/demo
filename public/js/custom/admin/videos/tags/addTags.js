$(document).on('click','.tag-create',function(){
  	
  	var hasError = false;

    var tagName = $("#tag_name").val();
    var bannerId = localStorage.getItem('admin-banner-id');
    
    console.log(tagName +", "+ bannerId );

    if(tagName == '') {
		swal("Oops!", "This we need a tag name.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;

	}
	  
	if(hasError == false) {
		$.ajax({
		    url: '/admin/tag',
		    type: 'POST',
		    data: { tag_name: tagName,  banner_id: bannerId },
		    success: function(result) {
		        $("#tag_name").val(""); // empty the form
				swal("Nice!", "'" + tagName +"' has been created", "success");        
		    }
		});
	}
	
    return false;
});