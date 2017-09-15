var allStores;
$(document).ready(function(){
	$(".chosen").chosen({
		'width':'100%'
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
    		
			$("#storeSelect option[value='"+  stores[i] +"']").attr('selected', 'true');

    	});
    	$("#storeSelect").trigger("chosen:updated");
    	var selectedStoresCount = $('#storeSelect option:selected').length;
};

var getTargetStores = function(){

	var options = $( "#storeSelect option:selected" );
	var targetStores = [];
	
	for (var i = 0; i < options.length; i++) {
	    
	    var isStoreGroup = $(options[i]).attr('data-isStoreGroup');
	    if(!isStoreGroup){
	    	var store = $(options[i]).val();
	    	if(targetStores.indexOf(store) < 0){
	    		targetStores.push(store);	
	    	}
	    	
	    }else{
	    	var stores = $.parseJSON($(options[i]).attr('data-stores'));
	    	
	    	$(stores).each(function(index, value){
	    		if(targetStores.indexOf(value) < 0){
		    		targetStores.push(value);	    		
		    	}
	    	});

	    }   

	}
	return targetStores;

}