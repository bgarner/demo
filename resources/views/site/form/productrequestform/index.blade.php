<!DOCTYPE html>
<html>

<head>
    @section('title', 'Product Request Form')
    @include('site.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/custom/site/event.css">
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
    <link rel="stylesheet" href="/css/plugins/dataTables/datatables.min.css">
	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
</head>

<body class="fixed-navigation">
    <div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          @include('site.includes.sidenav')
	        </div>
	    </nav>

	<div id="page-wrapper" class="gray-bg" >
        <div class="row border-bottom">
            @include('site.includes.topbar')
        </div>

	    <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="">Product Requests
                    <a href="{{\Request::url()}}/create" class="pull-right btn btn-outline btn-primary dim" ><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;{{__("Create New Request")}}</a></h1>

                
                    <div class="mail-box-header animated fadeInRight">
                        <div class="row" >
                            <div class="col-md-12">
                                <h3>New and In Progress</h3>
                            </div>
                        </div>

                        <div class="">
                            <table class="table table-hover table-mail">
                                
                                    <tbody>

                                        @foreach($forms as $form)
                                            @if($form->status_id != 5)
                                            <tr>
                                                <td>
                                                    <p>
                                                        <a href="{{\Request::url()}}/{{$form->id}}">{!! $form->requirement !!}</a> &nbsp;&nbsp;&nbsp; 
                                                        <strong>{{$form->form_data["submitted_by"]}}</strong> 
                                                        <small>({{$form->form_data["submitted_by_position"]}})</small> &nbsp;&nbsp;&nbsp; {{ $form->since }} ago
                                                    </p>
                                                    <small><a href="{{\Request::url()}}/{{$form->id}}">{{$form->description}}</a></small>
                                                    <p><strong><a href="{{\Request::url()}}/{{$form->id}}">{{ $form->longDesc }}</a></strong></p>
                                                    <p>{{ $form->comments }}</p>

                                                </td>

                                            <td style="width: 200px;">
                                                @if(isset($form->lastFormAction))
                                                    
                                                    <div class="status-resolution">

                                                        <span class="status-badge {{ $form->lastFormAction->log['status_colour'] }}" style="display: inline-block;">
                                                            <i class="fa {{ $form->lastFormAction->log['status_icon'] }}" aria-hidden="true"></i> 
                                                            {{$form->lastFormAction->log["status_store_name"]}}
                                                        </span>
                                                        <br />

                                                            
                                                            <small>
                                                            {{$form->lastFormAction->log["user_name"]}} ( {{$form->lastFormAction->log["user_position"]}} )
                                                            <br />
                                                            {{ $form->lastActionSince }} ago
                                                            </small>
                                                        </div>

                                                    @endif
                                            </td>

                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                            </table>
                        </div>
                    </div>
                        <br /><br />
                        
                    <div class="mail-box-header animated fadeInRight">
                        <div class="row" >
                            <div class="col-md-12">
                                <h3>Closed</h3>
                            </div>
                        </div>

                        <div class="">
                            <table class="table table-hover table-mail datatable">
                                <thead>
                                    <th></th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach($forms as $form)
                                        @if($form->status_id == 5)
                                        <tr>
                                            <td>
                                                <p><a href="{{\Request::url()}}/{{$form->id}}">{!! $form->requirement !!}</a> &nbsp;&nbsp;&nbsp; <strong>{{$form->form_data["submitted_by"]}}</strong> <small>({{$form->form_data["submitted_by_position"]}})</small> &nbsp;&nbsp;&nbsp; {{ $form->since }} ago</p>
                                                <small><a href="{{\Request::url()}}/{{$form->id}}">{{$form->description}}</a></small>
                                                <p><strong><a href="{{\Request::url()}}/{{$form->id}}">{{ $form->longDesc }}</a></strong></p>
                                                <p>{{ $form->comments }}</p>

                                            </td>

                                            <td style="width: 200px;">
                                                @if(isset($form->lastFormAction))
                                                    
                                                    <div class="status-resolution">

                                                        <span class="status-badge {{ $form->lastFormAction->log['status_colour'] }}" style="display: inline-block;">
                                                            <i class="fa {{ $form->lastFormAction->log['status_icon'] }}" aria-hidden="true"></i> 
                                                            {{$form->lastFormAction->log["status_store_name"]}}
                                                        </span>
                                                        <br />
                                                        @if( $form->resolutionCode )
                                                            <small>Resolution<br /></small>
                                                            <p>
                                                           {{ $form->resolutionCode }}
                                                            </p>
                                                        @endif
                                                            <small>
                                                            {{$form->lastFormAction->log["user_name"]}}<br />( {{$form->lastFormAction->log["user_position"]}} )
                                                            <br />
                                                            {{ $form->lastActionSince }} ago
                                                            </small>
                                                        </div>

                                                    @endif
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>                        

            </div> <!-- row closes -->
        </div>

                

            </div>
        </div>
    </div><!-- wrapper closes -->


		@include('site.includes.footer')

	    @include('site.includes.scripts')

		@include('site.includes.bugreport')

		<script type="text/javascript" src="/js/vendor/moment.js"></script>
		<script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="/js/plugins/ckeditor-standard/ckeditor.js"></script>
		<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
		<script src="/js/custom/forms/ProductRequestForm.js"></script>
        <script type="text/javascript" src="/js/plugins/dataTables/datatables.min.js"></script>

		<script type="text/javascript">

			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});
            $(".datatable").dataTable({
                pageLength: 10,
                searching: false,
                info: false,
                lengthChange: false,
                ordering: false
            });

		</script>
        @include('site.includes.modal')
	</body>
	</html>
