@if(isset($packages) && count($packages)>0)
<table class="table table-hover feature-packages-table">
	<thead>
		<tr>
			<th>Package Name</th>
			<th></th>
			<th class="align-right">Action</th>
		</tr>
	</thead>
	<tbody>
	
	
        @foreach ($packages as $package)
        
	   <tr class="feature-packages">
            <td data-package-id='{{$package->id}}'> {{$package->package_name}} </td>
            <td></td>
            <td class="align-right"> <a data-package-id='{{$package->id}}' id="package{{$package->id}}" class="remove-package btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
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
			<th class="align-right">Action</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
@endif