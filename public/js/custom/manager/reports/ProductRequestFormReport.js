var toDateProductRequestTable;
var lastWeekProductRequestTable;

$(document).ready(function(){
    var departments = getDepartments();
    $("#department").empty();
    $("#department").append('<option value=""> Select </option>');
    $(departments).each(function(i,item){
        $("#department").append('<option data-dept="' + item.dept_abbr + '" value="' + item.department_name + '">'+ item.department_name+ '</option>');     
    });

    toDateProductRequestTable = $("#toDateProductRequestReport").tableExport({
        formats: [ 'csv'], 
    });
    lastWeekProductRequestTable = $("#lastWeekProductRequestReport").tableExport({
        formats: ['csv'], 
    });
});


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

	       	toDateProductRequestTable.update({
	       		formats: [ 'csv']
	       	});
	       	lastWeekProductRequestTable.update({
	       		formats: [ 'csv']
	       	});
	      
	    }
	});


});