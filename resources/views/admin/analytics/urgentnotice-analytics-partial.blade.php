<div class="ibox">
    <div class="ibox-title">
        <h2>Urgent Notice <small>(Last 30 Days)</small></h2>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content">


        <div class="row">
            <div class="col-md-12">

                <table class="table table-stripped" id="urgent_notice_analytics">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Subject</th>
                            <th>Sent At</th>
                            <th>Read</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($urgentNoticeStats as $urgentNotice)
                    <tr class="un-details-control">
                        <td>
                            @if(isset($urgentNotice->banners))
                            @foreach($urgentNotice->banners as $banner_id)
                                
                                <small class="label label-sm logolabel {{$banners->where('id', $banner_id)->first()->banner_class}}">{{$banner_id}}</small>
                                    
                            @endforeach
                            @endif
                        </td>
                        <td>{{ $urgentNotice->title }}</td>
                        <td>{{ $urgentNotice->start }}</td>
                        <td data-order="{{$urgentNotice->readPerc}}" data-read-perc = {{$urgentNotice->readPerc}}>

                            <canvas id="urgentNoticeChart_{{ $urgentNotice->id }}" width="45" height="45" style="width: 45px; height: 45px;"></canvas>
                        </td>
                        <td >{{$urgentNotice->opened}}</td>
                        <td >{{$urgentNotice->unopened}}</td>
                        <td >{{$urgentNotice->sent_to}}</td>
                    </tr>

                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>

</div>