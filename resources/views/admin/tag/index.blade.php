<html>
<head>
	<title></title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body class="container-fluid adminview">

	<div class="col-md-10 col-md-offset-1">


		<input type="hidden" name="banner_id" value="{{$banner->id}}">
		<div class="row">
			<div class="col-md-10">
				<h3>Tags Library</h3>
			</div>
			<div class="col-md-2">
				<div id="create-tag" class="btn btn-success"> Add New Tag </div>
			</div>
		</div>

		<table class="table">
			<thead>
				<th>Tag</th>
				<th>Created At</th>
				<th>Actions</th>
			</thead>
			<tbody>
				@foreach($tags as $tag)
					<tr id="tag-{{$tag->id}}">
						<td class="tag_name">{{$tag->name}}</td>
						<td class="timestamp">{{$tag->created_at}}</td>
						<td>
							<a href="/admin/tag/{{$tag->id}}/edit" class="edit-tag btn btn-warning" id="{{$tag->id}}">Edit</a>
							<div class="delete-tag btn btn-danger" id="{{$tag->id}}">Delete</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>


	</div>

	<div id="create-tag-modal" class="modal fade">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                <h4 class="modal-title">Add Tag</h4>
	            </div>
	            <div class="modal-body">
	                @include('admin.tag.create')
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	                <button type="button" class="btn btn-primary" id="save-tag">Save</button>
	            </div>
	        </div>
	    </div>
	</div>



<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/vendor/moment.js"></script>
<script type="text/javascript" src="/js/custom/tags.js"></script>
<script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/js/custom/admin/global/bannerSelector.js"></script>
@include('admin.includes.scripts')


</body>
</html>
