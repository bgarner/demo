<!DOCTYPE html>
<html>

<head>
    @section('title', 'Dashboard')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<link href="/js/plugins/fileinput/fileinput.css" rel="stylesheet">

</head>

<body class="fixed-navigation adminview">
    <div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          @include('admin.includes.sidenav')
	        </div>
	    </nav>

		<div id="page-wrapper" class="gray-bg" >

            <div class="row wrapper border-bottom white-bg">
                <div class="col-lg-12">
                    <h2>Dashboard</h2>
                </div>
            </div>

			<div class="wrapper wrapper-content  animated fadeInRight">
			            <div class="row">
			                <div class="col-lg-12">
			                    <div class="ibox">
			                        <div class="ibox-title">
			                            <h5>Branding</h5>

			                            <div class="ibox-tools">

			                                {{-- <a href="/admin/communication/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Create New Communication</a> --}}
			                            </div>
			                        </div>
			                        <div class="ibox-content">

			                       		<input type="text" id="dashboard_title" hidden value="{{$banner->title}}">
										<input type="text" id="dashboard_subtitle" hidden value="{{$banner->subtitle}}">
										<div class="row">
{{--
												<div class="col-md-12">

													<div class="form-group">

														<div class="col-sm-2">
														<label class="control_label" for="dashboard_title">Title <span class="req">*</span></label>
														</div>
														<div class="col-sm-offset-2">
														{!! Form::input('text', 'dashboard_title', $banner->title , ['class' => 'form-control'] ) !!}
														</div>

													</div>
													<div class="form-group">
														<div class="col-sm-2">
															{!! Form::label('dashboard_subtitle', 'Subtitle', ['class' => 'control_label']) !!}
														</div>
														<div class="col-sm-offset-2">
															{!! Form::input('text', 'dashboard_subtitle', $banner->subtitle, ['class' => 'form-control'] ) !!}
														</div>

													</div>

												</div>


												 <div class="col-md-12">

													<label class="control-label">Background</label>

													<div class="row">
--}}
														<div class="col-sm-12">
															<img id="background-preview" src="/images/dashboard-banners/{{ $banner->background }}" width="100%" style="padding-bottom: 15px;" />

															<input id="dashboardbackground" name="dashboardbackground[]" type="file" multiple class="file-loading">
															<input type="hidden" value="{{ $banner->id }}" name="banner_id" id="banner_id">

														</div>
														<div class="col-sm-12">
															<small><p>For best results, background images should have an aspect ratio of 16:9 and be at least 1000 pixels wide.</p></small>
														</div>
{{-- 													</div>
 --}}

{{--
		                        		<h4>Choose from Existing</h4>
			                        		@foreach($oldBackgrounds as $ob)
			                        			<div class="backgroundOption">
			                        				@if( "images/dashboard-banners/" . $banner->background == $ob )
			                        				<i class="fa fa-check-circle-o" style="color: lime; font-size: 48px;"></i>
			                        				@endif

			                        				<img src="/{{ $ob }}"  height="100"/>

			                        			</div>
			                        		@endforeach
			                        		<br /><br />

--}}



												<!-- </div> -->
										</div>

{{--
			                        	<div class="row">

											<div class="form-group">
				                                <div class="ibox-tools">
				                                	<br /><br />
				                               		<button class="btn btn-white" id="cancel-dashboard-title-update" ><i class="fa fa-undo"></i> Undo</button>
				                                    <button class="update-dashboard btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> Save changes</button>
				                                </div>
				                            </div>


			                        	</div>
--}}


			                        </div>

			                    </div>


			                    <div class="ibox">
			                        <div class="ibox-title">
			                            <h5>Order Featured Content</h5>

			                            <div class="ibox-tools">

			                                <a href="/admin/feature" class="btn btn-primary btn"><i class="fa fa-pencil"></i> Edit Featured Content Pages</a>
			                            </div>
			                        </div>
			                        <div class="ibox-content">
			                        <small>Drag Features to reorder</small>
										<div class="dd" id="featuredcontentlist">
			                                <ol class="dd-list">
			                                	{{-- <div class="dd-placeholder" style="height: 42px;"></div> --}}
			                                    @foreach($features as $f)

			                                    <li class="dd-item" data-id="{{ $f->id }}">
			                                        	<span class="pull-left"><div class="dd-handle"><i class="fa fa-bars"></i></div></span>
			                                            {{-- <span class="pull-right"><a data-event="" id="" class="event-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></span> --}}
			                                            <img src="/images/featured-covers/{{ $f->thumbnail }}" height="30" width="30" /><span class="client-link" style="margin:0px 10px;">{{ $f->title }}</span>
			                                     </li>
			                                    @endforeach
			                                </ol>
			                            </div>
			                        </div>

			                    </div>


			                    <div class="ibox">
			                        <div class="ibox-title">
			                            <h5>QuickLinks</h5>

			                            <div class="ibox-tools">
			                                <a href="/admin/quicklink/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Create new Quicklink</a>
			                            </div>
			                        </div>
			                        <div class="ibox-content">
			                        <small>Drag Quicklinks to reorder</small>
										<div class="dd" id="quicklinkslist">
			                                <ol class="dd-list">
			                                	{{-- <div class="dd-placeholder" style="height: 42px;"></div> --}}
			                                    @foreach($quicklinks as $ql)
			                                 	<?php switch($ql->type) {
			                                    		case 1:
			                                    			$icon = '<i class="fa fa-folder"></i>';
			                                    			$type = "Folder";
			                                    			$link = '<a href="/admin/document/manager#!/'.$ql->url.'">'.$ql->link_name.'</a>';
			                                    			break;
			                                    		case 2:
			                                    			$icon = '<i class="fa fa-file-o"></i>';
			                                    			$type = "File";
			                                    			$link = '<a class="launchPDFViewer" data-toggle="modal" data-file="/viewer/?file=/files/" data-target="#fileviewmodal" > '. $ql->link_name.'</a>';
			                                    			break;
			                                    		case 3:
			                                    			$icon = '<i class="fa fa-external-link"></i>';
			                                    			$type = "Link";
			                                    			$link = '<a target="_blank" href="'. $ql->url .'">'. $ql->link_name .'</a>';
			                                    			break;
			                                    		default:
			                                    			$icon = '<i class="fa fa-cog"></i>';
			                                    			break;

			                                    	}?>
			                                    <li class="dd-item" data-id="{{ $ql->id }}">
													<span class="pull-left">
														<div class="dd-handle"><i class="fa fa-bars"></i></div>
														<span style="position: relative; top: 5px;">{!! $link !!} <span class="label label-default">{!! $icon !!} {{ $type }}</span> </span>
													</span>
													<span class="pull-right">
														<a data-quicklink="{{ $ql->id }}" id="quicklink-{{ $ql->id }}" class="quicklink-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;
													</span>
			                                     </li>
			                                    @endforeach
			                                </ol>
			                            </div>

			                        </div>

			                    </div>



			                    <div class="ibox">
			                        <div class="ibox-title">
			                            <h5>Notification Preferences</h5>
			                        </div>
			                        <div class="ibox-content">

										<div class="latest-updates row" >
												<div class="form-group">
													<label class="col-sm-2 control-label">Get Latest Updates</label>
													<div class="latest-updates-container col-md-10" >

															<input type="text" id="update_type_id" hidden value={{$banner->update_type_id}}>
															<input type="text" id="update_window_size" hidden value={{$banner->update_window_size}}>

															<div class="latest-update-option col-md-8" id="latest-update-option-1">
																{!! Form::radio('latest_updates_option', '1') !!} By Days
																{!! Form::input('text', 'update_frequency', null, ['class='=>'update_frequency', 'disabled'=> 'disabled', 'placeholder'=>'Number of Days']) !!}

															</div>
															<div class="latest-update-option col-md-8" id="latest-update-option-2">
																{!! Form::radio('latest_updates_option', '2') !!} By Documents
																{!! Form::input('text', 'update_frequency', null, ['class='=>'update_frequency', 'disabled'=> 'disabled', 'placeholder'=>'Number of Documents']) !!}
															</div>

													</div>


												</div>
										</div><!--latest-update row -->
										<div class="row">
												<div class="form-group">
					                                <div class="ibox-tools">
					                               		<button class="btn btn-white" id="cancel-notification-preferences" ><i class="fa fa-close"></i> Cancel</a>
					                                    <button class="update-notification-preferences btn btn-primary" type="submit"><i class="fa fa-check"></i> Save changes</button>

					                                </div>
					                            </div>

										</div>
			                        </div><!-- ibox-content ends -->

			                    </div><!-- ibox ends -->


			                </div>
			            </div>


	        </div> <!-- wrapper-content ends -->
    	</div> <!-- page-wrapper ends -->
    </div> <!-- wrapper ends -->


		@include('admin.includes.footer')

	    @include('admin.includes.scripts')

		<script type="text/javascript">
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});

		</script>
		<script src="/js/plugins/nestable/jquery.nestable.js"></script>
		<script src="/js/plugins/fileinput/fileinput.js"></script>
		<script src="/js/custom/admin/quicklinks/changeQuicklinksOrder.js"></script>
		<script src="/js/custom/admin/quicklinks/deleteQuicklink.js"></script>
		<script src="/js/custom/admin/features/changeFeaturesOrder.js"></script>
		<script src="/js/custom/admin/dashboard/uploadBackground.js"></script>
		<script src="/js/custom/admin/dashboard/setNotificationPreferences.js"></script>
		<script src="/js/custom/admin/dashboard/updateDashboardTitle.js"></script>
		<!-- <script src="/js/custom/admin/dashboard/setNotificationPreferences.js"></script> -->

		<script>

	         $(document).ready(function(){

			    $("#dashboardbackground").fileinput({
			        initialPreview: [],
			        overwriteInitial: true,
			        initialCaption: ""
			    });

				var serializeQuicklinksData = function (e) {
	                 var list = e.length ? e : $(e.target);
	                 var data = list.nestable('serialize');
	                 updateQuicklinksOrder(data);
	             };

				var serializeFeaturedContentData = function (e) {
	                 var list = e.length ? e : $(e.target);
	                 var data = list.nestable('serialize');
	                 updateFeaturesOrder(data);
	             };

	             $('#quicklinkslist').nestable({
	                 group: 1
	             }).on('change', serializeQuicklinksData);


	             $('#featuredcontentlist').nestable({
	                 group: 2
	             }).on('change', serializeFeaturedContentData);

	             setNotificationType();

	         });
		</script>


		@include('site.includes.bugreport')



	</body>
	</html>
