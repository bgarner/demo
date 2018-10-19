@extends('manager.layouts.master')

@section('title', 'New Store Visit Report')

@section('style')


@endsection


@section('content')

    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Create a New Store Visit Report</h5>
                    </div>
                    <div class="ibox-content">

                        <form class="form-horizontal" id="createNewCommunicationForm">


                            <div class="form-group">
                                <label class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10"><input type="text" id="subject" name="subject" class="form-control" value=""></div>
                            </div>
                            <div class="form-group">

                                    <label class="col-sm-2 control-label">Start &amp; End</label>

                                    <div class="col-sm-10">
                                        <div class="input-daterange input-group" id="datepicker">
                                            <input type="text" class="input-sm form-control datetimepicker-start" name="send_at" id="send_at" value="" />
                                            <span class="input-group-addon">to</span>
                                            <input type="text" class="input-sm form-control datetimepicker-end" name="archive_at" id="archive_at" value="" />
                                        </div>
                                    </div>
                            </div>                                      
                                        
                            

                        </form>

                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

                

                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <a class="btn btn-white" href="/admin/communication"><i class="fa fa-close"></i> Cancel</a>
                        <button class="btn btn-primary communication-create"><i class="fa fa-check"></i> Send New Communication</button>
                    </div>
                </div>

            </div>
        </div>


    </div>

@endsection        

@section('scripts')


@endsection