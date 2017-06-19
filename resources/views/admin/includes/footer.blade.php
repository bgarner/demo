
            <div class="footer fixed clearfix">
        	<div class="pull-left">
                <small> FGL Sports Ltd &copy; {{ date("Y") }}</small>

            </div>
            <div class="pull-right">
            	<small>{{__("Application Last Updated")}}: @include('site.includes.release-date')</small>&nbsp;&nbsp;&nbsp;
            	<a href="#" data-toggle="modal" data-target="#changelogmodal"><i class="fa fa-rocket"></i> {{__("What's New?")}}</a>&nbsp;&nbsp;&nbsp;
            	<a href="#" data-toggle="modal" data-target="#bugreportmodal"><i class="fa fa-comment"></i> {{__("Feedback")}}</a>&nbsp;&nbsp;&nbsp;
                {{-- <a href="#" data-toggle="modal" data-target="#langmodal"><i class="fa fa-language"></i> Language</a> --}}
            </div>
        </div>
