$(document).ready(function(){

	var componentTable = $(".componentTable").DataTable({

							"columns": [
							    { "visible": false },
							    { "width": "45%" },
							    null,
							    { "width" : "10%" , "sortable" : false},
							    { "visible": false },
							  ],
							"bPaginate": false,
			                "paging":   false,
			                "ordering": false,
			                "info":     false,
			                "searching": false
						});

	$('.datatable tbody').on('click', 'tr.details-control', function () {
            var tr = $(this);
            console.log(tr);
            var row = componentTable.row( tr );

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
    function format ( d ) {


		var details = JSON.parse(d[4]);

		var returnString = '<table class="table "><thead><tr>'+
		                    '<td colspan="2" class="">Sub Component</td>'+
		                    '<td colspan="2" class="">Action</td>'+
		                    '</tr></thead><tbody>';
		$(details).each(function(index, value){
			console.log(value);
		    returnString += '<tr>'+
		        '<td colspan="2">'+value.subcomponent_name+'</td>';
		    if(value.state == 'on'){
		    	returnString += '<td colspan="2"><a class="btn btn-primary btn-xs subcomponent-edit"'+
		    					'title="Toggle Visibility"'+
		    					'data-state="'+ value.state +'"'+
		    					'id="store_subcomponent_'+ value.id +'"'+
		    					'data-subcomponent-id="'+ value.id +'"'+
		    					'<td colspan="2"> <i class="fa fa-eye"></i> </a></td>';
		    }
		    else{
		    	returnString += '<td colspan="2"><a class="btn btn-default btn-xs subcomponent-edit"'+
		    					'title="Toggle Visibility"'+
		    					'data-state="'+ value.state +'"'+
		    					'id="store_subcomponent_'+ value.id +'"'+
		    					'data-subcomponent-id="'+ value.id +'"'+
		    					'<td colspan="2"> <i class="fa fa-eye-slash"></i> </a></td>';
		    }
		
						
		    returnString +=  '</tr>';
		});

		returnString += '</tbody></table>';
		
		return returnString;
            
    }

});
$(document).on('click','.component-edit',function(){
  	
  	var hasError = false;

  	
  	var component_id = $(this).data('component-id');
  	var currentState = $(this).data('state');

  	console.log(component_id);

    if(hasError == false) {

		$.ajax({
		    url: '/admin/storecomponent/' + component_id ,
		    type: 'PATCH',
		    dataType: 'json',
		    data: {
		    	state: currentState,
		    },

		    success: function(result) {
		      
		      	console.log(result);
		        if(result.validation_result == 'false') {
		        	var errors = result.errors;
		        	if(errors.hasOwnProperty("component_name")) {
		        		$.each(errors.component_name, function(index){
		        			$("#component_name").parent().append('<div class="req">' + errors.component_name[index]  + '</div>');	
		        		}); 	
		        	}
		        	if(errors.hasOwnProperty("component_id")) {
		        		$.each(errors.component_id, function(index){
		        			$("#component_name").parent().append('<div class="req">' + errors.component_id[index]  + '</div>');	
		        		}); 	
		        	}
		        	if(errors.hasOwnProperty("roles")) {
		        		$.each(errors.roles, function(index){
		        			$("#roles").parent().append('<div class="req">' + errors.roles[index]  + '</div>');	
		        		}); 	
		        	}
		        }
		        else{
		        	$("#store_component_"+ component_id).attr('data-state', JSON.parse(result.config).state);
		        	$("#store_component_"+ component_id).toggleClass('btn-primary').toggleClass('btn-default');
		        	$("#store_component_"+ component_id).find('i').toggleClass('fa-eye').toggleClass('fa-eye-slash')      	
		        }

				
		    }
		});    	
    }


    return false;
});

$(document).on('click','.subcomponent-edit',function(){
  	
  	var hasError = false;

  	
  	var subcomponent_id = $(this).data('subcomponent-id');
  	var currentState = $(this).data('state');

  	console.log(subcomponent_id);

    if(hasError == false) {

		$.ajax({
		    url: '/admin/subcomponent/' + subcomponent_id ,
		    type: 'PATCH',
		    dataType: 'json',
		    data: {
		    	state: currentState,
		    },

		    success: function(result) {
		      
		      	console.log(result);
		        if(result.validation_result == 'false') {
		        	var errors = result.errors;
		        	if(errors.hasOwnProperty("component_name")) {
		        		$.each(errors.component_name, function(index){
		        			$("#component_name").parent().append('<div class="req">' + errors.component_name[index]  + '</div>');	
		        		}); 	
		        	}
		        	if(errors.hasOwnProperty("component_id")) {
		        		$.each(errors.component_id, function(index){
		        			$("#component_name").parent().append('<div class="req">' + errors.component_id[index]  + '</div>');	
		        		}); 	
		        	}
		        	if(errors.hasOwnProperty("roles")) {
		        		$.each(errors.roles, function(index){
		        			$("#roles").parent().append('<div class="req">' + errors.roles[index]  + '</div>');	
		        		}); 	
		        	}
		        }
		        else{
		        	$("#store_subcomponent_"+ subcomponent_id).attr('data-state', JSON.parse(result.config).state);
		        	$("#store_subcomponent_"+ subcomponent_id).toggleClass('btn-primary').toggleClass('btn-default');
		        	$("#store_subcomponent_"+ subcomponent_id).find('i').toggleClass('fa-eye').toggleClass('fa-eye-slash')      	
		        }

				
		    }
		});    	
    }


    return false;
});