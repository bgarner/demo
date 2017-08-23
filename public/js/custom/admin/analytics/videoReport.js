$(document).ready(function(){

	$("#generateVideoReport").click(function(){
		var start_date = $("#start_date").val();
		var end_date = $("#end_date").val();
			
		$.ajax({
		    url: '/admin/videoanalytics' ,
		    type: 'GET',
		    data: { start: start_date, end:end_date},
		    success: function(result) {
		    }
		}).done(function(response){
			$("#video_analytics_by_store").removeClass('hidden');
			var container = $("#video_analytics_by_store").find("tbody");
			container.empty();
			$(response).each(function(key, value){
				var string = "<tr>"
				string += '<td></td>';
				string += '<td>'+value.store_number+'</td>';
				string += '<td>'+value.total_views+'</td>';
				string += "</tr>";
				$( container ).append( string );

			});
		});
	});
});