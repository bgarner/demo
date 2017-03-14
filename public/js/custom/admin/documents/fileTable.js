	var fillTable = function(data){

		console.log("from fillTable");
		console.log(data);

		$("#file-container").removeClass('hidden').addClass('visible');
		$("#file-uploader").removeClass('hidden').addClass('visible');
		$("#empty-container").removeClass('visible').addClass('hidden');
		$("#package-viewer").removeClass('visible').addClass('hidden');

		$(".topLevelNavItems").addClass('hidden');

		var banner_id = $("input[name='banner_id']").val();
		
		if ( data.folder.type == "week") {
			if( !(data.folder === null) ) {
				$("#folder-title").html("<i class='fa fa-folder-open'></i> Week " + data.folder.week_number);
				$("#folder-title").attr('data-folderId', data.folder.global_folder_id);
				$("#add-files").removeClass('hidden').addClass('visible');
				$("#add-files").attr('data-folderId', data.folder.global_folder_id);
				$("#add-folder").attr('data-folderId', data.folder.global_folder_id );
				$("#add-folder").attr('href', "/admin/folder/create?parent="+data.folder.global_folder_id);
				$("#parent-folder-id").val(data.folder.global_folder_id);

				$("#edit-folder").removeClass('hidden').addClass('visible');
				$("#edit-folder").attr('data-folderId', data.folder.global_folder_id );
				$("#edit-folder").attr('href', "/admin/folder/"+data.folder.global_folder_id+"/edit");

				$("#delete-folder").removeClass('hidden').addClass('visible');
				$("#delete-folder").attr('data-folderId', data.folder.global_folder_id );

				$("#folder-title").attr('data-isWeekFolder', true);
			}	
		}
		else {
			if( !(data.folder === null) ) {
				$("#folder-title").html("<i class='fa fa-folder-open'></i> " +  data.folder.name);
				$("#folder-title").attr('data-folderId', data.folder.global_folder_id);
				$("#add-files").removeClass('hidden').addClass('visible');
				$("#add-files").attr('data-folderId', data.folder.global_folder_id);
				var currentHref = $("#add-files").attr('href');
				$("#add-files").attr('href', "/admin/document/create#!/"+data.folder.global_folder_id);
				
				$("#add-folder").attr('data-folderId', data.folder.global_folder_id );
				$("#add-folder").attr('href', "/admin/folder/create?parent="+data.folder.global_folder_id);
				$("#parent-folder-id").val(data.folder.global_folder_id);
				
				$("#edit-folder").removeClass('hidden').addClass('visible');
				$("#edit-folder").attr('data-folderId', data.folder.global_folder_id );
				$("#edit-folder").attr('href', "/admin/folder/"+data.folder.global_folder_id+"/edit");
				

				$("#delete-folder").removeClass('hidden').addClass('visible');
				$("#delete-folder").attr('data-folderId', data.folder.global_folder_id );

				$("#copy-folder").removeClass('hidden').addClass('visible');
				$("#copy-folder").attr('data-folderId', data.folder.global_folder_id );				
				$("#copy-folder").attr('data-folderName', data.folder.name)
				var folderPath = '';
				$.each( data.folder.folder_path, function( index, value ){
				    console.log(value);
				    folderPath += value.name + "/";
				});
 				$("#copy-folder").attr('data-folderPath', folderPath);
				$("#folder-title").attr('data-isWeekFolder', false);
			} else{


			}
		}
		


		$('#file-table').empty();
		
		if( !(data.files === null) ) {

			if(data.files.length>0) {
				$('#file-table').append('<thead>'+
										'<tr>'+
										'<th></th>'+
										'<th> Title </th>'+
										// ' <th> Description </th>'+
										' <th> Uploaded </th>'+
										' <th> Start </th>' +
										' <th> End </th>' +
										' <th> Action </th> </tr></thead>');
				var files = data.files
				console.log(files)
				$('#file-table').append('<tbody>');
				_.each(files, function(i){
					$('#file-table').append('<tr>'+
												'<td>'+ i.is_alert +'</td>'+
												'<td>'+ i.link_with_icon +'</td>'+
												// ' <td>'+ i.description +'</td>'+
												' <td>'+ i.prettyDateCreated +'</td>'+
												' <td>'+ i.prettyDateStart +'</td>' +
												' <td>'+ i.prettyDateEnd +'</td>' +
												' <td class="action"> '+
													'<a class="btn btn-xs btn-primary" href="/admin/document/'+ i.id +'/edit"><i class="fa fa-pencil"></i></a> '+
													'<button type="button" class="btn btn-xs btn-primary" id="copy-document" data-documentTitle="'+ i.title +'" data-documentName= "'+ i.filename +'" data-fileid="'+ i.id + '"><i class="fa fa-clipboard"></i></button> '+
													'<a class="deleteFile btn btn-xs btn-danger" data-fileid="'+ i.id +'" id="file'+ i.id +'" ><i class="fa fa-trash"></i></a>'+

												'</td> </tr>')
				});
				$('#file-table').append('</tbody>');
				$("#file-table").tablesorter({
					sortReset : true,
	    			cssAsc: 'up',
	        		cssDesc: 'down'
				});
			}

		}
		
		
	}