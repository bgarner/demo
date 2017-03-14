@if(isset($packages) && count($packages)>0)
<table class="table table-hover feature-packages-table">
	<thead>
		<tr>
			<th>Package Name</th>
			<th></th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	
	
        @foreach ($packages as $package)
        
	   <tr class="feature-packages">
            <td data-package-id='{{$package->package_id}}'> {{$package->package_name}} </td>
            <td></td>
            <td> <a data-package-id='{{$package->package_id}}' id="package{{$package->package_id}}" class="remove-package btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
        </tr>
        @endforeach
    </tbody>
	
	

</table>
@else
<table class="table table-hover feature-packages-table hidden">
	<thead>
		<tr>
			<th>Package Name</th>
			<th></th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
@endif