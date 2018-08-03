var fillTable = function(data){

	var banner_id = data.folder.banner_id;

	if(banner_id == 'undefined'){
		banner_id = $(".active").find("input[name='banner_id']").val();	
	}

	$(".tab-pane").removeClass('active');
	$(".tab-head").removeClass('active');
	$("#tab-" + banner_id).addClass('active');
	$("#tab-head-" + banner_id).addClass('active');
	
	$("#file-container-" + banner_id).removeClass('hidden').addClass('visible');	

	$(".topLevelNavItems").addClass('hidden');

	if ( data.folder.type == "week") {
		if( !(data.folder === null) ) {
			$("#folder-title-"+ banner_id + " h2").html('&nbsp;&nbsp;<i class="fa fa-folder-open"></i> ' + "Week " + data.folder.week_number)
			$("#folder-title-"+ banner_id).attr('data-folderId', data.folder.global_folder_id)
			$("#folder-title-"+ banner_id).attr('data-isWeekFolder', true)
		}	
	}
	else {
		if( !(data.folder === null) ) {
			$("#folder-title-"+ banner_id + " h2").html('&nbsp;&nbsp;<i class="fa fa-folder-open"></i> ' + data.folder.name);
			$("#folder-title-"+ banner_id).attr('data-folderId', data.folder.global_folder_id);
			$("#folder-title-"+ banner_id).attr('data-isWeekFolder', false);
			$("#folder-title-"+ banner_id + ".folder-path").val(data.folder.folder_path);
		}	
	}


	$('#folder-table').empty();
	$('#folder-table').hide();

	$('#file-table-' + banner_id).empty();

	if( (data.folder.folder_children).length > 0){
		$('#folder-table').show();
	}	
	
	fileFill(data, banner_id);
}


var fileFill = function(data, banner_id)
{

	if( !(data.files === null) ) {

		if(data.files.length > 0) {

			$('#file-table-' + banner_id).append('<thead>'+
									'<tr> <th> Title </th>'+
									' <th><span class="pull-right" style="padding-right: 50px;"> Added </span></th>'+
									' </tr></thead>');
			var files = data.files
			
			$('#file-table-' + banner_id).append('<tbody>');
			_.each(files, function(i){

				var icon ="";
				var row ="";
				var row = '<tr> <td class="mail-subject">'+ i.link_with_icon + '</td>'+
								' <td><span class="pull-right">'+ i.prettyDateStart +'</span></td>'+
								' <td></td> </tr>'
				if(i.archived) {
					var row = '<tr class="manager-archived archived-blue"> <td class="mail-subject">'+ i.link_with_icon + '</td>'+
								' <td><span class="pull-right">'+ i.prettyDateStart +'</span></td>'+
								' <td></td> </tr>'	
				}
						
				$('#file-table-' + banner_id).append(row);
			});

			$('#file-table-' + banner_id).append('</tbody>');

			$("#file-table-" + banner_id).tablesorter({
				sortReset : true,
				cssAsc: 'up',
	    		cssDesc: 'down'
			});
		}
	}

}	


$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  
  var target = $(e.target).attr("href") // activated tab
  parentfolder = $(target).find($(".folder-title")).attr('data-folderId');
  getFolderDocuments(parentfolder);
  
});


