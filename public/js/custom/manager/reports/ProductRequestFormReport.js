$(document).ready(function(){
    var departments = getDepartments();
    $("#department").empty();
    $("#department").append('<option value=""> Select </option>');
    $(departments).each(function(i,item){
        $("#department").append('<option data-dept="' + item.dept_abbr + '" value="' + item.department_name + '">'+ item.department_name+ '</option>');     
    });
});

var downloadReport = function(rawToDateData){
    console.log(rawToDateData);
    var data = rawToDateData;
    if(data == '')
        return;
    var fileName = "ProductRequestReport_";
    JSONToCSVConvertor(data, "Product Request Report", true, fileName);
}

$("#filter_report").click(function(){
	var dept = $("#department").val();
	var category = $("#category").val();
	var subcat = $("#subcategory").val();

	$(".current-filter").empty();
	$(".current-filter").append("Selected Filter : ");
	if(dept != ''){
		$(".current-filter").append( dept);	
	}
	else{
		$(".current-filter").append("No Filters");		
	}
	if(category!= ''){
		$(".current-filter").append(" > "+ category);
	}
	if(subcat!= ''){
		$(".current-filter").append(" > "+ subcat);
	}

	var filters = {
		'department' : dept,
		'category'	: category,
		'subcategory' : subcat
	};
	
	$.ajax({
	    url: '/manager/report/productrequest',
	    type: 'PATCH',
	    dataType: 'json',
	    data: {
			filters : filters
	    },

	    success: function(data) {
	      	var toDate = data.toDate;
			var sinceLastWeek = data.sinceLastWeek;
			var rawToDateData = data.rawToDateData;
			// console.table(rawToDateData);
		       
			$("#toDateTable tbody").empty();
			$(toDate).each(function(){

		      	$("#toDateTable tbody")
		      		.append("<tr><td>"+ this.resolution_code +"</td>"+
						"<td>"+ this.count +"</td>"+
						"<td>"+ this.percentage +"%</td>"+
		      			"</tr>");
			});

			$("#sinceLastWeekTable tbody").empty();
			$(sinceLastWeek).each(function(){

			$("#sinceLastWeekTable tbody")
		      		.append("<tr><td>"+ this.resolution_code +"</td>"+
						"<td>"+ this.count +"</td>"+
						"<td>"+ this.percentage +"%</td>"+
		      			"</tr>");
			});

	       	$('#download_report').removeClass('hidden');
       		$('#download_report').click(function(){
       			downloadReport(rawToDateData);
       		});
	      
	    }
	});


});

