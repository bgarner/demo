

var fillTable = function(data){

	//console.log( data );

	$("#file-container").removeClass('hidden').addClass('visible');
	$("#file-uploader").removeClass('hidden').addClass('visible');
	$("#empty-container").removeClass('visible').addClass('hidden');
	$("#package-viewer").removeClass('visible').addClass('hidden');

	$(".topLevelNavItems").addClass('hidden');

	var banner_id = $("input[name='banner_id']").val();
	
	if ( data.folder.type == "week") {
		if( !(data.folder === null) ) {
			$("#folder-title h2").html('&nbsp;&nbsp;<i class="fa fa-folder-open"></i> ' + "Week " + data.folder.week_number)
			$("#folder-title").attr('data-folderId', data.folder.global_folder_id)
			$("#folder-title").attr('data-isWeekFolder', true)
		}	
	}
	else {
		if( !(data.folder === null) ) {
			$("#folder-title h2").html('&nbsp;&nbsp;<i class="fa fa-folder-open"></i> ' + data.folder.name);
			$("#folder-title").attr('data-folderId', data.folder.global_folder_id)
			$("#folder-title").attr('data-isWeekFolder', false)
		}	
	}


	$('#folder-table').empty();
	$('#folder-table').hide();

	$('#file-table').empty();

	if( (data.folder.folder_children).length > 0){
	// if( !(data.folder.folder_children === null) ) {		
		//folderFill(data);
		$('#folder-table').show();
	}	
	
	fileFill(data);
}

var folderFill = function(data)
{

	if( !(data.folder.folder_children === null) ) {

		
		$('#folder-table').append('<thead>'+
								'<tr> <th> Name </th>'+
								'<th> Updated At </th>'+
								'</tr></thead>');
		var folders = data.folder.folder_children;
		// console.log(folders);
		$('#folder-table').append('<tbody>');
		_.each(folders, function(i){

			if (data.folder.has_weeks == 1) {

				$('#folder-table').append('<tr>'+
										' <td><i class="fa fa-folder"></i> <a class="folder" id="' + i.global_folder_id  +'" href="/document#!/' + i.global_folder_id + '"> Week ' +  i.week_number +'</a></td>'+
										' <td>' + i.start +'</td>'+
									'</tr>')
			}
			else{

				$('#folder-table').append('<tr>'+
										' <td><i class="fa fa-folder"></i> <a class="folder" id="' + i.global_folder_id  +'" href="/document#!/' + i.global_folder_id + '">' + i.name+'</a></td>'+
										' <td>' + i.start +'</td>'+
									'</tr>')

			}
			
		});
		$('#folder-table').append('</tbody>');
	
		$("#folder-table").tablesorter({
			sortReset : true,
			cssAsc: 'up',
    		cssDesc: 'down'
		});

	}
}


var fileFill = function(data)
{

	if( !(data.files === null) ) {

		if(data.files.length > 0) {
			$('#file-table').append('<thead>'+
									'<tr>'+
										'<th> Title '+
										'<span class="help_container">'+
											'<a href="#" '+
												'data-toggle="modal" '+
												'data-target="#"'+
												'data-parent-view="site.documents.index"'+
												'data-section="help_document_documents"'+
												'class="helpSection">'+
												'<i class="fa fa-question-circle" aria-hidden="true"></i>'+
												'</a>'+
												'</span>'+
										'</th>'+ 
									// ' <th> Description </th>'+
									' <th><span class="pull-right" style="padding-right: 50px;"> Added </span></th>'+
									// ' <th> Start </th>' +
									// ' <th> End </th>' +
									' </tr></thead>');
			var files = data.files
			
			$('#file-table').append('<tbody>');
			_.each(files, function(i){

				var icon ="";
				var row ="";
				var row = '<tr> <td class="mail-subject">'+ i.link_with_icon + '</td>'+
								// ' <td>'+ i.description + '</td>'+
								' <td><span class="pull-right">'+ i.prettyDateStart +'</span></td>'+
								// ' <td>'+ i.start +'</td>' +
								// ' <td>'+ i.end +'</td>' +
								' <td></td> </tr>'
				if(i.archived) {
					var row = '<tr class="archived archived-blue"> <td class="mail-subject">'+ i.link_with_icon + '</td>'+
								// ' <td>'+ i.description + '</td>'+
								' <td><span class="pull-right">'+ i.prettyDateStart +'</span></td>'+
								// ' <td>'+ i.start +'</td>' +
								// ' <td>'+ i.end +'</td>' +
								' <td></td> </tr>'	
				}
						
				$('#file-table').append(row);
			});

			$('#file-table').append('</tbody>');

			// $("#file-table").tablesorter({
			// 	sortReset : true,
			// 	cssAsc: 'up',
	  //   		cssDesc: 'down'
			// });
		}
	}

}	


