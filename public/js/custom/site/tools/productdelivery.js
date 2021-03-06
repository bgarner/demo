var storenumber = localStorage.getItem('userStoreNumber').replace("A", "");
if(storenumber.charAt(0) == "0"){
	storenumber = storenumber.slice(1);	
}

var currenturl = $(location).attr('href');
var parts = currenturl.split("/");
var division = parts[parts.length-1];
var mo1 = moment().format("MMM");
var mo2 = moment().add(1, 'months').format("MMM");
var mo3 = moment().add(2, 'months').format("MMM");

//event bindings
$(document).on('click', 'a.department', function() {
	//this will return a list of SubDepartmnets for the clicked Department
	var department = $(this).data("department");
	var table;
	var element = $(this);

	if(!toggleTable(element)){
		return;
	}

    $.ajax({
        url: "/tools/productdelivery/subdepartments",
        type: 'get',
        data: {
        	storenumber: storenumber,
        	division: division,
            department: department
        },
        success: function(result) {
        	var extraDataAttr = { "attribs": [{ "name": "department", "value": department }] };
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
        	var extraDataAttr = { "attribs": [{ "name": "subdepartment", "value": subdepartment}, {"name": "department", "value": department }] };
       		table = createTable(result, "Classes", 9, "fglclass", extraDataAttr);
        }
    }).done(function(response){
       $(element).closest("tr").after( table );
    });
});


$(document).on('click', 'a.fglclass', function() { 
	//get the brand for a given class
	
	var fglclass = $(this).data("fglclass");
	var department = $(this).data("department");
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
        	department: department,
        	subdepartment: subdepartment,
            class: fglclass
        },
        success: function(result) {
        	//var extraDataAttr = [{ "attribs": { "name": "subdepartment", "value": subdepartment } }];
        	var extraDataAttr = { "attribs":[{"name":"subdepartment", "value":subdepartment},{"name":"department", "value":department}] };
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

$(document).on('click', 'a.openstyle', function() {
    
    console.log("open stuff");

    var modal = $('#view-style-modal');
    var modalHeader = $('#view-style-modal .modal-title');
    var modalBody = $('#view-style-modal .modal-body');

	var stylenumber = $(this).data("stylenumber");
	var stylename = $(this).data("stylename");
	var codi = $(this).data("codi");
    var styleSrc = '<img src="https://fgl.scene7.com/is/image/FGLSportsLtd/'+stylenumber+'_'+ codi +'_a?hei=520"/>';

    modalHeader.empty().html(stylenumber +" - "+ stylename +"  ("+codi+")");
    modalBody.empty().html(styleSrc);
    
    modal.modal({show:true})
            
});


function createTable(data, title, colspan, datatype, extraDataAttr)
{
	var table="<table class='table table-bordered "+datatype+"table'>";
	var tableBody="";
	var header = ""+
		"<thead>" +
		"  <tr>" +
        "     <th class='fixedwidthheader'>"+title+"</th>" +
        "     <th class='monthly'>LY "+mo1+"</th>" +
        "     <th class='monthly'>TY "+mo1+"</th>" +
        "     <th class='monthly'>LY "+mo2+"</th>" +
        "     <th class='monthly'>TY "+mo2+"</th>" +
        "     <th class='monthly'>LY "+mo3+"</th>" +
        "     <th class='monthly'>TY "+mo3+"</th>" +
        "     <th class='yearly'>LY Season Total</th>" +
        "     <th clas='yearly'>TY Season Total</th>" +
		"  </tr>" +
		"</thead>";

		_.forEach(data, function (d) {

			var row = "<tr>";
			var namestring;
			if (typeof extraDataAttr === 'undefined') {
				namestring = d.name;
				namestring = namestring.replace("'", "&apos;");
				row = row + "<td><i class='fa fa-caret-right'></i> <a class='"+datatype+"' data-"+datatype+"='"+namestring+"'>"+d.name+"</a></td>";
			} else {
				var attribStr = "";
				var count = Object.keys(extraDataAttr.attribs).length;
				for (i = 0; i < count; i++){
  					//attrib = extraDataAttr.attribs[i];
  					attribStr = attribStr + " data-"+extraDataAttr.attribs[i].name+"='"+extraDataAttr.attribs[i].value+"'";
				}
				namestring = d.name;
				namestring = namestring.replace("'", "&apos;");
				row = row + "<td><i class='fa fa-caret-right'></i> <a class='"+datatype+"' data-"+datatype+"='"+namestring+"'"+attribStr+">"+namestring+"</a></td>";
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
        "     <th>LY "+mo1+"</th>" +
        "     <th>TY "+mo1+"</th>" +
        "     <th>LY "+mo2+"</th>" +
        "     <th>TY "+mo2+"</th>" +
        "     <th>LY "+mo3+"</th>" +
        "     <th>TY "+mo3+"</th>" +
        "     <th>LY Season Total</th>" +
        "     <th>TY Season Total</th>" +
		"  </tr>" +
		"</thead>";

		_.forEach(data, function (d) {
			var row = ""+
			"<tr>" +
	        "     <td><a class='openstyle' id='"+d.STYLE_NUMBER+"' data-stylenumber='"+d.STYLE_NUMBER+"' data-stylename='"+d.STYLE_NAME+"' data-codi='"+d.CODI_NUMBER+"'>"+d.STYLE_NUMBER+"</a></td>" +
	        "     <td><a class='openstyle' id='"+d.STYLE_NUMBER+"' data-stylenumber='"+d.STYLE_NUMBER+"' data-stylename='"+d.STYLE_NAME+"' data-codi='"+d.CODI_NUMBER+"'>"+d.STYLE_NAME+" "+d.CODI_NUMBER+"</a></td>" +
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
	var tr = $(el).parent('tr');		
	tr.find("i.fa").toggleClass("fa-caret-right").toggleClass('fa-caret-down');

	if( $( el ).hasClass( "open" ) ) {
		$(el).closest("tr").next("tr").remove();
		$( el ).toggleClass( "open" );
		return false;	
	} else {
		$( el ).toggleClass( "open" );
		return true;
	}	
}