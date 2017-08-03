{!! Form::model($flyer, ['action' => ['Flyer\FlyerAdminController@update', 'id'=>$flyer->id], 'method' => 'PUT']) !!}

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Flyer</h4>
    </div>

    <div class="modal-body">

        <input type="hidden" name="banner_id" value="{{$banner->id}}">
        

        <div class="form-group">
            <h5 class="clearfix">Flyer Name<span class="req">*</span></h5>
            {!! Form::text('flyer_name', $flyer->flyer_name, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <h5 class="clearfix">Start and End Dates</h5>
                                <!-- <label class="col-sm-2 control-label">Start &amp; End</label> -->

                                
            <div class="input-daterange input-group" id="datepicker">
                <input type="text" class="input-sm form-control datetimepicker-start" name="start_date" id="start_date" value="{{$flyer->start_date}}" />
                <span class="input-group-addon">to</span>
                <input type="text" class="input-sm form-control datetimepicker-end" name="end_date" id="end_date" value="{{$flyer->end_date}}" />
            </div>
        </div>

        
    </div>

    <div class="modal-footer">

        <button type="button" class="btn btn-white cancel-modal" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
        <button class="btn btn-primary"><i class='fa fa-check'></i> Save changes</button>
    </div>

{!! Form::close() !!}
<script type="text/javascript" src="/js/custom/datetimepicker-with-default-time.js"></script>

	

