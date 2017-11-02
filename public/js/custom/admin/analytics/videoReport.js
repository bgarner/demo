$(document).ready(function(){

    var videoTable = $('#video_analytics').DataTable({
    "info"   :false,
    "bPaginate": false,
    "paging":   false,
    "columns": [
       {"visible": false},
       {'width': '40%'},
       {'width': '40%'},
       null,
       {"visible": false},
       {"visible": false},
       {"visible": false}
     ],
     "searching": false
    });

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
			$("#reportJson").val(JSON.stringify(response));
			$("#downloadVideoReport").removeClass('hidden');
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

	$('#downloadVideoReport').click(function(){
        var data = $('#reportJson').val();
        if(data == '')
            return;

        JSONToCSVConvertor(data, "Video Report", true);
    });

    $(".pagination_link").on('click', function(e){
        
        var pageId = $(this).attr('data-pageId');
        $.ajax({
            url: '/admin/paginatedvideos' ,
            type: 'GET',
            data: { page: pageId},
            success: function(result) {
            }
        }).
        done(function(response){
            
            var paginatedVideos = response.videoStats;

            var container = $("#video_analytics").find("tbody");

            var tables = $.fn.dataTable.tables();
            $(tables[3]).DataTable().rows()
                                    .remove()
                                    .destroy();
            
            
            $(paginatedVideos).each(function(key, value){
                var string = "<tr class='video-details-control'>"
                string += '<td></td>';
                string += '<td>'+value.title+'</td>';
                string += '<td><img src="/video/thumbs/'+value.thumbnail+'" style="width: 35%" /></td>';
                string += '<td data-order="'+value.readPerc+'" data-read-perc ='+ value.readPerc+'>';
                string += '<canvas id="videoChart_'+value.id+'" width="45" height="45" style="width: 45px; height: 45px;"></canvas></td>';
                string += '<td >'+value.opened+'</td>';
                string += '<td >'+value.unopened+'</td>';
                string += '<td >'+value.sent_to+'</td>';
                string += "</tr>";
                $( container ).append( string );
            });
                
            $("#previous").attr('data-pageId', response.previousPage);
            $("#next").attr('data-pageId', response.nextPage);

            var videoTable = $('#video_analytics').DataTable({
                "info"   :false,
                "bPaginate": false,
                "paging":   false,
                "columns": [
                   {"visible": false},
                   {'width': '40%'},
                   {'width': '40%'},
                   null,
                   {"visible": false},
                   {"visible": false},
                   {"visible": false}
                 ],
                 "searching": false
            });
            $(paginatedVideos).each(function(key, value){
                
                var ctx = document.getElementById("videoChart_"+value.id).getContext("2d");
                var videoChart = new Chart(ctx).Doughnut(
                [
                    {
                        value: value.opened_total,
                        color: "#ee0000",
                        highlight: "#1ab394"

                    },
                    {
                        value: value.unopened_total,
                        color: "#dedede",
                        highlight: "#1ab394",
                    }
                ], 
                {
                    segmentShowStroke: true,
                    segmentStrokeColor: "#fff",
                    segmentStrokeWidth: 2,
                    percentageInnerCutout: 70, // This is 0 for Pie charts
                    animationSteps: 100,
                    animationEasing: "easeOutBounce",
                    animateRotate: true,
                    animateScale: false,
                    showTooltips: false,
                    onAnimationComplete: function(){
                        
                        var canvas = document.getElementById("videoChart_"+value.id);
                        var ctx = document.getElementById("videoChart_"+value.id).getContext("2d");
                        var cx = canvas.width / 2;
                        var cy = canvas.height / 2;
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        ctx.font = '10px arial';
                        ctx.fillStyle = '#333333';
                        ctx.fillText( value.readPerc + "%", cx, cy);

                    }
                });


            }); //closes loop

        });

    });
    $('#video_analytics tbody').on('click', 'tr.video-details-control', function () {
        var tr = $(this);

        var tables = $.fn.dataTable.tables();
        var videoTable = $(tables[3]).DataTable();

        var row = videoTable.row( tr );
        console.log(row.child);

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );


});

function JSONToCSVConvertor(JSONData, ReportTitle, ShowLabel) {
    //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
    var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;

    var CSV = '';    
    //Set Report title in first row or line

    CSV += ReportTitle + '\r\n\n';

    //This condition will generate the Label/Header
    if (ShowLabel) {
        var row = "";

        //This loop will extract the label from 1st index of on array
        for (var index in arrData[0]) {

            //Now convert each value to string and comma-seprated
            row += index + ',';
        }

        row = row.slice(0, -1);

        //append Label row with line break
        CSV += row + '\r\n';
    }

    //1st loop is to extract each row
    for (var i = 0; i < arrData.length; i++) {
        var row = "";

        //2nd loop will extract each column and convert it in string comma-seprated
        for (var index in arrData[i]) {
            row += '"' + arrData[i][index] + '",';
        }

        row.slice(0, row.length - 1);

        //add a line break after each row
        CSV += row + '\r\n';
    }

    if (CSV == '') {        
        alert("Invalid data");
        return;
    }   

    //Generate a file name
    var fileName = "VideoAnalytics_";
    //this will remove the blank-spaces from the title and replace it with an underscore
    fileName += ReportTitle.replace(/ /g,"_");   

    //Initialize file format you want csv or xls
    var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);

    // Now the little tricky part.
    // you can use either>> window.open(uri);
    // but this will not work in some browsers
    // or you will not get the correct file extension    

    //this trick will generate a temp <a /> tag
    var link = document.createElement("a");    
    link.href = uri;

    //set the visibility hidden so it will not effect on your web-layout
    link.style = "visibility:hidden";
    link.download = fileName + ".csv";

    //this part will append the anchor tag and remove it after automatic click
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
