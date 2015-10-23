	$(".folder").click(function(){
		// console.log($(this).closest('li'));

		$.ajax(
			{
				url : '/documents',
				data : {
							folder : this.id,
							isWeekFolder : $(this).attr("data-isweek")
					   }
			}
		)
		.done(function(data){
			fillTable(data)
		});
	});
	
	var fillTable = function(data){

		$("#file-container").removeClass('hidden').addClass('visible');
		$("#file-uploader").removeClass('hidden').addClass('visible');
		$("#empty-container").removeClass('visible').addClass('hidden');

		var banner_id = $("input[name='banner_id']").val();
		// console.log(banner_id);
		console.log(data);
		// console.log(data.folder[0]);
		if ( data.type == "week") {
			if( !(data.folder[0] === null) ) {
				$("#folder-title h2").html("Week " + data.folder[0].week_number)
				$("#folder-title").attr('data-folderId', data.folder[0].id)
				$("#folder-title").attr('data-isWeekFolder', true)
			}	
		}
		else {
			if( !(data.folder[0] === null) ) {
				$("#folder-title h2").html(data.folder[0].name);
				$("#folder-title").attr('data-folderId', data.folder[0].id)
				$("#folder-title").attr('data-isWeekFolder', false)
			}	
		}
		


		$('#file-table').empty();
		
		if( !(data.files[0] === null) ) {
			$('#file-table').append('<tr> <th> Title </th>'+
									' <th> Description </th>'+
									' <th> Uploaded At </th>'+
									' <th> Start Date </th>' +
									' <th> End Date </th>' +
									' <th> Action </th> </tr>');
			var files = data.files[0]
			console.log(files)
			_.each(files, function(i){
				$('#file-table').append('<tr> <td>'+ i.title +'</td>'+
											' <td>'+ i.description +'</td>'+
											' <td>'+ i.created_at +'</td>'+
											' <td>'+ i.start +'</td>' +
											' <td>'+ i.end +'</td>' +
											' <td> '+
												'<a class="btn btn-xs btn-warning" href="/admin/document/'+ i.id +'/edit?banner_id='+ banner_id +'"> Edit </a> '+
												'<a class="deleteFile btn btn-xs btn-danger" id="'+ i.id +'" > Delete </a>'+
											'</td> </tr>')
			});

		}
		
		
	}

	
	$("body").on("click", ".deleteFile", function(e) {
		console.log("file delete requested");
		e.preventDefault();
		if (confirm('Are you sure you want to delete this file?')) {
		    $(this).closest('tr').fadeOut(500);
			$.ajax({
			    url: '/admin/document/'+ this.id,
			    type: 'DELETE',
			    data : {	
			    			_token : $('[name=_token').val()
					   }

			})
			.done(function(data) {
				console.log(data);
			});
		} 
	});

