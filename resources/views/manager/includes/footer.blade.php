
<div class="footer fixed clearfix">
	<div class="pull-left">
        <small> &copy; {{ date("Y") }}</small>

    </div>
    <div class="pull-right">
    	<small>{{__("Application Last Updated")}}: @include('site.includes.release-date')</small>&nbsp;&nbsp;&nbsp;
    	<a href="#" data-toggle="modal" data-target="#changelogmodal"><i class="fa fa-rocket"></i> {{__("What's New?")}}</a>&nbsp;&nbsp;&nbsp;
    	<a href="#" data-toggle="modal" data-target="#bugreportmodal"><i class="fa fa-comment"></i> {{__("Feedback")}}</a>&nbsp;&nbsp;&nbsp;
        {{--  <div class="btn-group dropup">
            <a href="#" data-toggle="dropdown"><i class="fa fa-language"></i> {{__("Language")}}</a>
            
            <ul class="dropdown-menu lang-select">

                @foreach($languages as $key=>$value)
                    @if($currentLang == $key)
                        <li><a data-lang="{{$key}}" data-langname="{{$value}}" href="#" class="setUserLang"><i class="fa fa-check" aria-hidden="true"></i>&nbsp; {{$value}}</a></li>
                    @else
                        <li><a data-lang="{{$key}}" data-langname="{{$value}}" href="#" class="setUserLang">{{$value}}</a></li>
                    @endif
                @endforeach
                
            </ul>
        </div>  --}}
    </div>
</div>
