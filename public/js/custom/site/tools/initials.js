var storenumber = localStorage.getItem('userStoreNumber').replace("A", "");
storenumber = storenumber.slice(1);
var currenturl = $(location).attr('href');
var parts = currenturl.split("/");
var division = parts[parts.length-1];

//event bindings
$(document).on('click', 'a.department', function() {
	//this will return a list of SubDepartmnets for the clicked Department
	var department = $(this).data("department");
	var table;
	var element = $(this);
	var tr = $(this).parent();
	// tr.find("i.fa").toggleClass("fa-caret-right").toggleClass('fa-caret-down');
	if(!toggleTable(element)){
		return;
	}
	console.log(element);
	

    $.ajax({
        url: "/tools/productdelivery/subdepartments",
        type: 'get',
        data: {
        	storenumber: storenumber,
        	division: division,
            department: department
        },
        success: function(result) {
        	var extraDataAttr = [{ "attribs": { "name": "department", "value": department } }];
       		table = createTable(result, "Sub Departments", 9, "subdepartment", extraDataAttr);
        }
    }).done(function(response){
       $(element).closest("tr").after( table );
    });

});


$(document).on('click', 'a.subdepartment', function() {
	//this will return a list of Classes for the clicked Department
	
	var subdepartment = $(this).data("subdepartment");
	var department = $(this).data("department");
	var table;
	var element = $(this);
	
	if(!toggleTable(element)){
		return;
	}
	

    $.ajax({
        url: "/tools/productdelivery/classes",
        type: 'get',
        data: {
        	storenumber: storenumber,
        	division: division,
            subdepartment: subdepartment,
            department: department
        },
        success: function(result) {
        	var extraDataAttr = [{ "attribs": { "name": "subdepartment", "value": subdepartment } }];
       		table = createTable(result, "Classes", 9, "fglclass", extraDataAttr);
        }
    }).done(function(response){
       $(element).closest("tr").after( table );
    });
});


$(document).on('click', 'a.fglclass', function() { 
	//get the brand for a given class
	
	var fglclass = $(this).data("fglclass");
	var subdepartment = $(this).data("subdepartment");
	var table;
	var element = $(this);

	if(!toggleTable(element)){
		return;
	}

    $.ajax({
        url: "/tools/productdelivery/brands",
        type: 'get',
        data: {
        	storenumber: storenumber,
        	division: division,
            class: fglclass
        },
        success: function(result) {
        	var extraDataAttr = [{ "attribs": { "name": "subdepartment", "value": subdepartment } }];
       		table = createTable(result, "Brands", 9, "brand", extraDataAttr);
        }
    }).done(function(response){
       $(element).closest("tr").after( table );

       $('table.brandtable a').data('fglclass', fglclass);
    });
});


$(document).on('click', 'a.brand', function() { 
	
	var brand = $(this).data("brand");
	var fglclass = $(this).data("fglclass");
	var subdepartment = $(this).data("subdepartment");
	var table;
	var element = $(this);

	if(!toggleTable(element)){
		return;
	}

    $.ajax({
        url: "/tools/productdelivery/styles",
        type: 'get',
        data: {
        	storenumber: storenumber,
        	division: division,
            class: fglclass,
            subdepartment: subdepartment,
            brand: brand
        },
        success: function(result) {
       		table = createStyleTable(result);
        }
    }).done(function(response){
       $(element).closest("tr").after( table );
    });
});

$('a.style').on('click', function() {

});


function createTable(data, title, colspan, datatype, extraDataAttr=0)
{
	var table="<table class='table table-bordered "+datatype+"table'>";
	var tableBody="";
	var header = ""+
		"<thead>" +
		"  <tr>" +
        "     <th>"+title+"</th>" +
        "     <th>LY Jan</th>" +
        "     <th>TY Jan</th>" +
        "     <th>LY Feb</th>" +
        "     <th>TY Feb</th>" +
        "     <th>LY Mar</th>" +
        "     <th>TY Mar</th>" +
        "     <th>LY Season Total</th>" +
        "     <th>TY Season Total</th>" +
		"  </tr>" +
		"</thead>";

		_.forEach(data, function (d) {

			var row = "<tr>";
			
			if(extraDataAttr){
				var count = Object.keys(extraDataAttr).length;
				var attirbStr = "";
				extraDataAttr.forEach(function(obj) { 
					attirbStr = " data-"+obj.attribs.name+"='"+obj.attribs.value+"'";
				});
			
				row = row + "<td><i class='fa fa-caret-right'></i> <a class='"+datatype+"' data-"+datatype+"='"+d.name+"'"+attirbStr+">"+d.name+"</a></td>";

			} else {
				row = row + "<td><i class='fa fa-caret-right'></i> <a class='"+datatype+"' data-"+datatype+"='"+d.name+"'>"+d.name+"</a></td>";
			}
	        row = row + "<td class='lastyear'>"+d.ly_month1+"</td>" +
				        "<td>"+d.cy_month1+"</td>" +
				        "<td class='lastyear'>"+d.ly_month2+"</td>" +
				        "<td>"+d.cy_month2+"</td>" +
				        "<td class='lastyear'>"+d.ly_month3+"</td>" +
				        "<td>"+d.cy_month3+"</td>" +
				        "<td class='lastyeartotal'>"+d.last_year_total+"</td>" +
				        "<td>"+d.current_year_total+"</td>" +
			"</tr>";

			tableBody = tableBody + row;
		});

		table = "<tr><td colspan='"+colspan+"'>"+table + header + tableBody + "</table></td></tr>";
		return table;
}


function createStyleTable(data)
{
	var table="<table class='table table-bordered styletable'>";
	var tableBody="";
	var header = ""+
		"<thead>" +
		"  <tr>" +
        "     <th>Style #</th>" +
        "     <th>Name</th>" +
        "     <th>LY Jan</th>" +
        "     <th>TY Jan</th>" +
        "     <th>LY Feb</th>" +
        "     <th>TY Feb</th>" +
        "     <th>LY Mar</th>" +
        "     <th>TY Mar</th>" +
        "     <th>LY Season Total</th>" +
        "     <th>TY Season Total</th>" +
		"  </tr>" +
		"</thead>";

		_.forEach(data, function (d) {
			console.log(d.STYLE_NAME);
			var row = ""+
			"<tr>" +
	        "     <td><a class='style' id='"+d.STYLE_NUMBER+"'>"+d.STYLE_NUMBER+"</a></td>" +
	        "     <td><a class='style' id='"+d.STYLE_NUMBER+"'>"+d.STYLE_NAME+" "+d.CODI_NUMBER+"</a></td>" +
	        "	  <td class='lastyear'>"+d.ly_month1+"</td>" +
			"	  <td>"+d.cy_month1+"</td>" +
			"	  <td class='lastyear'>"+d.ly_month2+"</td>" +
			"	  <td>"+d.cy_month2+"</td>" +
			"	  <td class='lastyear'>"+d.ly_month3+"</td>" +
			"     <td>"+d.cy_month3+"</td>" +
			"     <td class='lastyeartotal'>"+d.last_year_total+"</td>" +
			"     <td>"+d.current_year_total+"</td>" +
			"</tr>";
			tableBody = tableBody + row;
		});

		table = "<tr><td colspan='10'>"+table + header + tableBody + "</table></td></tr>";
		return table;
}

function toggleTable(el)
{
	
	

	if( $( el ).hasClass( "open" ) ) {
		$(el).closest("tr").next("tr").remove();
		$( el ).toggleClass( "open" );
		var tr = $(el).parent('tr');		
		tr.find("i.fa").toggleClass("fa-caret-right").toggleClass('fa-caret-down');
		return false;	
	} else {
		$( el ).toggleClass( "open" );
		return true;
	}	
}