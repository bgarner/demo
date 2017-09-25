$(document).ready(function(){

	var banner = localStorage.getItem('admin-banner');
	if(!banner){
		$(".current-banner").text( "Select a Banner" );
		$(".banner-icon").removeClass("fa-flag").addClass("fa-exclamation-triangle");
        $(".current-banner-anchor").addClass("banner-not-set");
	}

	console.log('selected banner : ' + localStorage.getItem('admin-banner'));
	$(".current-banner").append(localStorage.getItem('admin-banner'));

	$(".banner-switch").click(function(){

		localStorage.setItem('admin-banner-id', $(this).attr('data-banner-id'));
		localStorage.setItem('admin-banner', $(this).text());

		var banner_id = localStorage.getItem("admin-banner-id");
		var banner = localStorage.getItem("admin-banner");

		$(".banner-icon").removeClass("fa-exclamation-triangle").addClass("fa-flag");
        $(".current-banner-anchor").removeClass("banner-not-set");
		console.log('banner_id' + banner_id);

		$.ajax({
			method : "PATCH",
			url : "/admin/banner/" + banner_id ,
			data : { "_token" : $('[name="_token"]').val()}
		}).done(function( data ){
			console.log(data);
			$(".navbar-brand").find('span').append( banner );
			window.location = '/admin/home';
		});

	})
});
