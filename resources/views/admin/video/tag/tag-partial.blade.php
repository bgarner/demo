<div class="form-group">
    {!! Form::label('tags', 'Tags' , ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">

       <select name="tags[]" id="tags" multiple>
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
                          