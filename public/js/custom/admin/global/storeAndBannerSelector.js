var allStores;
$(document).ready(function(){
	$(".chosen").chosen({
		'width':'100%'
	})
	$(".chosen-select").chosen({
		'width':'100%'
	})
	storeSelect = $('#targets');

	var optGroupSelections = $("#optGroupSelections").val();
	if(typeof(optGroupSelections) !== 'undefined'){

		var selected = JSON.parse(optGroupSelections);  
		selected = Array.from(new Set(selected));
		storeSelect.val(null);
		storeSelect.val(selected);
		storeSelect.trigger('chosen:updated');	
	}
});


$("#targets").on('change', function (event,el) {

	var options = $( ".chosen option:selected" );
	allStores = 'off';
	
	if(el.hasOwnProperty('deselected')){
		$("option[data-parentBanner='"+ el.deselected +"']").attr("disabled",false);
		$(".chosen").trigger("chosen:updated");
	}
	for (var i = 0; i < options.length; i++) {
	   
	    var isAllStoreSelected = $(options[i]).attr('data-allStores');
	    if(isAllStoreSelected){
	    	
	    	var banner = $(options[i]).val()

	    	var storesInBanner = $("option[data-parentBanner='"+ banner +"']:selected");
			storesInBanner.attr('selected', false);
	    	var itemToDisable = $("option[data-parentBanner='"+ banner +"']");
			itemToDisable.attr("disabled",true);
			$(".chosen").trigger("chosen:updated");
	    	
	    }	    

	}
	
});
	
$("body").on('paste', '.search-field input', function(e) {
	
	console.log("this is pasting");
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
			$("#targets option[value='store"+  stores[i] +"']").prop('selected', 'true');

    	});
    	$("#targets").trigger("chosen:updated");
    	var selectedStoresCount = $('#targets option:selected').length;
    	console.log(selectedStoresCount);
};

var getTargetStores = function(){

	var options = $( ".chosen option:selected" );
	var targetStores = [];
	
	for (var i = 0; i < options.length; i++) {
	    
	    var type = $(options[i]).attr('data-optiontype');
	    if(type == 'store'){
	    	var store = $(options[i]).attr('data-resourceid');
	    	targetStores.push(store);
	    }    

	}
	return targetStores;

}

var getTargetBanners = function(){
	

	var options = $( ".chosen option:selected" );
	var targetBanners = [];
	allStores = 'off';
	
	for (var i = 0; i < options.length; i++) {
	 
	    var isAllStoreSelected = $(options[i]).attr('data-allStores');
	    if(isAllStoreSelected){
	    	allStores = 'on';
	    	var banner = $(options[i]).attr('data-resourceid');
	    	targetBanners.push( banner );
	    	
	    }	    

	}
	return targetBanners;
}

var getStoreGroups = function(){

	var options = $( ".chosen option:selected" );
	var storeGroups = [];
	
	for (var i = 0; i < options.length; i++) {
	    
	    var type = $(options[i]).attr('data-optiontype');
	    if(type == 'storegroup'){
	    	var group = $(options[i]).attr('data-resourceid');
	    	storeGroups.push(group);
	    }    

	}
	return storeGroups;
}

var getAllStoreStatus = function()
{
	var options = $( ".chosen option:selected" );
	allStores = 'off';
	
	for (var i = 0; i < options.length; i++) {
	 
	    var isAllStoreSelected = $(options[i]).attr('data-allStores');
	    if(isAllStoreSelected){
	    	allStores = 'on';
	    }	    

	}
	return allStores;
}