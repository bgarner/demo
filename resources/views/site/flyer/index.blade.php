<!DOCTYPE html>
<html>

<head>
    @section('title', 'Flyer')
    @include('site.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
</head>

<body class="fixed-navigation adminview">
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

		<div class="row wrapper border-bottom white-bg page-heading">
            <div class="row" >
            <div class="col-lg-6">
                <h2>Flyers</h2>
            </div>

            <div class="col-lg-4 col-lg-offset-2" id="archive-switch" style="padding-top: 30px;">
                <form class="form-inline" >
                    <div class="pull-right">

                        <small style="font-weight: bold; padding-right: 5px;">{{ ucwords(trans('lang.show_archive')) }}</small>

                            <div class="switch pull-right">
                                <div class="archive-onoffswitch onoffswitch">

                                    @if($archives)
                                        <input type="checkbox" checked="" class="onoffswitch-checkbox" id="archives" name="archives">
                                    @else
                                        <input type="checkbox" class="onoffswitch-checkbox" id="archives" name="archives">
                                    @endif

                                    <label class="onoffswitch-label" for="archives">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>

                    </div>
                </form>
            </div>
            </div>
        </div>


		<div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">

                        <div class="ibox-content">

	                    	<table class="table">
	                    		<thead>
	                    			<tr role="row">
	                    				<th>Flyer Name</th>
	                    				<th>Start Date</th>
	                    				<th>End Date</th>
	                    			</tr>
	                    		</thead>
	                    		<tbody>
	                    			@foreach($flyers as $flyer)
										<tr role="row" data-flyer-id="{{$flyer->id}}"
											@if($flyer->archived)
												class="flyer archived"
											@else
												class="flyer"
											@endif
										>
											<td><a class="trackclick" href="flyer/{{ $flyer->id }}" data-flyer-id="{{ $flyer->id }}" title="View Flyer">{{ $flyer->flyer_name }}</a></td>
											<td>{{ $flyer->pretty_start_date }}</td>
											<td>{{ $flyer->pretty_end_date }}</td>
										</tr>
	                    			@endforeach

				                </tbody>

			                </table>

                        </div>

                    </div>
                </div>
		    </div>
		</div>

		@include('site.includes.footer')

	    @include('site.includes.scripts')

		@include('site.includes.modal')
		<script type="text/javascript" src="/js/custom/site/getArchivedContent.js?<?=time();?>"></script>
		
		<script type="text/javascript">

	        $( document ).ready(function() {
	            var archiveCheckbox  = $('#archives');
	            var checked = archiveCheckbox.is(":checked");

	            if( checked == true){
	                $("a.alert_category_link").each(function() {
	                   var href = $(this).attr("href");
	                   $(this).attr("href", href + '&archives=true');
	                });
	            } else {
	                $("a.alert_category_link").each(function() {
	                   var href = $(this).attr("href");
	                   $(this).attr('href', href.replace(/&?archives=\d+/, ''));
	                });
	            }
	        });

	    </script>


	</body>
	</html>
