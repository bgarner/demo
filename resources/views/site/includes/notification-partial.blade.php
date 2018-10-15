@if(count($notifications) > 0)
<span>
<a class="faa-parent animated-hover notifications count-info" id="notification_popover">
    <i class="fa fa-bell faa-shake "></i>
    <span class="label label-danger">{{count($notifications)}}</span>
    @include('site.includes.help-icon', ['parentView' => 'site.dashboard.index', 'section' => 'help_dashboard_notifications'])
</a>
</span>

<div id="notification_detail_container" hidden>
    
    @foreach($notifications as $notification)
    <div class="feed-element" style="border-bottom: thin dotted">
        <div class="media-body" style="line-height: 15px;">
            <span class="pull-left" style="padding: 0px 10px 0px 0px; display:list-item;">
                <!-- <h4 style="padding: 0; margin: 0;"> -->
                    <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x icon-background5"></i>
                    <i class="fa fa-paper-plane fa-stack-1x"></i>
                    </span>
                <!-- </h4> -->
            </span>
            <small class="pull-right" style="padding-left: 10px;">{{$notification->prettyCreatedAt }} ago</small>
            <span>
            <a href="{{$notification->data['url']}}" > {{$notification->data['notification_text']}} </a>
            </span>
        </div>
    </div>
    @endforeach

    <!-- <div>
        <div class="text-center link-block">
            <a href="/">
                <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
            </a>
        </div>
    </div> -->
</div>

@endif