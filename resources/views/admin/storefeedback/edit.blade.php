<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Feedback')
    @include('admin.includes.head')
    
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
    <link rel="stylesheet" type="text/css" href="/css/custom/feature.css">
	
	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
</head>

<body class="fixed-navigation adminview">
    <div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          @include('admin.includes.sidenav')
	        </div>
	    </nav>

	<div id="page-wrapper" class="gray-bg" >
		<div class="row border-bottom">
			@include('admin.includes.topbar')
        </div>

		<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Update a Feedback</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a href="/admin/feedback">Feedback</a>
                        </li>
                        <li class="active">
                            <strong>Update a Feedback</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
		</div>

		<div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Update Feedback</h5>
                            
                        </div>
                        <div class="ibox-content">

                            <form  method="" class="form-horizontal"   >
                                <input type="hidden" name="feedbackID" id="feedbackID" value="{{ $feedback->id }}">
                                <input type="hidden" name="banner_id" value="{{$banner->id}}">

                                <div class="form-group">
                                	<label class="col-sm-2 col-md-2 col-lg-1 control-label"> Description </label>
                                    <div class="col-sm-10 col-md-10 col-lg-11">
                                    	<input type="text" id="feedback_description" name="feedback_description" class="form-control" value="{{ $feedback->description }}" readonly>

                                    </div>
                                </div>

                                <div class="form-group">
                                	<label class="col-sm-2 col-md-2 col-lg-1 control-label">Current URL</label>
                                	<div class="col-sm-10 col-md-10 col-lg-11">
                                		<input type="text" id="feedback_url" name="feedback_url" class="form-control" value="{{ $feedback->current_url}}" readonly> 
                                	</div>
                                </div>

                                 <div class="form-group">
                                	<label class="col-sm-2 col-md-2 col-lg-1 control-label">Store Number</label>
                                	<div class="col-sm-10 col-md-10 col-lg-11">
                                		<input type="text" id="store_number" name="store_number" class="form-control" value="{{ $feedback->store_number}}" readonly> 
                                	</div>
                                </div>

                                <div class="form-group">
                                	<label class="col-sm-2 col-md-2 col-lg-1 control-label">Follow up requested</label>
                                	<div class="col-sm-10 col-md-10 col-lg-11">
                                		@if($feedback->follow_up)
                                		<input type="checkbox" id="follow_up" name="follow_up" class="form-control" disabled checked > 
                                		@else
                                		<input type="checkbox" id="follow_up" name="follow_up" class="form-control" disabled > 

                                		@endif
                                	</div>
                                	
                                	
                                </div>
                                <div class="form-group">
                                	<label class="col-sm-2 col-md-2 col-lg-1 control-label">Sent At</label>
                                	<div class="col-sm-10 col-md-10 col-lg-11">
                                		<input type="text" id="created_at" name="created_at" class="form-control" value="{{ $feedback->created_at}}" readonly> 
                                	</div>
                                </div>
                            </form>

                        </div>
                    </div>

                    <div class="ibox">
                    	<div class="ibox-title">
                    		<h5> Update Status </h5>
                    		<div class="ibox-tools">
                    			
                    		</div>
                    	</div>
                    	<div class="ibox-content">
                    		<form class="form-horizontal">
                    		<div class="form-group">
                    			<label class="col-sm-2 col-md-2 col-lg-1 control-label"> Update Feedback Category </label>
                    			
                    			<div class="col-sm-10 col-md-10 col-lg-11 feedback-codes">
                    				@if(isset($feedback->category))

                    					{!! Form::select('feedback_category', $feedback_category_list, $feedback->category->id ,['class'=>'form-control', 'id'=>'feedback_category']) !!}
                    				@else

                    					{!! Form::select('feedback_category', $feedback_category_list, null, [
                    					'class' =>'form-control', 'id'=>'feedback_category']) !!}
                    				@endif
                    			</div>

                    		</div>
                    		<div class="form-group">
                    			<label class="col-sm-2 col-md-2 col-lg-1 control-label"> Update Feedback Status </label>
                    			
                    			<div class="col-sm-10 col-md-10 col-lg-11 feedback-codes">
                                    @if(isset($feedback->response->feedback_status_id))
                				        {!! Form::select('feedback_status', $feedback_status_list, $feedback->response->feedback_status_id ,['class'=>'form-control', 'id'=>'feedback_status']) !!}
                                    @else
                                        {!! Form::select('feedback_status', $feedback_status_list, null ,['class'=>'form-control', 'id'=>'feedback_status']) !!}
                                    @endif
                    			</div>

                    		</div>
                            @if($feedback->follow_up)
                            <div class="form-group">
                                <label class="col-sm-2 col-md-2 col-lg-1 control-label"> Followed Up </label>
                                
                                <div class="col-sm-10 col-md-10 col-lg-11 followed_up">
                                    @if(isset($feedback->response) && $feedback->response->followed_up)
                                        <input type="checkbox" id="followed_up" name="followed_up" class="form-control" checked> 
                                    @else
                                        <input type="checkbox" id="followed_up" name="followed_up" class="form-control"> 
                                    @endif
                                </div>

                            </div>
                            @endif
                    		</form>
						</div> <!-- ibox content closes -->
					</div>

                    <div class="ibox">
                    	<div class="ibox-title">
                    		<h5> Notes </h5>
                    		<div class="ibox-tools">
                    			
                    			<div id="add-more-notes" class="btn btn-primary btn-outline col-md-offset-8" role="button" ><i class="fa fa-plus"></i> Add New Note</div>
                    		</div>

                    	</div>
                    	<div class="ibox-content">
                        	<form class="form-horizontal">
                            	<div class="form-group">
                            		<label class="col-sm-2 col-md-2 col-lg-1 control-label" >
                            			Notes
                            		</label>
                            		<div class="col-sm-10 col-md-10 col-lg-11 feedback-notes">
                            			@if(isset($feedback->notes))
                            				@foreach($feedback->notes as $note)
                            				<input type="textarea" id="note{{$note->id}}" data-note-id ="{{$note->id}}" class="feedback-note form-control" value="{{ $note->note }}">
                            				<div class="col-sm-2 col-sm-offset-10 col-md-2 col-md-offset-10 col-lg-2 col-lg-offset-10">
                            					{!! $note->displayText !!}
                            					{!! $note->prettyDisplayDate !!}
                            				</div>
                            				
                            				@endforeach

                            			@endif

                            		</div>
                            	</div>
                        	</form>
						</div>		

                    </div>                    

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <a class="btn btn-white" href="/admin/feedback"><i class="fa fa-close"></i> Cancel</a>
                            <button class="feature-update btn btn-primary" type="submit"><i class="fa fa-check"></i> Save changes</button>

                        </div>
                    </div>
                            
                </div>
            </div>
        </div>

        <div class="modal inmodal" id="new-note" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
            <div class="modal-content animated flipInY">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-note-o modal-icon"></i>
                        <h4 class="modal-title">Feedback Note</h4>
                    </div>
                   <div class="modal-body" style="padding: 10px 10px;">
                        <div class="form-group">
                            
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="text" hidden id="feedback_id" name="feedback_id" value= {{$feedback->id}}>

                            <textarea rows="5" class="form-control" name="note" id="note" placeholder="Add a note"></textarea>
                            <br>
                            

                        </div>
                
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary createNote" data-dismiss="modal">Create Note</button>
                    </div>
                </div>
            </div>
        </div>


	@include('site.includes.footer')

	@include('admin.includes.scripts')
    </div>


	
    
	@include('site.includes.bugreport')


	<script type="text/javascript" src="/js/custom/admin/feedbacks/editFeedback.js"></script>
	<script type="text/javascript" src="/js/custom/tree.js"></script>
	<script src="/js/custom/datetimepicker.js"></script>
     <script src="/js/custom/sendBugReport.js"></script>
	
	<script type="text/javascript">
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
		});

    	    

	</script>

	
</body>
</html>
