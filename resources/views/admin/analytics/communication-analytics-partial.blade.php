<div class="ibox">
    <div class="ibox-title">
        <h2>Communications <small>(Last 30 Days)</small></h2>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content">


        <div class="row">
            <div class="col-md-12">

                <table class="table table-stripped" id="communication_analytics">
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
                    @foreach($commStats as $comm)
                    <tr class="details-control">
                        <td>
                            @if(isset($comm->banners))
                            @foreach($comm->banners as $banner_id)
                                
                                <small class="label label-sm logolabel {{$banners->where('id', $banner_id)->first()->banner_class}}">{{$banner_id}}</small>
                                    
                            @endforeach
                            @endif
                        </td>
                        <td>{{ $comm->subject }}
                        <span class="label label-sm label-{{ $comm->colour }}">{{ $comm->communication_type }}</span></td>
                        <td>{{ $comm->send_at }}</td>
                        <td data-order="{{$comm->readPerc}}" data-read-perc = {{$comm->readPerc}}>

                            <canvas id="commChart_{{ $comm->id }}" width="45" height="45" style="width: 45px; height: 45px;"></canvas>
                        </td>
                        <td >{{$comm->opened}}</td>
                        <td >{{$comm->unopened}}</td>
                        <td >{{$comm->sent_to}}</td>
                    </tr>

                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>

</div>