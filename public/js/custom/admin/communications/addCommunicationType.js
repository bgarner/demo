$(document).ready(function(){
	$(".chosen").chosen({
		'width':'100%'
	});

});

$(document).on('click','.communicationtype-create',function(){
  	
  	var hasError = false;

    var communicationTypeName = $("#communication_type").val();
    var banners = $("#banners").val();
    var colour = $("input:radio[name='colour']:checked").val();

    // console.log(communicationTypeName +", "+ bannerId +", "+ colour);

    if(communicationTypeName == '') {
		swal("Oops!", "This we need a name for this communication type.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;

	}
	  if(typeof colour === 'undefined') {
		swal("Oops!", "This we need a tag color for this communication type.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;

	}		

	if(hasError == false) {
		$.ajax({
		    url: '/admin/communicationtypes',
		    type: 'POST',
		    data: { communication_type: communicationTypeName, colour: colour, banners: banners },
		    success: function(result) {
		        // $("#communication_type").val(""); // empty the form
				swal("Nice!", "'" + communicationTypeName +"' has been created", "success");        
		    }
		});
	}
	
    return false;
});