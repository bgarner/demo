<div class="ibox float-e-margins">
    <div class="ibox-content mailbox-content">
        <div class="file-manager">
            
            <div class="space-25"></div>
            
            <ul class="folder-list m-b-md" style="padding: 0">
                <li>
                    <a class="alert_category_link" href="/{{ Request::segment(1) }}/alert?"> <i class="fa fa-bell "></i>{{ __('All Alerts') }}
                    @if($alertCount > 0)
                    <span class="label label-inverse pull-right">{{ $alertCount }}</span>
                    @endif
                    </a>
                </li>

            </ul>
            <h5>{{ trans('Categories') }}</h5>
            <ul class="category-list" style="padding: 0">
            @foreach($alertTypes as $at)

                <li><a class="alert_category_link" href="/{{ Request::segment(1) }}/alert?type={{ $at->id }}"> <span class="label label pull-right">{{ $at->count }}</span> {{ $at->name }}</a></li>

            @endforeach
            </ul>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
