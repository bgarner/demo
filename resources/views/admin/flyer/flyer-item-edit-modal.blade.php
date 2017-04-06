{!! Form::model($flyer_data, ['action' => ['Flyer\FlyerItemAdminController@update', 'id'=>$flyer_data->id], 'method' => 'PUT']) !!}

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Flyer</h4>
    </div>

    <div class="modal-body">

        <input type="hidden" name="banner_id" value="{{$banner->id}}">
        

        <div class="form-group">
            <h5 class="clearfix">Brand Name<span class="req">*</span></h5>
            {!! Form::text('brand_name', $flyer_data->brand_name, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <h5 class="clearfix">Product Name<span class="req">*</span></h5>
            {!! Form::text('product_name', $flyer_data->product_name, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <h5 class="clearfix">Category<span class="req">*</span></h5>
            {!! Form::text('category', $flyer_data->category, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <h5 class="clearfix">PMM<span class="req">*</span></h5>
            <span class="add_more_pmm"><i class="fa fa-plus"></i> Add More</span>
            <div class="row">
                @foreach($flyer_data->pmm_numbers as $pmm_number)
                <div class="col-sm-4 col-md-4">
                    <i class="fa fa-times remove_pmm" title="Remove PMM" ></i>
                    {!! Form::text('pmm[]', $pmm_number, ['class'=>'form-control pmm_number']) !!}
                    <img src="https://fgl.scene7.com/is/image/FGLSportsLtd/{{$pmm_number}}_99_a?bgColor=0,0,0,0&amp;fmt=png-alpha&amp;hei=150&amp;resMode=sharp2&amp;op_sharpen=1">
                </div>
                @endforeach
            </div>
        </div>
        <div class="form-group removed_pmm">
            
        </div>

        <div class="form-group">
            <h5 class="clearfix">Disclaimer<span class="req">*</span></h5>
            {!! Form::text('disclaimer', $flyer_data->disclaimer, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <h5 class="clearfix">Original Price<span class="req">*</span></h5>
            {!! Form::text('original_price', $flyer_data->original_price, ['class'=>'form-control']) !!}
        </div>

         <div class="form-group">
            <h5 class="clearfix">Sale Price<span class="req">*</span></h5>
            {!! Form::text('sale_price', $flyer_data->sale_price, ['class'=>'form-control']) !!}
        </div>

         <div class="form-group">
            <h5 class="clearfix">Notes<span class="req">*</span></h5>
            {!! Form::text('notes', $flyer_data->notes, ['class'=>'form-control']) !!}
        </div>


    </div>

    <div class="modal-footer">

        <button type="button" class="btn btn-white cancel-modal" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
        <button class="btn btn-primary"><i class='fa fa-check'></i> Save changes</button>
    </div>

{!! Form::close() !!}

	

