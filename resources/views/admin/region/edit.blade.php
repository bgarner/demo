{!! Form::model($region, ['action' => ['StoreApi\RegionAdminController@update', 'id'=>$region->id], 'method' => 'PUT']) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Edit Region </h4>
</div>

<div class="modal-body">
    
    <div class="form-group">
        <h5 class="clearfix">Region <span class="req">*</span></h5>
        {!! Form::text('region_name', $region->name, ['class'=>'form-control', 'id'=>'region_name']) !!}
    </div>
    
    
</div>

<div class="modal-footer">

    <button type="button" class="btn btn-white cancel-modal" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
    <button class="btn btn-primary"><i class='fa fa-check'></i> Save changes</button>
</div>

{!! Form::close() !!}

    


