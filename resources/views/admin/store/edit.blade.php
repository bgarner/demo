{!! Form::model($store, ['action' => ['StoreApi\StoreAdminController@update', 'id'=>$store->id], 'method' => 'PUT']) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Edit Store - {{$store->store_number}}</h4>
</div>
<div class="modal-body">

    <div class="form-group">
        <label class="control-label">Store Name <span class="req">*</span></label>
        <div >
            {!! Form::text('store_name', $store->name, ['class'=>'form-control', 'id'=>'store_name']) !!}
        </div>
    </div>
    
    {{--
    <div class="form-group">
        <label class="control-label">Store Number <span class="req">*</span></label>
        <div >
            <input type="text" pattern="\d+" maxlength="4" minlength="3" class="form-control" name="store_number" id="store_number" value="{{$store->store_id}}">
        </div>
    </div>
    --}}

    <div class="form-group">
        <label class="control-label">Address </label>
        <div ><input type="text" class="form-control" name="address" id="address" value="{{$store->address}}"></div>
    </div>
    <div class="form-group">
        <label class="control-label">City <span class="req">*</span></label>
        <div ><input type="text" class="form-control" name="city" id="city" value="{{$store->city}}"></div>
    </div>
    <div class="form-group">
        <label class="control-label">Province <span class="req">*</span></label>
        {!! Form::select('province', $provinces, $store->province, [ 'class'=>'chosen', 'id'=> 'province']) !!}
    </div>
    <div class="form-group">
        <label class="control-label">Postal Code </label>
        <div ><input type="text" class="form-control" name="postal_code" id="postal_code" value="{{$store->postal_code}}"></div>
    </div>
    
    {{--@if($store->is_combo_store)
    <div class="form-group">
        
        <div ><input type="checkbox" id="is_combo_store" name="is_combo_store" class="" checked="checked" /> Is this a combo store.</div>
    </div>                     
    @endif --}}

    <div class="form-group">
        <label class="control-label">Banner <span class="req">*</span></label>
        {!! Form::select('banner_id', $banners, $store->banner_id, [ 'class'=>'chosen', 'id'=> 'banner_id']) !!}
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" id="create-alerttype">Update Store</button>
</div>
{!! Form::close() !!}
