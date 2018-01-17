<div class="ibox">
    <div class="ibox-title">
        <h2>Videos</h2>
        <div class="ibox-tools">
            <!-- <a class="btn btn-xs" id="videoReportModal">View Report by Date</a> -->
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>

    </div>
    <div class="ibox-content">

        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> Analytics by Videos </a></li>
                <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">Analytics by Store</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">

                                <table class="table table-stripped" id="video_analytics">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Title</th>
                                            <th>Thumbnail</th>
                                            <th>Seen</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($videoStats as $video)
                                    <tr class="video-details-control">
                                        <td></td>
                                        <td>{{ $video['title'] }}</td>
                                        <td><img src="/video/thumbs/{{$video['thumbnail']}}" style="width: 35%" /></td>
                                        <td data-order="{{$video['readPerc']}}" data-read-perc = {{$video['readPerc']}}>

                                            <canvas id="videoChart_{{ $video['id'] }}" width="45" height="45" style="width: 45px; height: 45px;"></canvas>
                                        </td>
                                        <td >{{$video['opened']}}</td>
                                        <td >{{$video['unopened']}}</td>
                                        <td >{{$video['sent_to']}}</td>
                                    </tr>

                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <ul class="pagination">
                                <li class="pagination_link" id="previous" data-pageId="{{$videoPreviousPageIndex}}">
                                    <span>« Previous</span>
                                </li>
                                <li class="pagination_link" id="next" data-pageId="{{$videoNextPageIndex}}"><span>Next »</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Start &amp; End</label>

                                <div class="col-sm-6">
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="input-sm form-control datetimepicker-start" name="start_date" id="start_date" value="" />
                                        <span class="input-group-addon">to</span>
                                        <input type="text" class="input-sm form-control datetimepicker-end" name="end_date" id="end_date" value="" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <a class="btn btn-default" id="generateVideoReport">Get Report  </a>
                                    <a class="btn btn-default hidden" id="downloadVideoReport">Download</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <input type="text" id="reportJson" class="hidden">
                            <table class="table table-stripped hidden" id="video_analytics_by_store">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Store Number</th>
                                        <th>Total Videos Seen</th>

                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div><!-- ibox content closes -->

</div><!-- ibox closes -->