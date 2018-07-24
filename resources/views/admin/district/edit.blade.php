{!! Form::model($district, ['action' => ['StoreApi\DistrictAdminController@update', 'id'=>$district->id], 'method' => 'PUT']) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Edit District </h4>
</div>

<div class="modal-body">
    
    <div class="form-group">
        <h5 class="clearfix">District <span class="req">*</span></h5>
        {!! Form::text('district_name', $district->name, ['class'=>'form-control', 'id'=>'district_name']) !!}
    </div>
    
    
</div>

<div class="modal-footer">

    <button type="button" class="btn btn-white cancel-modal" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
    <button class="btn btn-primary"><i class='fa fa-check'></i> Save changes</button>
</div>

{!! Form::close() !!}

    


