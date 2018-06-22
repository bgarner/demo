@if(count($notifications) > 0)
<span>
<a class="faa-parent animated-hover notifications count-info" id="notification_popover">
    <i class="fa fa-bell faa-shake "></i>
    <span class="label label-danger">{{count($notifications)}}</span>
</a>
</span>

<div id="notification_detail_container" hidden>
    
    @foreach($notifications as $notification)
    <div class="feed-element">
        <div class="media-body">
            <span class="pull-left" style="padding: 0px 10px 0px 0px;">
                <h4 style="padding: 0; margin: 0;"><a href="#" ><i class="fa fa-paper-plane"></i></a></h4>
            </span>
            <small class="pull-right" style="padding-left: 10px;">{{$notification->prettyCreatedAt }} ago</small>
            <a href="{{$notification->data['url']}}" > {{$notification->data['notification_text']}} </a>
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