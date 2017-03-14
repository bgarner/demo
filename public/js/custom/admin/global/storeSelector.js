var comboStores = {
						339 : 'A0339',	
						243 : 'A0243',	
						357 : 'A0357',	
						259 : 'A0259',	
						274 : 'A0274',	
						314 : 'A0314',	
						419 : 'A0419',	
						277 : 'A0277',	
						272 : 'A0272',
						334 : 'A0334',
						317 : 'A0317',
						386 : 'A0386',
						5120 : 'A5120',
						260 : 'A0260',
						345 : 'A0345',
						348 : 'A0348',
						5134 : 'A5134',
						5122 : 'A5122',
						296 : 'A0296',
						320 : 'A0320',	
						323 : 'A0323',
						5142 : 'A5142',
						5148 : 'A5148',
						300 : 'A0300',
						313 : 'A0313',
						5128 : 'A5128',
						5143 : 'A5143'
				};

$("body").on('paste', '.search-field input', function(e) {
	
	setTimeout(function(e) {
	    processStorePaste();
	  }, 5);
        

});

var processStorePaste = function(){

		var bannerId = localStorage.getItem('admin-banner-id')
    	var storesString = $(".search-field").find('input').val();
    	var stores = storesString.split(',');
    	$(stores).each(function(i){
    		stores[i]= stores[i].replace(/\s/g, '');
    		console.log(stores[i]);
    		

    		if(bannerId == 2 && comboStores[stores[i]] != undefined){
    			stores[i] = comboStores[stores[i]];
    		
    		}

    		if(stores[i].length == 3) {
    			stores[i] = "0"+stores[i];
    		}
    		
			$("#storeSelect option[value='"+  stores[i] +"']").attr('selected', 'selected');    		
    	});
    	console.log(stores);
    	$("#storeSelect").val(stores).trigger("chosen:updated");
    	var selectedStoresCount = $('#storeSelect option:selected').length;
    	console.log(selectedStoresCount);
};