{!! Form::open(['action' => 'Flyer\FlyerItemAdminController@store']) !!}

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Flyer</h4>
    </div>

    <div class="modal-body">

        <input type="hidden" name="banner_id" value="{{$banner->id}}">
        <input type="hidden" name="flyer_id" value="" id="flyer_id">

        <div class="form-group">
            <h5 class="clearfix">Brand Name<span class="req">*</span></h5>
            {!! Form::text('brand_name', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <h5 class="clearfix">Product Name<span class="req">*</span></h5>
            {!! Form::text('product_name', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <h5 class="clearfix">Category<span class="req">*</span></h5>
            {!! Form::text('category', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <h5 class="clearfix">PMM<span class="req">*</span></h5>
            <span class="add_more_pmm"><i class="fa fa-plus"></i> Add More</span>
            <div class="row">
                
            </div>
        </div>
        <div class="form-group removed_pmm">
            
        </div>

        <div class="form-group">
            <h5 class="clearfix">Disclaimer<span class="req">*</span></h5>
            {!! Form::text('disclaimer', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <h5 class="clearfix">Original Price<span class="req">*</span></h5>
            {!! Form::text('original_price', null, ['class'=>'form-control']) !!}
        </div>

         <div class="form-group">
            <h5 class="clearfix">Sale Price<span class="req">*</span></h5>
            {!! Form::text('sale_price', null, ['class'=>'form-control']) !!}
        </div>

         <div class="form-group">
            <h5 class="clearfix">Notes<span class="req">*</span></h5>
            {!! Form::text('notes', null, ['class'=>'form-control']) !!}
        </div>


    </div>

    <div class="modal-footer">

        <button type="button" class="btn btn-white cancel-modal" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
        <button class="btn btn-primary"><i class='fa fa-check'></i> Save changes</button>
    </div>

{!! Form::close() !!}

	

