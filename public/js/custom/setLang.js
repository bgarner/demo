$('.setUserLang').click(function(){

	var lang = $(this).data('lang');
    var langname = $(this).data('langname');
    console.log(lang);

	$.ajax({
	    url: '/setLanguage',
	    type: 'POST',
	    data: {
	  		lang: lang
	    },

	}).done(function(response){

        location.reload();

	});

});
