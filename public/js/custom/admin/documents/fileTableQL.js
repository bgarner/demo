	var files;

	var fillTable = function(data) {
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
										' <th> Start </th>' +
										' <th> End </th>' +
										'</tr></thead>');
				files = data.files
				console.log(files)
				$('#file-table').append('<tbody>');
				_.each(files, function(i){
					$('#file-table').append('<tr>'+
												'<td>'+ i.is_alert +'</td>'+
												'<td><a href="#" onclick="selectDocument('+i.id+');">'+ i.icon +' ' + i.title +'</td>'+
												' <td>'+ i.prettyDateStart +'</td>' +
												' <td>'+ i.prettyDateEnd +'</td>' +
												'</tr>')
				});
				$('#file-table').append('</tbody>');
				// $("#file-table").tablesorter({
				// 	sortReset : true,
	   //  			cssAsc: 'up',
	   //      		cssDesc: 'down'
				// });
			}
		}
	}

var selectDocument = function(id)
{
	console.log("----id----");
	console.log(id);
	console.log("----files----");
	console.log(files);
	var fileSelected = files.find(item => item.id == id);
	console.log(fileSelected);
	$("#ql-doc-selected").html(fileSelected.icon + " " + fileSelected.title);
	$("input[id=selected_file_id]").val(id);
}