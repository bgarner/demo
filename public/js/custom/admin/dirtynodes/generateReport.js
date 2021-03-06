$(document).ready(function(){
	$("#generate_cleaned_nodes_report").on('click', function(){
		var domit = $("#domfields").is(':checked');

		$.ajax({
		    url: '/admin/dirtynodes/report' ,
		    type: 'GET',
		    success: function(result) {
		    }
		}).done(function(response){
            if(domit){
                $.each(response, function(key, value) {
                    delete value.id;
                    delete value.banner;
                    delete value.store;
                    delete value.avp;
                    delete value.dm;
                    delete value.storename;
                    delete value.styledesc;
                    delete value.color;
                    delete value.sizename;
                    delete value.startdate;
                    delete value.week;
                    delete value.starttime;
                    delete value.enddate;
                    delete value.endtime;
                    delete value.quantity;
                    delete value.reasoncode;
                    delete value.product_status_name;
                    delete value.department;
                    delete value.sub_department;
                    delete value.created_at;
                    delete value.updated_at;
                });
                JSONToCSVConvertor(response, "_domit_last24Hours", true);
                return;
            } 
            //if checked, clean the data
			JSONToCSVConvertor(response, "_last24Hours", true);
		});
	});

	$("#advanced_report").on('click', function(){
		$("#advanced_report_modal").modal('show');  
	});

	$("#generate_advanced_report").on('click', function(){
		var start_date = $("#start_date").val();
		var end_date = $("#end_date").val();
        var domit = $("#domfields").is(':checked');
			
		$.ajax({
		    url: '/admin/dirtynodes/report' ,
		    type: 'GET',
		    data: { start: start_date, end:end_date},
		    success: function(result) {
		    }
		}).done(function(response){
            if(domit){
                $.each(response, function(key, value) {
                    delete value.id;
                    delete value.banner;
                    delete value.store;
                    delete value.avp;
                    delete value.dm;
                    delete value.storename;
                    delete value.styledesc;
                    delete value.color;
                    delete value.sizename;
                    delete value.startdate;
                    delete value.week;
                    delete value.starttime;
                    delete value.enddate;
                    delete value.endtime;
                    delete value.quantity;
                    delete value.reasoncode;
                    delete value.product_status_name;
                    delete value.department;
                    delete value.sub_department;
                    delete value.created_at;
                    delete value.updated_at;
                });
                JSONToCSVConvertor(response, "_domit_customrange", true);
                return;
            }

			JSONToCSVConvertor(response, "_customrange", true);
			$("#advanced_report_modal").modal('hide');

		});
	});
})


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
    var fileName = "CleanedNodes_";
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