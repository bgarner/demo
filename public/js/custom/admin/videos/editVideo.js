$(document).ready(function(){
	
	$(".chosen").on('change', function (event,el) {

		var selected_value  = $(".chosen").val();
		var options = $( ".chosen option:selected" );

		for (var i = 0; i < options.length; i++) {
		    var property = $(options[i]).attr('data-allStores');

		    console.log( "data-allStores :" + property);
		}
		console.log(selected_value);

	});
});
$(document).on('click','.video-update',function(){
  	
 
  	var hasError = false;
 	var videoId = $("#videoId").val();
 	
 	var title = $("#title").val();
	
	var description = $("#description").val();
	
	var banner_id = $("input[name='banner_id']").val();
	var featured = $("#featured:checked").val();

	var tags = $("#tagsSelected").val();
	
     if(hasError == false) {

		$.ajax({
		    url: '/admin/video/' + videoId,
		    type: 'PATCH',
		    data: {
		    	video_id :videoId,
		    	title : title,
		    	description : description,
		    	tags : tags,
		    	featured : featured
		    	

		    },
		    
		    success: function(result) {
		       	
		    		console.log(result);
					swal("Nice!", "'" + title +"' has been updated", "success");

		    }
		});
    }


    return false;
});


