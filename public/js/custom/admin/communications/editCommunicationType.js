$(document).ready(function(){
	$(".chosen").chosen({
		'width':'100%'
	});

});
$(document).on('click','.communicationtype-edit',function(){
  	
  	var hasError = false;

    var communicationTypeName = $("#communication_type").val();
    var commTypeId = $("#communicationTypeId").val();
    var banners = $("#banners").val();
    var colour = $("input:radio[name='colour']:checked").val();

    console.log(communicationTypeName +", "+ banners +", "+ colour + ", "+ commTypeId);

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
		    url: '/admin/communicationtypes/' + commTypeId,
		    type: 'PATCH',
		    data: { communication_type: communicationTypeName, colour: colour, banners: banners },
		    success: function(result) {
		        // $("#communication_type").val(""); // empty the form
				swal("Nice!", "'" + communicationTypeName +"' has been updated", "success");        
		    }
		});
	}
	
    return false;
});