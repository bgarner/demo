{!! Form::model($store, ['action' => ['StoreApi\StoreAdminController@update', 'id'=>$store->id], 'method' => 'PUT']) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Edit Store </h4>
</div>

<div class="modal-body">
    
    <div class="form-group">
        <h5 class="clearfix">Store Name <span class="req">*</span></h5>
        {!! Form::text('district_name', $store->name, ['class'=>'form-control', 'id'=>'district_name']) !!}
    </div>

    <div class="form-group">
    	<label class="control-label">Store Number <span class="req">*</span></label>
        <div >
        	<input type="text" class="form-control" name="store_number" id="store_number" value="">
        </div>
    </div>
    <div class="form-group">
    	<label class="control-label">Is this a combo store <span class="req">*</span></label>
        <div >
        	
        </div>
    </div>
    <div class="form-group">
    	<label class="control-label">Banner <span class="req">*</span></label>
        {!! Form::select('banner_id', $banners, null, [ 'class'=>'chosen', 'id'=> 'banner_id']) !!}
    </div>

    <div class="form-group">
    	<label class="control-label">Address </label>
        <div ><input type="text" class="form-control" name="address" id="address" value=""></div>
    </div>
    <div class="form-group">
    	<label class="control-label">City <span class="req">*</span></label>
        <div ><input type="text" class="form-control" name="city" id="city" value=""></div>
    </div>
    <div class="form-group">
    	<label class="control-label">Province <span class="req">*</span></label>
        <div ><input type="text" class="form-control" name="province" id="province" value=""></div>
    </div>
    <div class="form-group">
    	<label class="control-label">Postal Code </label>
        <div ><input type="text" class="form-control" name="postal_code" id="postal_code" value=""></div>
    </div>
    
    
</div>

<div class="modal-footer">

    <button type="button" class="btn btn-white cancel-modal" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
    <button class="btn btn-primary"><i class='fa fa-check'></i> Save changes</button>
</div>

{!! Form::close() !!}

    
