<div class="ibox float-e-margins">
    <div class="ibox-content mailbox-content">
        <div class="file-manager">

            <div class="space-25"></div>

            <ul class="folder-list m-b-md" style="padding: 0">
                <li>
                    <a class="tasklist_title" href="/{{ Request::segment(1) }}/task"> <i class="fa fa-inbox "></i> {{__("All Tasks")}}
                    {{--@if($communicationCount > 0)
                    <span class="label label-inverse pull-right">{{ $communicationCount </span>
                    @endif--}}
                    </a>
                </li>

            </ul>
            <h5>{{__("task lists")}}</h5>
            <ul class="category-list" style="padding: 0">
            @foreach($tasklists as $tasklist)

                <li><a class="tasklist_title" href="/{{ Request::segment(1) }}/tasklist/{{ $tasklist->id }}"> <span class="label pull-right">{{-- $c->count --}}</span> {{ $tasklist->title }}</a></li>

            @endforeach
            </ul>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
