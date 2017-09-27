var allStores;
$(document).ready(function(){

	
	// $(".chosen-select").chosen({
	// 	'width':'100%'
	// })
	initializeTagSelector();

	// storeSelect = $('#targets');
	// var optGroupSelections = $("#optGroupSelections").val();
	// if(typeof(optGroupSelections) !== 'undefined'){

	// 	var selected = JSON.parse(optGroupSelections);  
	// 	selected = Array.from(new Set(selected));
	// 	storeSelect.val(null);
	// 	storeSelect.val(selected);
	// 	storeSelect.trigger('chosen:updated');	
	// }
	
});

// $("#targets").on('change', function (event,el) {

// 	var options = $( ".chosen option:selected" );
// 	allStores = 'off';
	
// 	if(el.hasOwnProperty('deselected')){
// 		$("option[data-parentBanner='"+ el.deselected +"']").attr("disabled",false);
// 		$(".chosen").trigger("chosen:updated");
// 	}
// 	for (var i = 0; i < options.length; i++) {
	   
// 	    var isAllStoreSelected = $(options[i]).attr('data-allStores');
// 	    if(isAllStoreSelected){
	    	
// 	    	var banner = $(options[i]).val()

// 	    	var storesInBanner = $("option[data-parentBanner='"+ banner +"']:selected");
// 			storesInBanner.attr('selected', false);
// 	    	var itemToDisable = $("option[data-parentBanner='"+ banner +"']");
// 			itemToDisable.attr("disabled",true);
// 			$(".chosen").trigger("chosen:updated");
	    	
// 	    }	    

// 	}
	
// });

// $("body").on('paste', '.search-field input', function(e) {
	
// 	setTimeout(function(e) {
// 	    processStorePaste();
// 	  }, 5);
        

// });

// var processStorePaste = function(){

//     	var storesString = $(".search-field").find('input').val();
//     	var stores = storesString.split(',');
//     	$(stores).each(function(i){
//     		stores[i]= stores[i].replace(/\s/g, '');

//     		if(stores[i].length == 3) {
//     			stores[i] = "0"+stores[i];
//     		}
    		
// 			$("#targets option[value='"+  stores[i] +"']").attr('selected', 'true');

//     	});
//     	$("#targets").trigger("chosen:updated");
//     	var selectedStoresCount = $('#targets option:selected').length;
// };

// var getTargetStores = function(){

// 	var options = $( ".chosen option:selected" );
// 	var targetStores = [];
	
// 	for (var i = 0; i < options.length; i++) {
	    
// 	    var parentBanner = $(options[i]).attr('data-parentBanner');
// 	    if(parentBanner){
// 	    	var store = $(options[i]).val();
// 	    	targetStores.push(store);
// 	    }    

// 	}
// 	return targetStores;

// }

// var getTargetBanners = function(){
	

// 	var options = $( ".chosen option:selected" );
// 	var targetBanners = [];
// 	allStores = 'off';
	
// 	for (var i = 0; i < options.length; i++) {
	 
// 	    var isAllStoreSelected = $(options[i]).attr('data-allStores');
// 	    if(isAllStoreSelected){
// 	    	allStores = 'on';
// 	    	var banner = $(options[i]).val()
// 	    	targetBanners.push( banner );
	    	
// 	    }	    

// 	}
// 	return targetBanners;
// }


var initializeTagSelector = function(){
	
	$("#tags").select2({ 
		width: '100%' , 
		tags: true,
		multiple: true,
		createTag: function (params) {
    		var term = $.trim(params.term);

		    if (term === '') {
		      return null;
		    }

		    return {
		      id: term, //id of new option 
		      text: term, //text of new option 
		      newTag: true
		    }
		}
	});
}

$("body").on('select2:select', $("#tags"), function (evt) {

		var video_id = $("#videoId").val();
	    if(evt.params.data.newTag){
	    	$.post("/admin/tag",{ tag_name: evt.params.data.text })
	    	.done(function(tag){
	    		
	    		//change the id of the newly added tag to be the id from db
				$('#tags option[value="'+tag.name+'"]').val(tag.id);
				
				var selectedTags = $("#tags").val();
				//update tag video mapping
				$.post("/admin/videotag",{ 'video_id' : video_id, 'tags': selectedTags })
				.done(function(){
					$('#tags').select2('destroy');
					$("#tag-selector-container").load("/admin/videotag/"+video_id, function(){
						initializeTagSelector();
						$("#tags").focus();

					});	
				});				

	    	});
	    }

	});

$(document).on('click','.video-update',function(){
  	
 	
  	var hasError = false;

 	var videoId = $("#videoId").val();
 	
 	var title = $("#title").val();
	
	var description = $("#description").val();
	
	var featured = $("#featured:checked").val();

	var featuredOn = $("#featuredOn").val();

	var tags = $("#tags").val();
	
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
		    	target_stores : getTargetStores(),
		    	target_banners : getTargetBanners(),
		    	all_stores : getAllStoreStatus()

		    },
		    
		    success: function(result) {
		       	
		    		console.log(result);
					swal("Nice!", "'" + title +"' has been updated", "success");

		    }
		});
    }


    return false;
});


