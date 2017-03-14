$("#add-more-notes").on('click', function(){
	console.log('add more notes');
	$("#new-note").modal('show');
});

$("#feedback_status").on('change', function(){
	console.log('send ajax to update status');
	updateStatus();
});

$("#feedback_category").on('change', function(){
	console.log('send ajax to update category');
	updateCategory();
});

$("#followed_up").on('change', function(){
	console.log('updated followed_up');
	updateFollowup();
});

var updateStatus = function(){
	var feedbackId = $("#feedbackID").val();
	var feedback_status_id = $("#feedback_status").val();

	console.log(feedback_status_id);
	$.ajax({
		type: "PATCH",
		url: '/admin/feedback/' + feedbackId,
		data: {'feedback_status_id' : feedback_status_id },
		dataType: 'json'
	}).done(function(response){
			console.log(response);	
	});
	return;
}

var updateCategory = function(){
	var feedbackId = $("#feedbackID").val();
	var feedback_category_id = $("#feedback_category").val();

	console.log(feedback_category_id);
	$.ajax({
		type: "PATCH",
		url: '/admin/feedback/' + feedbackId,
		data: {'feedback_category_id' : feedback_category_id },
		dataType: 'json'
	}).done(function(response){
			console.log(response);	
	});
	return;
}

var updateFollowup = function(){
	var feedbackId = $("#feedbackID").val();
	var followed_up ;
	if($("#followed_up").prop('checked')){
		followed_up = 1;
	}
	else{
		followed_up = 0;
	}
	
    console.log(followed_up);
    $.ajax({
		type: "PATCH",
		url: '/admin/feedback/' + feedbackId,
		data: {'feedback_follow_up' : followed_up },
		dataType: 'json'
	}).done(function(response){
		console.log(response);
	});
}



$('.createNote').click(function(){

	var note = $("#note").val();
	var feedback_id = $("#feedback_id").val();

	$.ajax({
	    url: '/admin/feedback/' + feedback_id + '/note',
	    type: 'POST',
	    data: {
	  		
	  		note: note,
	  		feedback_id : feedback_id
	    },
	    success: function(result) {
	        
			swal({
		        title: "Nice!",
		        text: "Note added",
		        type: "success"
		    });     
	    }
	}).done(function(response){
		$("#note").val('');
	}); 
    
});



$('.editNote').click(function(){

	var note = $("#note").val();
	var feedback_id = $("#feedback_id").val();

	$.ajax({
	    url: '/admin/feedback/' + feedback_id + '/note',
	    type: 'POST',
	    data: {
	  		
	  		note: note,
	  		feedback_id : feedback_id
	    },
	    success: function(result) {
	        
			swal({
		        title: "Nice!",
		        text: "Note added",
		        type: "success"
		    });     
	    }
	}).done(function(response){
		$("#note").val('');
	}); 
    
});

$(".feedback-note").bind("enterKey",function(e){
   var note_id = $(this).data('note-id');
   var feedback_id = $("#feedback_id").val();
   console.log(note_id);
   $.ajax({
	    url: '/admin/feedback/' + feedback_id + '/note/' + note_id,
	    type: 'PATCH',
	    data: {
	  		
	  		note: $(this).val(),
	  		feedback_id : feedback_id,
	  		note_id : note_id
	    },
	    success: function(result) {
	        
			swal({
		        title: "Nice!",
		        text: "Note added",
		        type: "success"
		    });     
	    }
	}).done(function(response){
		$("#note").val('');
	}); 
});

$('.feedback-note').keyup(function(e){
    if(e.keyCode == 13)
    {
        $(this).trigger("enterKey");
    }
});

