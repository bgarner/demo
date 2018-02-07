<div class="form-group">
    {!! Form::label('targets', 'Select Stores', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">

        <select name="targets[]" id="targets" multiple class="chosen">
            @foreach($optGroupOptions as $optionGroups)
                <optgroup label="{{$optionGroups['optgroup-label']}}">
                @foreach($optionGroups["options"] as $key=>$value)
                    <option value={{$key}}

                        @forelse($value['data-attributes'] as $attr=>$val )
                            data-{{$attr}} = {{$val}}
                        @empty
                        @endforelse

                    >
                        {{$value['option-label']}}
                    </option>
                @endforeach
                </optgroup>
            @endforeach

        </select>
    </div>
</div>
