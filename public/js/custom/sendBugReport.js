$(document).ready(function() {

	$('.sendBugReport').click(function(){

		var banner = localStorage.getItem('userBanner');
		var store_number = $("#bugreport_store_number").val();
		var user = $("#bugreport_user").val();
		var current_url = $("#bugreport_url").val();
		var description = $("#bugreport_desc").val();
		var user_email = $("#bugreport_email").val();
		//var follow_up = $("input:checkbox[name='bugreport_followup']:checked").val();
		var follow_up = $("#bugreport_followup:checked").val();

		if(!follow_up){
			follow_up = 0;
		}

		if(!user_email){
			user_email ="";
		}

		$.ajax({
		    url: '/bugreport',
		    type: 'POST',
		    data: {
		  		banner: banner,
		  		store_number: store_number,
		  		user: user,
		  		current_url: current_url,
		  		description: description,
		  		user_email: user_email,
		  		follow_up: follow_up	
		    },
		    success: function(result) {
		        
				swal({
			        title: "Thanks!",
			        text: "You're helping us build something awesome!",
			        type: "success"
			    });     
		    }
		}).done(function(response){

			$("#bugreport_desc").val('');
			$("#bugreport_email").val('');
			$("#bugreport_followup").attr('checked', false);
			// swal({
		 //        title: "Thanks!",
		 //        text: "You're helping us build something awesome!",
		 //        type: "success"
		 //    });

		}); 
	    
	});

});