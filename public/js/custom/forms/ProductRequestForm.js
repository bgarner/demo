$("#category").children("option").hide();
$("#subcategory").children("option").hide();


// var getDepartments = function(){
// 	var dept = []; 
// 	$(formOptions.departments).each(function(index,item){
// 		dept.push(item);
// 	});

// 	return dept;
// }
// var getCategoryByDepartment = function(dept){

// 	var categoryOptions = [];
// 	$(formOptions.departments).each(function(index,item){
		
// 		if(item.department_name == dept){
// 			$(item.category).each(function(i, category){
// 				categoryOptions.push(category.category_name);

// 			});	
// 		}
		
// 	});
// 	return categoryOptions;
// }

// var getSubCategoryByDepartmentandCategory = function(dept, cat){

// 	var subcategoryOptions = [];
// 	$(formOptions.departments).each(function(index,item){
// 		if(item.department_name == dept){
			
// 			$(item.category).each(function(i, category){
				
// 				if(category.category_name == cat){	
// 					$(category.sub_category).each(function(i, subcategory){
// 						subcategoryOptions.push(subcategory);
// 					});
// 				}

// 			});	
// 		}
		
// 	});
// 	return subcategoryOptions;
// }


// $("#department").on('change', function() {
	
// 	var deptSelected = $("#department").children("option").filter(":selected").val();
// 	var categoryOptions = getCategoryByDepartment(deptSelected);
// 	$("#category").empty();
// 	$("#category").append('<option > Select </option>');
// 	$(categoryOptions).each(function(i,item){
// 		$("#category").append('<option data-dept="' + deptSelected + '" value="' + item + '">'+ item + '</option>');		
// 	});

	
// });

// $("#category").on('change', function() {
	
// 	var deptSelected = $("#department").children("option").filter(":selected").val();
// 	var categorySelected = $("#category").children("option").filter(":selected").val();
// 	var subcategoryOptions = getSubCategoryByDepartmentandCategory(deptSelected, categorySelected);
// 	$("#subcategory").empty();
// 	$("#subcategory").append('<option > Select </option>');
// 	$(subcategoryOptions).each(function(i,item){
// 		$("#subcategory").append('<option data-dept="' + deptSelected + '" value="' + item + '">'+ item+ '</option>');		
// 	});

	
// });


$(document).ready(function(){


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
