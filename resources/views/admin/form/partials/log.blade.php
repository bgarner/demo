<div id="vertical-timeline" class="vertical-container light-timeline no-margins">
    @foreach($log as $logItem)

    <div class="vertical-timeline-block">
        <div class="vertical-timeline-icon {{ $logItem->log['status_colour'] }}">
            <i class="fa {{ $logItem->log['status_icon'] }}"></i>
        </div>
        
        <div class="vertical-timeline-content">
            <h2>{{$logItem->log['status_admin_name']}}</h2>

            @if($logItem->log['comment'])
            <p><i class="fa fa-quote-left" style="color: #ddd;" aria-hidden="true"></i>&nbsp;
            <em>{{ $logItem->log['comment'] }}</em></p>
            @endif
            
            @if(isset($logItem->log['resolution_code_id']))
            <p><i class="fa fa-quote-left" style="color: #ddd;" aria-hidden="true"></i>&nbsp;
            <em>{{ $logItem->log['resolution_code'] }}</em></p>
            @endif

                <span class="">
                    <small>
                    {{ $logItem->log['user_name'] }} - {{ $logItem->log['user_position'] }}<br / />
                    <div class="pull-left">{{ $logItem->sinceSubmitted }} ago</div>
                    <div class="pull-right">{{ $logItem->prettySubmitted }}</div>
                    </small>
                </span>
                
                @if(isset($logItem->log["answer"]))
                <br class="clearfix" />
                <div class="answer_to_question">
                    
                    <p><i class="fa fa-quote-left" style="color: #ddd;" aria-hidden="true"></i>&nbsp;
                    <em>{{ $logItem->log['answer'] }}</em></p>

                    <span class="">
                        <small>
                        {{ $logItem->log['answer_submitted_by'] }} - {{ $logItem->log['answer_submitted_by_position'] }}<br / />
                        <div class="pull-left">{{ $logItem->prettySinceAnswerSubmitted }} ago</div>
                        <div class="pull-right">{{ $logItem->prettyAnswerSubmitted }}</div>
                        </small>
                    </span>

                </div>
                @endif


                @if(isset($logItem->allow_response) && is_numeric(Request::segment(1)) )
                    <input type="hidden" name="logActivityId" id="logActivityId" value="{{$logItem->id}}">

                    <div class="panel panel-success" style="margin-top: 30px;">

                        <div class="panel-heading">
                            Response Requested
                        </div>

                        <div class="panel-body">
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-right">Your Name</label> 
                                <div class="col-sm-10"><input type="text" id="submitted_by" name="submitted_by" class="form-control" value=""></div>
                            </div>      


                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-right">Your Position</label>
                                <div class="col-sm-10"><input type="text" id="submitted_by_position" name="submitted_by_position" class="form-control" value=""></div>
                            </div>  

                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-right">Comments</label>
                                <div class="col-sm-10"><input type="text" id="answer" name="answer" class="form-control" value=""></div>
                            </div>  

                            <div class="form-group">
                                <button class="btn btn-primary" id="send_response_to_question" style="margin: 18px 18px 0px 0px;"><i class="fa fa-comment-o"></i>  Send Response</button>
                            </div>
                        </div>            

                    </div>

                @endif
        </div>
    </div>

    @endforeach

</div>