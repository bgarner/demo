var allStores;
var targetBanners = [], targetStores = [];
$(document).ready(function(){

	$(".chosen-select").chosen({
		'width':'100%'
	})
	
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
$("body").on('paste', '.search-field input', function(e) {
	
	setTimeout(function(e) {
	    processStorePaste();
	  }, 5);
        

});

var processStorePaste = function(){

    	var storesString = $(".search-field").find('input').val();
    	var stores = storesString.split(',');
    	$(stores).each(function(i){
    		stores[i]= stores[i].replace(/\s/g, '');

    		if(stores[i].length == 3) {
    			stores[i] = "0"+stores[i];
    		}
    		
			$("#targets option[value='"+  stores[i] +"']").attr('selected', 'true');

    	});
    	$("#targets").trigger("chosen:updated");
    	var selectedStoresCount = $('#targets option:selected').length;
};

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

	var featuredOn = $("#featuredOn").val();

	console.log(featured);
	console.log(featuredOn);


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
		    	featuredOn : featuredOn,
		    	targetStores : getTargetStores(),
		    	targetBanners : getTargetBanners(),
		    	allStores : allStores

		    },
		    
		    success: function(result) {
		       	
		    		console.log(result);
					swal("Nice!", "'" + title +"' has been updated", "success");

		    }
		});
    }


    return false;
});


