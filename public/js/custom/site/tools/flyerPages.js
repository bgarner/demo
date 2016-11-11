$( "#flyerPageSelect" ).change(function() {

		$.ajax({
		    url: '/getFlyerBoxes',
		    type: 'POST',
		    data: {
		    	storeNumber: localStorage.userStoreNumber,
		    	flyerPage: this.value
		    }
		}).done(function(data){
			
			$('#adBoxSelect').empty();

			$('#adBoxSelect').append($('<option>', {
				//empty box    
			}));

			if(data.length > 0 ) {
				
				_.each(data, function(i){
					$('#adBoxSelect').append($('<option>', {
					    value: i.ad_box,
					    text: i.ad_box
					}));
				});

			}

		}); 
});


$( "#adBoxSelect" ).change(function() {

		var flyerPage = $( "#flyerPageSelect" ).val();

		$.ajax({
		    url: '/getFlyerBoxData',
		    type: 'POST',
		    data: {
		    	storeNumber: localStorage.userStoreNumber,
		    	flyerPage: flyerPage,
		    	adBox: this.value
		    }
		}).done(function(data){
			
			console.log(data);
			$(".addSelector").empty();

			$('.addSelector').append(
                    "<thead>" +
                    "<tr>" +
                    "    <th>Dept</th>" +
                    "    <th>SubDept</th>" +
                    "    <th>Class</th>" +
                    "    <th>Style</th>" +
                    "    <th>Name</th>" +
                    "    <th>On Hand</th>" +
                    "    <th>In Transit</th>" +
                    "    <th>Total</th>" +
                    "</tr>" +
                    "</thead>");

			$(".addSelector").show();


			if(data.length > 0 ) {
				
				$("#ad_min").empty();
				$("#ad_min").append( data[0].ad_min);

				_.each(data, function(i){

					$('.addSelector').append(
						"<tr>" +
							"<td>"+ i.dpt_name +"</td>" +
	                        "<td>"+ i.sdpt_name +"</td>" +
	                        "<td>"+ i.cls_name +"</td>" +
	                        "<td>"+ i.style_number +"</td>" +
	                        "<td>"+ i.style_name +"</td>" +
	                        "<td>"+ i.oh_qty +"</td>" +
	                        "<td>"+ i.it_qty +"</td>" +
	                        "<td>"+ i.total_onhand_intransit +"</td>" +

	                     "</tr>"
					);
				});

			}

		}); 


});


