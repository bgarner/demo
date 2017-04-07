@if(count($flyers)>0)
	@foreach($flyers as $flyer)
		<div class="flyer_list_item">
		<input type="checkbox" class="flyer-checkbox" name = "feature_flyers[]" value = {{$flyer["id"]}} data-flyerid = {{$flyer["id"]}} data-flyername = "{{$flyer['flyer_name']}}"  > {{$flyer["flyer_name"]}} 
		</div>
	@endforeach
@endif