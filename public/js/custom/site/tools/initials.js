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
    $.ajax({
        url: "/tools/productdelivery/subdepartments",
        type: 'get',
        data: {
        	storenumber: storenumber,
        	division: division,
            department: department
        },
        success: function(result) {
       		table = createTable(result, "Sub Departments", 9, "subdepartment");
        }
    }).done(function(response){
       console.log("done!");
       $(element).closest("tr").after( table );
    });

});


$(document).on('click', 'a.subdepartment', function() {
	//this will return a list of Classes for the clicked Department
	var subdepartment = $(this).data("subdepartment");
	var table;
	var element = $(this);
    $.ajax({
        url: "/tools/productdelivery/classes",
        type: 'get',
        data: {
        	storenumber: storenumber,
        	division: division,
            subdepartment: subdepartment
        },
        success: function(result) {
       		table = createTable(result, "Classes", 9, "fglclass");
        }
    }).done(function(response){
       console.log("done!");
       $(element).closest("tr").after( table );
    });
});

$(document).on('click', 'a.fglclass', function() { 
	//get the brand for a given class
	var fglclass = $(this).data("fglclass");
	var table;
	var element = $(this);
    $.ajax({
        url: "/tools/productdelivery/brands",
        type: 'get',
        data: {
        	storenumber: storenumber,
        	division: division,
            class: fglclass
        },
        success: function(result) {
       		table = createTable(result, "Brands", 9, "brand");
        }
    }).done(function(response){
       console.log("done!");
       $(element).closest("tr").after( table );

       $('table.brandtable a').data('fglclass', fglclass);
    });
});

$(document).on('click', 'a.brand', function() { 
	var brand = $(this).data("brand");
	var fglclass = $(this).data("fglclass");
	var table;
	var element = $(this);
    $.ajax({
        url: "/tools/productdelivery/styles",
        type: 'get',
        data: {
        	storenumber: storenumber,
        	division: division,
            class: fglclass,
            brand: brand
        },
        success: function(result) {
       		table = createStyleTable(result);
        }
    }).done(function(response){
       console.log("done!");
       $(element).closest("tr").after( table );
    });
});

$('a.style').on('click', function() {

});



function createTable(data, title, colspan, datatype)
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
			console.log(d);
			var row = ""+
			"<tr>" +
	        "     <td><a class='"+datatype+"' data-"+datatype+"='"+d.name+"'>"+d.name+"</a></td>" +
	        "     <td>143</td>" +
	        "     <td>52</td>" +
	        "     <td>523</td>" +
	        "     <td>5321</td>" +
	        "     <td>2143</td>" +
	        "     <td>23</td>" +
	        "     <td>325</td>" +
	        "     <td>342</td>" +
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
			console.log(d);
			var row = ""+
			"<tr>" +
	        "     <td><a class='style' id='"+d.STYLE_NUMBER+"'>"+d.STYLE_NUMBER+"</a></td>" +
	        "     <td><a class='style' id='"+d.STYLE_NUMBER+"'>"+d.STYLE_NAME+"</a></td>" +
	        "     <td>143</td>" +
	        "     <td>52</td>" +
	        "     <td>523</td>" +
	        "     <td>5321</td>" +
	        "     <td>2143</td>" +
	        "     <td>23</td>" +
	        "     <td>325</td>" +
	        "     <td>342</td>" +
			"</tr>";
			tableBody = tableBody + row;
		});

		table = "<tr><td colspan='10'>"+table + header + tableBody + "</table></td></tr>";
		return table;
}

