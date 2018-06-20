$( document ).ready(function() {

	var pathArray = window.location.pathname.split( '/' );

	//binding for the "logout" button
	$("#storeswitch").click(function() {
		resetStore();
		return;
	});

	// if( !!localStorage.getItem('userStoreNumber')){
	// 	window.location="/";
	// }

	//direct to the dashboard if the localStorage value is set
	if( !!localStorage.getItem('userStoreNumber') && window.location.pathname == "/" ) {
		window.location="/" + localStorage.getItem('userStoreNumber');
	}

	//redirect to the store chooser if the localStorage value is not set
	if( localStorage.getItem('userStoreNumber') == null && window.location.pathname != "/" ) {
		window.location="/";
	}

	//redirect to store as set in localStorage in the event of a change to the URL
	if( window.location.pathname != "/"  && localStorage.getItem('userStoreNumber') != pathArray[1] )
	{
		window.location="/" + localStorage.getItem('userStoreNumber');
	}

	//store selection logic
	var bannerDropdown = document.getElementById('bannerSelect');
	var storeDropdown = document.getElementById('storeSelect');

	if(bannerDropdown) {

		getBanners();

		bannerDropdown.onchange = function() {
			localStorage.setItem('userBanner', bannerDropdown.options[bannerDropdown.selectedIndex].value);
			getStores( localStorage.getItem('userBanner') );
		}
		storeDropdown.onchange = function() {
			localStorage.setItem('userStoreNumber', storeDropdown.options[storeDropdown.selectedIndex].value);
			localStorage.setItem('userStoreName', storeDropdown.options[storeDropdown.selectedIndex].text);
			window.location="/" + localStorage.getItem('userStoreNumber');
		}
	}

});

var getBanners = function()
{
    var jqxhr = $.getJSON( STORE_API_DOMAIN + "/banners", function(json) {

    var i=0;
        $.each(json, function(index, element) {
            $("#bannerSelect").append("<option value='"+ element.id +"'>"+ element.name +"</option>");
            i++;
        });
    })
}

var getStores = function(banner)
{
	$("#storeSelect").empty();
	$("#storeSelect").append("<option></option>");
	var jqxhr = $.getJSON( STORE_API_DOMAIN + "/banner/" + banner + "/stores", function(json) {
 
    var i=0;
        $.each(json, function(index, element) {
            $("#storeSelect").append("<option value='"+ element.store_number +"'>"+ element.store_number + " " + element.name +"</option>");
            i++;
        });
    })
}

var resetStore = function()
{
	// localStorage.removeItem('userBanner');
	// localStorage.removeItem('userStoreNumber');
	// localStorage.removeItem('userStoreName');

	localStorage.setItem('userBanner', '');
	localStorage.setItem('userStoreNumber', '');
	localStorage.setItem('userStoreName', '');	

	window.location="/";
}
