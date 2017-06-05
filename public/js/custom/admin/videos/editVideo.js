var allStores;
var targetBanners = [], targetStores = [];
$(document).ready(function(){
	
	$(".chosen").on('change', function (event,el) {

		var options = $( ".chosen option:selected" );
		targetBanners = [], targetStores = [];
		allStores = 'off';
		
		if(el.hasOwnProperty('deselected')){
			$("option[data-parentBanner='"+ el.deselected +"']").attr("disabled",false);
			$(".chosen").trigger("chosen:updated");
		}
		for (var i = 0; i < options.length; i++) {
		    
		    var parentBanner = $(options[i]).attr('data-parentBanner');
		    if(parentBanner){
		    	var store = $(options[i]).val();
		    	targetStores.push({"store": store, 'banner': parentBanner});
		    }

		    var isAllStoreSelected = $(options[i]).attr('data-allStores');
		    if(isAllStoreSelected){
		    	allStores = 'on';
		    	var banner = $(options[i]).val()
		    	targetBanners.push( banner );

		    	var storesInBanner = $("option[data-parentBanner='"+ banner +"']:selected");
				storesInBanner.attr('selected', false);
		    	var itemToDisable = $("option[data-parentBanner='"+ banner +"']");
				itemToDisable.attr("disabled",true);
				$(".chosen").trigger("chosen:updated");
		    	
		    }


		    

		}
		
	});
	
});

var getTargetStores = function(){

	$.each(targetBanners, function(i, value){
		for(i in targetStores){
			if(targetStores[i].banner == value){
				targetStores.splice(i);
			}
		}
	});
	//flatten the array ; remove banner key
	return targetStores;
}

var getTargetBanners = function(){
	return targetBanners;
}


$(document).on('click','.video-update',function(){
  	
 	
  	var hasError = false;
 	var videoId = $("#videoId").val();
 	
 	var title = $("#title").val();
	
	var description = $("#description").val();
	
	// var banner_id = $("input[name='banner_id']").val();
	
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
		    	featured : featured,
		    	targetStores : getTargetStores(),
		    	targetBanners : getTargetBanners(),
		    	allStores : allStores,
		    	

		    },
		    
		    success: function(result) {
		       	
		    		console.log(result);
					swal("Nice!", "'" + title +"' has been updated", "success");

		    }
		});
    }


    return false;
});


