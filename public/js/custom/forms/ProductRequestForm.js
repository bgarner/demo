$("#category").children("option").hide();
$("#subcategory").children("option").hide();
var formOptions = { "departments" : 
					[
						{ 
					      "department_name": "Softgoods",
					      "dept_abbr" : "sg",
					      "category": [
					      	{
					      		"category_name" : "Athletic Apparel",
					      		"sub_category" : [
													"Tennis",
													"Sportswear/Lifestyle",
													"Swimwear",
													"Training",
													"Soccer",
													"Running",
													"Basketball",
													"Outdoor Performance",
													"Golf",
													"Cycling"
					      						]
					      	},
					      	{
					      		"category_name" : "Casual Apparel",
					      		"sub_category" : [
													"Action Sports Apparel",
													"Outdoor Apparel"
					      						]
					      	},
					      	{
					      		"category_name" : "Licensed/Replica",
					      		"sub_category" : [
													"NFL",
													"CFL",
													"MLB",
													"NBA",
													"NHL",
													"CHL",
													"Pro Soccer",
													"IIHF"
					      						]
					      	},
					      	{
					      		"category_name" : "Outerwear",
					      		"sub_category" : [
													"Alpine",
													"Windwear",
													"Softshell",
													"Casual",
													"Fleece",
													"Pants",
													"Other"
					      						]
					      	},
					      	{
					      		"category_name" : "Accessories",
					      		"sub_category" : [
													"Underwear",
													"Hosiery",
													"Headwear",
													"Other"
					      						]
					      	},
					      	{
					      		"category_name" : "Winter Accessories",
					      		"sub_category" : [
													"Underwear (Baselayer)",
													"Hosiery",
													"Headwear",
													"Handwear",
													"Other"
					      						]
					      	}


					      ]

							  
						},
					  	{ 
						      
					      "department_name": "Footwear",
					      "dept_abbr" : "fw",
					      "category": [
					      	{
					      		"category_name" : "Soccer",
					      		"sub_category" : [
													"NA"
					      						]
					      	},
					      	{
					      		"category_name" : "Baseball",
					      		"sub_category" : [
													"NA"
					      						]
					      	},
					      	{
					      		"category_name" : "Other Cleated",
					      		"sub_category" : [
													"NA"
					      						]
					      	},
					      	{
					      		"category_name" : "Running",
					      		"sub_category" : [
													"NA"
					      						]
					      	},
					      	{
					      		"category_name" : "Training",
					      		"sub_category" : [
													"NA"
					      						]
					      	},
					      	{
					      		"category_name" : "Walking",
					      		"sub_category" : [
													"NA"
					      						]
					      	},
					      	{
					      		"category_name" : "Basketball",
					      		"sub_category" : [
													"NA"
					      						]
					      	},
					      	{
					      		"category_name" : "Trend",
					      		"sub_category" : [
													"NA"
					      						]
					      	},
					      	{
					      		"category_name" : "Skate",
					      		"sub_category" : [
													"NA"
					      						]
					      	},
					      	{
					      		"category_name" : "Outdoor Casual",
					      		"sub_category" : [
													"NA"
					      						]
					      	},
					      	{
					      		"category_name" : "Hiking",
					      		"sub_category" : [
													"NA"
					      						]
					      	},
					      	{
					      		"category_name" : "Sandals - Athletic",
					      		"sub_category" : [
													"NA"
					      						]
					      	},
					      	{
					      		"category_name" : "Sandals - Outdoor",
					      		"sub_category" : [
													"NA"
					      						]
					      	},
					      	{
					      		"category_name" : "Winter",
					      		"sub_category" : [
													"NA"
					      						]
					      	},
					      	{
					      		"category_name" : "Other - Please specify in comments",
					      		"sub_category" : [
													"NA"
					      						]
					      	},
					      	{
					      		"category_name" : "Golf",
					      		"sub_category" : [
													"NA"
					      						]
					      	},
					      	{
					      		"category_name" : "Cycling",
					      		"sub_category" : [
													"NA"
					      						]
					      	},
					      	{
					      		"category_name" : "Climbing",
					      		"sub_category" : [
													"NA"
					      						]
					      	}



					      ]


							  
							},
					  	{ 
						      
					      "department_name": "Hardgoods",
					      "dept_abbr" : "hg",
					      "category": [
					      	{
					      		"category_name" : "Hockey",
					      		"sub_category" : [
													"Skates",
													"Protective Equipment",
													"Protective Accessories",
													"Goalie Protective",
													"Sticks",
													"Uniforms",
												 	"Hockey Accessories",
													"Street Hockey"
					      						]
					      	},
					      	{
					      		"category_name" : "Team Sports",
					      		"sub_category" : [
													"Baseball",
													"Football",
													"Soccer",
													"Rugby",
													"Volleyball",
													"Basketball",
													"Curling",
													"Lacrosse",
													"Team Accessories"
					      						]
					      	},
					      	{
					      		"category_name" : "Watersports",
					      		"sub_category" : [
													"Paddlesports",
													"Stand Up Paddleboards",
													"Snorkeling/scuba",
													"Swimming",
													"Suits",
													"Pfds"
					      						]
					      	},
					      	{
					      		"category_name" : "Racquetsports",
					      		"sub_category" : [
													 "Tennis",
													 "Squash",
													 "Badminton",
													 "Racquetball",
													 "Accessories",
													 "Table Tennis"
					      						]
					      	},
					      	{
					      		"category_name" : "Cycling",
					      		"sub_category" : [
													"Bikes",
														"Bike Helmets",
														"Cycling Protective",
														"Tires / Tubes",
														"Bike Accessories",
														"Bike Parts",
														"Trailers / Carriers",
														"Service Shop Parts"
					      						]
					      	},
					      	{
					      		"category_name" : "Inline/Roller Skating",
					      		"sub_category" : [
													"Inline / Roller Skate",
														"Protective",
													"Accessories/Parts"
					      						]
					      	},

					      	{
					      		"category_name" : "Back Country Skiing",
					      		"sub_category" : [
													 "Accessories"
					      						]
					      	},
					      	{
					      		"category_name" :  "Nordic Skiing",
					      		"sub_category" : [
													"Skis",
													" Boots",
														"Bindings"
					      						]
					      	},
					      	{
					      		"category_name" :  "Alpine Skiing",
					      		"sub_category" : [
													"Skis",
													"Boots",
													"Bindings",
													"Poles",
													"Ski Helmets",
													"Goggles",
													"Bags"
					      						]
					      	},
					      	{
					      		"category_name" :  "Snowboards",
					      		"sub_category" : [
													 "Boards",
													 "Boots",
													 "Bindings",
													 "Bags",
													 "Accessories"
					      						]
					      	},
					      	{
					      		"category_name" :  "Action Sports",
					      		"sub_category" : [
													 "Skateboards",
													  "Scooters"
					      						]
					      	},
					      	{
					      		"category_name" :  "Racks",
					      		"sub_category" : [
													 "Racks Bike",
													 "Racks Ski",
													 "Rack Accessories"
					      						]
					      	},
					      	{
					      		"category_name" :  "Golf",
					      		"sub_category" : [
													"Sets",
													"Individual Woods",
													"Individual Irons",
														"Putters",
														"Bags",
														"Gloves",
														"Balls",
													"Pull Carts",
														"Accessories",
														"Gps/rangefinders"
					      						]
					      	},
					      	{
					      		"category_name" : "Hiking-climbing",
					      		"sub_category" : [
													 "Hardware",
													 "Cords And Slings",
													 "Harnesses",
													 "Snow And Ice",
													 "Snowshoes",
													 "Leg Gaiters",
													 "Accessories",
													 "Poles And Staffs"
					      						]
					      	},
					      	{
					      		"category_name" :  "Camping",
					      		"sub_category" : [
														"Tents",
														"Sleeping Bags",
														"Sleep Accessories",
														"Stoves / Lanterns",
														"Cookware / Food Prep",
														"Bottles",
														"Tools / Knives",
														"Health / Safety",
														"Seasonal",
														"Camping Accessories",
														"Storage",
														"Lights",
														"Camping Food/drink"
					      						]
					      	},
					      	{
					      		"category_name" : "Impulse Lanes",
					      		"sub_category" : [
													"Impulse Hardgoods",
													"Impulse Softgoods",
													"Impulse Footwear"
					      						]
					      	},
					      	{
					      		"category_name" :  "Fitness",
					      		"sub_category" : [
														"Boxing",
														"Yoga / Pilates",
														"Weight Training",
														"Aerobics",
														"Fitness Machines",
														"Sport Therapy",
														"Hydration"
					      						]
					      	},
					      	{
					      		"category_name" :  "Food And Drink",
					      		"sub_category" : [
													  "Drinks",
													  "Sports Nutrition",
													  "Health Management"
					      						]
					      	},
					      	{
					      		"category_name" :  "Electronics",
					      		"sub_category" : [
													 "Optics",
													  "Photography",
													  "Navigation",
													  "Batteries",
													  "Communication",
													  "Timing",
													  "Audio",
													  "Wearable Tech",
													  "Health Management"
					      						]
					      	},
					      	{
					      		"category_name" :  "Books And Video",
					      		"sub_category" : [
													"NA"
					      						]
					      	},
					      	{
					      		"category_name" :  "Home Games And Toys",
					      		"sub_category" : [
													"NA"
					      						]
					      	},
					      	{
					      		"category_name" :  "Travel",
					      		"sub_category" : [
													"Bags And Packs",
														"Accessories"
					      						]
					      	},
					      	{
					      		"category_name" :  "Bags",
					      		"sub_category" : [
													"Child Carriers",
													"Packs",
													"Carry Bags"
					      						]
					      	},
					      	{
					      		"category_name" :  "Sun Protection",
					      		"sub_category" : [
													"NA"
					      						]
					      	}
					      ]
							  
						}
					]
				}

var getDepartments = function(){
	var dept = []; 
	$(formOptions.departments).each(function(index,item){
		dept.push(item);
	});

	return dept;
}
var getCategoryByDepartment = function(dept){

	var categoryOptions = [];
	$(formOptions.departments).each(function(index,item){
		
		if(item.department_name == dept){
			$(item.category).each(function(i, category){
				categoryOptions.push(category.category_name);

			});	
		}
		
	});
	return categoryOptions;
}

var getSubCategoryByDepartmentandCategory = function(dept, cat){

	var subcategoryOptions = [];
	$(formOptions.departments).each(function(index,item){
		if(item.department_name == dept){
			
			$(item.category).each(function(i, category){
				
				if(category.category_name == cat){	
					$(category.sub_category).each(function(i, subcategory){
						subcategoryOptions.push(subcategory);
					});
				}

			});	
		}
		
	});
	return subcategoryOptions;
}


$("#department").on('change', function() {
	
	var deptSelected = $("#department").children("option").filter(":selected").val();
	var categoryOptions = getCategoryByDepartment(deptSelected);
	$("#category").empty();
	$("#category").append('<option > Select </option>');
	$(categoryOptions).each(function(i,item){
		$("#category").append('<option data-dept="' + deptSelected + '" value="' + item + '">'+ item + '</option>');		
	});

	
});

$("#category").on('change', function() {
	
	var deptSelected = $("#department").children("option").filter(":selected").val();
	var categorySelected = $("#category").children("option").filter(":selected").val();
	var subcategoryOptions = getSubCategoryByDepartmentandCategory(deptSelected, categorySelected);
	$("#subcategory").empty();
	$("#subcategory").append('<option > Select </option>');
	$(subcategoryOptions).each(function(i,item){
		$("#subcategory").append('<option data-dept="' + deptSelected + '" value="' + item + '">'+ item+ '</option>');		
	});

	
});


$(document).ready(function(){

	// var departmentDropdown = document.getElementById('department');
	// var categoryDropdown = document.getElementById('category');
	// var subcategoryDropdown = document.getElementById('subcategory');

	// if(departmentDropdown) {

	// 	departmentDropdown.onchange = function() {
	// 		$("#category").children("option").hide();
	// 		$("#subcategory").children("option").hide();

	// 		var deptSelected = $("#department").children("option").filter(":selected").data();
	// 		console.log(deptSelected.dept);
	// 		$('[data-dept="'+deptSelected.dept+'"]').show();
	// 	}

	// }


	var departments = getDepartments();
	$("#department").empty();
	$("#department").append('<option > Select </option>');
	$(departments).each(function(i,item){
		$("#department").append('<option data-dept="' + item.dept_abbr + '" value="' + item.department_name + '">'+ item.department_name+ '</option>');		
	});

	console.log('done');
	if($("#formdata").length){

		var formData = JSON.parse($("#formdata").val());
		console.log(formData);
		$('#form_id').val(formData.form_id);
		$("#department").val(formData.department);
		$("#category").val(formData.category);
		$("#subcategory").val(formData.subcategory);
		$("#gender").val(formData.gender);
		$("#requirement").val(formData.requirement);
		$("#brand").val(formData.brand);
		$("#styleNumber").val(formData.styleNumber);
		$("#size").val(formData.size);
		$("#quantity").val(formData.quantity);
		$("#comments").val(formData.comments);
		$("#description").val(formData.description);
		$("#submitted_by").val(formData.submitted_by);
		$("#submitted_by_position").val(formData.submitted_by_position);
		$("#dm_approval").val(formData.dm_approval);
	}

	$("#department").on('change', function(){
		var dept = $("#department").val();
	});

	$("#form_send").click(function(){

		var form_id 	= $("#form_id").val();
		var department  = $("#department").val();
		var category    = $("#category").val();
		var subcategory = $("#subcategory").val();
		var gender 		= $("#gender").val();
		var requirement = $("#requirement").val();
		var brand       = $("#brand").val();
		var styleNumber = $("#styleNumber").val();
		var size        = $("#size").val();
		var quantity    = $("#quantity").val();
		var description = $("#description").val();
		var comments	= $("#comments").val();
		var submitted_by = $("#submitted_by").val();
		var submitted_by_position = $("#submitted_by_position").val();
		var dm_approval = $("#dm_approval:checked").val();
		var storeNumber = localStorage.getItem('userStoreNumber');
	  	var hasError 	= false;

	    if(department == '') {
			swal("Oops!", "Department cannot be empty.", "error");
			hasError = true;
			$(window).scrollTop(0);
			return false;
		}

		if(category == '') {
			swal("Oops!", "Category cannot be empty.", "error");
			hasError = true;
			$(window).scrollTop(0);
			return false;
		}
		if(subcategory == '') {
			swal("Oops!", "Sub Category cannot be empty.", "error");
			hasError = true;
			$(window).scrollTop(0);
			return false;
		}
		if(gender == '') {
			swal("Oops!", "Gender cannot be empty.", "error");
			hasError = true;
			$(window).scrollTop(0);
			return false;
		}
		
		if(requirement == '') {
			swal("Oops!", "Requirement cannot be empty.", "error");
			hasError = true;
			$(window).scrollTop(0);
			return false;
		}

		var submitted_by = $("#submitted_by").val();
		var submitted_by_position = $("#submitted_by_position").val();
		var dm_approval = $("#dm_approval:checked").val();

		if(submitted_by == '' || submitted_by_position == '' ) {
			swal("Oops!", "Your name or position cannot be empty.", "error");
			hasError = true;
			$(window).scrollTop(0);
			return false;
		}

		if(dm_approval == null) {
			swal("Oops!", "You need your DM's approval for the request.", "error");
			hasError = true;
			$(window).scrollTop(0);
			return false;
		}
		


	    if(hasError == false) {

			$.ajax({
			    url: "/" + storeNumber + '/form/productrequest',
			    type: 'POST',
			    data: {
			    	form_id: form_id,
			    	department : department,
					category : category,
					subcategory : subcategory,
					gender : gender,
					requirement : requirement,
					brand : brand,
					styleNumber : styleNumber,
					size : size,
					quantity : quantity,
					description : description,
					comments : comments,
					storeNumber : storeNumber,
					submitted_by: submitted_by,
					submitted_by_position: submitted_by_position,
					dm_approval: dm_approval
			    },

			    dataType: 'json',
			    error: function(data) {
					swal("Oops!", "Ya done messed up, A-Aron!", "error");
				    console.log(data.responseText);
				 },

			    success: function(data) {

			    	if(data.validation_result == 'false'){
			    		var errors = data.errors;
			    		console.log(errors);
			    		$( ".error" ).remove();
			    		if(errors.hasOwnProperty("department")) {
			        		$.each(errors.department, function(index){
			        			$("#department").parent().append('<div class="req error">' + errors.department[index]  + '</div>');	
			        		}); 	
			        	}
			        	
				        if(errors.hasOwnProperty("category")) {
				        	$.each(errors.category, function(index){
				        		$("#category").parent().append('<div class="req error">' + errors.category[index]  + '</div>');
				        	});
				        }
				        if(errors.hasOwnProperty("requirement")) {
				        	$.each(errors.requirement, function(index){
				        		$("#requirement").parent().append('<div class="req error">' + errors.requirement[index]  + '</div>');	
				        	});
				        }
				        if(errors.hasOwnProperty("submitted_by")) {
				        	$.each(errors.submitted_by, function(index){
				        		$("#submitted_by").parent().append('<div class="req error">' + errors.submitted_by[index]  + '</div>');	
				        	});
				        }
				        if(errors.hasOwnProperty("submitted_by_position")) {
				        	$.each(errors.submitted_by_position, function(index){
				        		$("#submitted_by_position").parent().append('<div class="req error">' + errors.submitted_by_position[index]  + '</div>');	
				        	});
				        }
			    	}
			    	else{


						$('#createNewProductRequestForm')[0].reset(); // empty the form
			        	swal({
			        		title : 'Nice!',
			        		text : "Your form has been submitted!",
			        		type : 'success',

			        	},
			        	function(){
			        		// window.history.back();
			        		window.location = "/" + storeNumber + '/form/productrequest';
			        	})
			        }

			        console.log(data);

				}
	    	});


	    return false;
		}
	});

});
