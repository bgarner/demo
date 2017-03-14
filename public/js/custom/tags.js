// $(document).ready(function(){

// 	$("#create-tag").click(function(){
//     	$("#create-tag-modal").modal('show');	
//     });

    
// 	$("#save-tag").click(function(){
// 		var tag = $("input[name='tag_name']").val();
// 		var token = $("input[name='_token']").val();
// 		var banner_id = $("input[name='banner_id']").val();
// 		console.log(banner_id);
// 		var hasError = false;
// 		if(tag == '') {
// 			hasError = true;
// 		}	

// 		if(hasError == false) {
// 			$.ajax({
// 			    url: '/admin/tag',
// 			    type: 'POST',
// 			    data: { 'tag_name': tag, '_token': token, 'banner_id': banner_id},
// 			    success: function(result) {
// 					console.log(result);
// 					// swal("Nice!", "'" + tag +"' has been created", "success");        
// 			    }
// 			});
// 		}
// 	});

// 	$(".delete-tag").click(function(){

// 		var tag_id = $(this).attr('id');
// 		var token = $("input[name='_token']").val();
// 		var parent_row = "#tag-" + tag_id 
// 		$.ajax({
// 		    url: '/admin/tag/' + tag_id ,
// 		    type: 'DELETE',
// 		    data: {'_token' : token},
// 		    success: function(result) {
// 		      	console.log(result);
// 		      	$(parent_row).fadeOut( 1000 );
// 				// swal("Nice!", "'" + eventTitle +"' has been updated", "success");        
// 		    }
// 		});    	

// 	});
	
// });