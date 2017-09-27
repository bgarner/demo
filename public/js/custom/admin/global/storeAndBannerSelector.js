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
		console.log(selected);
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

	var options = $( ".chosen option:selected" );
	var targetStores = [];
	
	for (var i = 0; i < options.length; i++) {
	    
	    var parentBanner = $(options[i]).attr('data-parentBanner');
	    if(parentBanner){
	    	var store = $(options[i]).val();
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
	    	var banner = $(options[i]).val()
	    	targetBanners.push( banner );
	    	
	    }	    

	}
	return targetBanners;
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