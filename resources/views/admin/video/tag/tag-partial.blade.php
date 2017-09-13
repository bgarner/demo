<div class="form-group">
    {!! Form::label('tags', 'Tags' , ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
      {!! Form::select('tags', $tags, $selected_tags, ['class'=>'select', 'multiple'=>'multiple' , 'id'=>'tags'])  !!}
    </div>
</div>
                          