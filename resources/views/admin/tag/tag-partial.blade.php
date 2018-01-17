<div class="form-group">
    {!! Form::label('tags', 'Tags' , ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">

        @if(isset($resourceId))
        <select name="tags[]" id="tags_{{$resourceId}}" class="tags" multiple>
        @else
        <select name="tags[]" id="tags_new" class="tags" multiple>
        @endif
            @foreach($tags as $key=>$tag)
                
                    <option value="{{$key}}" id="{{$key}}" data-tagname = "{{$tag}}"
						@if( isset($selectedTags) && in_array($key, $selectedTags ))
						selected
						@endif
                     >
                        {{$tag}}
                    </option>
                
            @endforeach

        </select>
    </div>
</div>
                          