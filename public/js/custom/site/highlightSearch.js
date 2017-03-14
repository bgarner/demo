$(document).ready(function(){

	var query = $(".search-query").text();
	var query_terms = query.split(" ");

	console.log(query_terms);

	$(query_terms).each(function(index){
		var term = query_terms[index];
		console.log(term);
		console.log(typeof(term));
		// $( '.mail-subject:contains("'+ term +'")' ).css( "background", "yellow" );

	})

});