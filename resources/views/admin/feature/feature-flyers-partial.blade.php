@if(isset($flyers) && count($flyers)>0)
<table class="table table-hover feature-flyers-table">
	<thead>
		<tr>
			<th>Flyer Name</th>
			<th></th>
			<th class="align-right">Action</th>
		</tr>
	</thead>
	<tbody>
	
	
        @foreach ($flyers as $flyer)
        
	   <tr class="feature-flyers">
            <td data-flyer-id='{{$flyer->id}}'> {{$flyer->flyer_name}} </td>
            <td></td>
            <td class="align-right"> <a data-flyer-id='{{$flyer->id}}' id="flyer{{$flyer->id}}" class="remove-flyer btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
        </tr>
        @endforeach
    </tbody>
	
	

</table>
@else
<table class="table table-hover feature-flyers-table hidden">
	<thead>
		<tr>
			<th>flyer Name</th>
			<th></th>
			<th class="align-right">Action</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
@endif