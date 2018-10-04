$(document).ready(function(){
    var departments = getDepartments();
    $("#department").empty();
    $("#department").append('<option value=""> Select </option>');
    $(departments).each(function(i,item){
        $("#department").append('<option data-dept="' + item.dept_abbr + '" value="' + item.department_name + '">'+ item.department_name+ '</option>');     
    });
});


$("#filter_report").click(function(){
	var dept = $("#department").val();
	var category = $("#category").val();
	var subcat = $("#subcategory").val();

	var filters = {
		'department' : dept,
		'category'	: category,
		'subcategory' : subcat
	};

	console.log(filters);

	$(".current-filter ol").empty();
	if(dept != ''){
		$(".current-filter ol").append("<li>"+ dept +"</li>");	
	}
	else{
		$(".current-filter ol").append("<li>No Filters</li>");		
	}
	if(category!= ''){
		$(".current-filter ol").append("<li>"+ category +"</li>");
	}
	if(subcat!= ''){
		$(".current-filter ol").append("<li>"+ subcat +"</li>");
	}
	
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
					"<td>"+ this.percentage +"</td>"+
	      			"</tr>");
	      });

	      $("#sinceLastWeekTable tbody").empty();
	      $(sinceLastWeek).each(function(){

	      	$("#sinceLastWeekTable tbody")
	      		.append("<tr><td>"+ this.resolution_code +"</td>"+
					"<td>"+ this.count +"</td>"+
					"<td>"+ this.percentage +"</td>"+
	      			"</tr>");
	      });


	      
	    }
	});


});