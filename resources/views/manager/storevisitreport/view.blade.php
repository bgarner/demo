@extends('manager.layouts.master')

@section('title', 'Store Visit Report')

@section('style')
    <style>
        .ibox-title{
            color: #FFFFFF;    
            background-color: #2276b1;
        }
        .ibox-title .fa{
            color: #FFFFFF;
        }

    </style>
@endsection


@section('content')

    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">

           <div class="col-lg-12 animated fadeInRight">
               
                <div class="ibox">
                    <!-- <div class="ibox-title"> -->
                        <h2>Store Visit Report: {{ $report->store_number }} submitted on {{ $report->prettySubmitted }} <small>({{ $report->sinceSubmitted }} ago)</small></h2>
                    <!-- </div> -->
                    

                </div><!-- ibox closes -->

                <div class="ibox">
                    <div class="ibox-title" id="title_tablet_sales">
                        <h2>TABLET SALES</h2>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="ibox-content">

                            <div class="form-group">
                                    <label class=" control-label">{{$report->fields['field_1']}}</label>
                                    <div>{{$report->fieldResponses['field_1']}}</div>
                                    
                            </div>                                     
                            <div class="form-group">
                                    <label class=" control-label">{{$report->fields['field_2']}}</label>
                                    <div>
                                        {{$report->fieldResponses['field_2']}}
                                    </div>
                            </div>                                      
                            <div class="form-group">
                                    <label class=" control-label">{{$report->fields['field_3']}}</label>
                                    <div>
                                        <input type="radio" name="field_3" value="0" @if(isset($report['fieldResponses']['field_3']) && $report['fieldResponses']['field_3'] == 0)   checked = "checked" @endif>
                                        <label class=" control-label">
                                            &nbsp;No
                                        </label>
                                        &nbsp;
                                        <input type="radio" name="field_3" value="1" @if(isset($report['fieldResponses']['field_3']) && $report['fieldResponses']['field_3'] == 1) checked="checked" @endif>
                                        <label class=" control-label">
                                            &nbsp;Yes
                                        </label>
                                    </div>
                            </div>                                      
                            <div class="form-group">
                                    <label class=" control-label">{{$report->fields['field_4']}}</label>
                                    
                                    <div>
                                        {!! $report->fieldResponses['field_4'] !!}
                                    </div>
                                    
                            </div>                                      
                            <div class="form-group">
                                    <label class=" control-label">{{$report->fields['field_5']}}</label>
                                    <div>
                                        {!! $report->fieldResponses['field_5']!!}
                                    </div>
                            </div>                                      
                            <div class="form-group">
                                    <label class=" control-label">{{$report->fields['field_6']}}</label>
                                    <div>
                                        {!! $report->fieldResponses['field_6'] !!}
                                    </div>
                            </div>

                            <div>
                            </div>

                    </div>   
                </div>

                <div class="ibox">
                    <div class="ibox-title" id="title_effective_scheduling">
                        <h2>EFFECTIVE SCHEDULING</h2>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">             
                        <div class="form-group">
                           <label class=" control-label">{{$report->fields['field_7']}}</label>

                           <div>
                                <input type="radio" name="field_7" value="0" @if(isset($report['fieldResponses']['field_7']) && $report['fieldResponses']['field_7'] == 0)   checked = "checked" @endif>
                                <label class=" control-label">
                                    &nbsp;No
                                </label>
                                &nbsp;
                                <input type="radio" name="field_7" value="1" @if(isset($report['fieldResponses']['field_7']) && $report['fieldResponses']['field_7'] == 1)   checked = "checked" @endif>
                                <label class=" control-label">
                                    &nbsp;Yes
                                </label>
                            </div>
                       </div>                                     
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_8']}}</label>
                               <div>
                                    <input type="radio" name="field_8" value="0" @if(isset($report['fieldResponses']['field_8']) && $report['fieldResponses']['field_8'] == 0)   checked = "checked" @endif>
                                    <label class=" control-label">
                                        &nbsp;No
                                    </label>
                                    &nbsp;
                                    <input type="radio" name="field_8" value="1" @if(isset($report['fieldResponses']['field_8']) && $report['fieldResponses']['field_8'] == 1)   checked = "checked" @endif>
                                    <label class=" control-label">
                                        &nbsp;Yes
                                    </label>
                                </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_9']}}</label>

                               <div>
                                    <input type="radio" name="field_9" value="0" @if(isset($report['fieldResponses']['field_9']) && $report['fieldResponses']['field_9'] == 0)   checked = "checked" @endif>
                                    <label class=" control-label">
                                        &nbsp;No
                                    </label>
                                    &nbsp;
                                    <input type="radio" name="field_9" value="1" @if(isset($report['fieldResponses']['field_9']) && $report['fieldResponses']['field_9'] == 1)   checked = "checked" @endif>
                                    <label class=" control-label">
                                        &nbsp;Yes
                                    </label>
                                </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_10']}}</label>
                               <div>
                                   
                                   {!! $report->fieldResponses['field_10'] !!} 
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_11']}}</label>
                               <div>
                                   {!!$report->fieldResponses['field_11']!!}
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_12']}}</label>
                               <div>
                                   {!!$report->fieldResponses['field_12'] !!}
                               </div>
                       </div>                                      
                        

                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

                <div class="ibox">
                    <div class="ibox-title" id="title_mod">
                        <h2>MOD</h2>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">             
                        <div class="form-group">
                           <label class=" control-label">{{$report->fields['field_13']}}</label>
                           <div>
                                <input type="radio" name="field_13" value="0" @if(isset($report['fieldResponses']['field_13']) && $report['fieldResponses']['field_13'] == 0)   checked = "checked" @endif>
                                <label class=" control-label">
                                    &nbsp;No
                                </label>
                                &nbsp;
                                <input type="radio" name="field_13" value="1" @if(isset($report['fieldResponses']['field_13']) && $report['fieldResponses']['field_13'] == 1)   checked = "checked" @endif>
                                <label class=" control-label">
                                    &nbsp;Yes
                                </label>
                            </div>
                       </div>                                     
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_14']}}</label>
                               <div>
                                    <input type="radio" name="field_14" value="0" @if(isset($report['fieldResponses']['field_14']) &&  $report['fieldResponses']['field_14'] == 0)   checked = "checked" @endif>
                                    <label class=" control-label">
                                        &nbsp;No
                                    </label>
                                    &nbsp;
                                    <input type="radio" name="field_14" value="1" @if(isset($report['fieldResponses']['field_14']) && $report['fieldResponses']['field_14'] == 1)   checked = "checked" @endif>
                                    <label class=" control-label">
                                        &nbsp;Yes
                                    </label>
                                </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_15']}}</label>
                               <div>
                                   {!!$report->fieldResponses['field_15']!!}  
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_16']}}</label>
                               <div>
                                   {!!$report->fieldResponses['field_16']!!}
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_17']}}</label>
                               <div>
                                    {!!$report->fieldResponses['field_17']!!}
                               </div>
                       </div>                                      

                        <div class="">
                        </div>
                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

                <div class="ibox">
                    <div class="ibox-title" id="title_dom">
                        <h2>DOM</h2>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">             
                        <div class="form-group">
                           <label class=" control-label">{{$report->fields['field_18']}}</label>
                           <div>
                               {{$report->fieldResponses['field_18']}}
                           </div>
                       </div>                                     
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_19']}}</label>
                               <div>
                                   {{$report->fieldResponses['field_19']}}
                               </div>
                       </div> 
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_20']}}</label>
                               <div>
                                   {{$report->fieldResponses['field_20']}}
                               </div>
                       </div> 
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_21']}}</label>
                               <div>
                                   {{$report->fieldResponses['field_21']}}
                               </div>
                       </div> 
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_22']}}</label>

                               <div>
                                    <input type="radio" name="field_22" value="0" @if(isset($report['fieldResponses']['field_22']) && $report['fieldResponses']['field_22'] == 0)   checked = "checked" @endif>
                                    <label class=" control-label">
                                        &nbsp;No
                                    </label>
                                    &nbsp;
                                    <input type="radio" name="field_22" value="1" @if(isset($report['fieldResponses']['field_22']) && $report['fieldResponses']['field_22'] == 1)   checked = "checked" @endif>
                                    <label class=" control-label">
                                        &nbsp;Yes
                                    </label>
                                </div>
                       </div> 
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_23']}}</label>

                               <div>
                                    <input type="radio" name="field_23" value="0" @if(isset($report['fieldResponses']['field_23']) && $report['fieldResponses']['field_23'] == 0)   checked = "checked" @endif>
                                    <label class=" control-label">
                                        &nbsp;No
                                    </label>
                                    &nbsp;
                                    <input type="radio" name="field_23" value="1" @if(isset($report['fieldResponses']['field_23']) && $report['fieldResponses']['field_23'] == 1)   checked = "checked" @endif>
                                    <label class=" control-label">
                                        &nbsp;Yes
                                    </label>
                                </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_24']}}</label>
                               <div>
                                   {!!$report->fieldResponses['field_24']!!} 
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_25']}}</label>
                               <div>
                                   {!!$report->fieldResponses['field_25']!!}
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_26']}}</label>
                               <div>
                                   {!!$report->fieldResponses['field_26']!!}
                               </div>
                       </div>                                      
                        <div class="">
                        </div>

                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

                <div class="ibox">
                    <div class="ibox-title" id="title_audits">
                        <h2>AUDITS</h2>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">             
                        <div class="form-group">
                           <label class=" control-label">{{$report->fields['field_27']}}</label>
                           <div>
                               {{$report->fieldResponses['field_27']}}
                           </div>
                       </div>                                     
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_28']}}</label>
                               <div>
                                   {{$report->fieldResponses['field_28']}}
                               </div>
                       </div> 
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_29']}}</label>

                               <div>
                                    <input type="radio" name="field_29" value="0" @if(isset($report['fieldResponses']['field_29']) && $report['fieldResponses']['field_29'] == 0)   checked = "checked" @endif>
                                    <label class=" control-label">
                                        &nbsp;No
                                    </label>
                                    &nbsp;
                                    <input type="radio" name="field_29" value="1" @if(isset($report['fieldResponses']['field_29']) && $report['fieldResponses']['field_29'] == 1)   checked = "checked" @endif>
                                    <label class=" control-label">
                                        &nbsp;Yes
                                    </label>
                                </div>

                       </div> 
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_30']}}</label>

                               <div>
                                    <input type="radio" name="field_30" value="0" @if(isset($report['fieldResponses']['field_30']) && $report['fieldResponses']['field_30'] == 0)   checked = "checked" @endif>
                                    <label class=" control-label">
                                        &nbsp;No
                                    </label>
                                    &nbsp;
                                    <input type="radio" name="field_30" value="1" @if(isset($report['fieldResponses']['field_30']) && $report['fieldResponses']['field_30'] == 1)   checked = "checked" @endif>
                                    <label class=" control-label">
                                        &nbsp;Yes
                                    </label>
                                </div>
                       </div> 
                       
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_31']}}</label>
                               <div>
                                   {!!$report->fieldResponses['field_31']!!} 
                               </div>
                       </div>                                      
                       
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_32']}}</label>
                               <div>
                                    {!!$report->fieldResponses['field_32']!!}
                               </div>
                       </div>                                      

                        <div class="">
                        </div>
                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

                <div class="ibox">
                    <div class="ibox-title" id="title_visual_initiatives">
                        <h2>VISUAL INITIATIVES</h2>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">             
                       
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_33']}}</label>
                               <div>
                                   {!!$report->fieldResponses['field_33']!!} 
                               </div>
                       </div>                                      
                       
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_34']}}</label>
                               <div>
                                   {!!$report->fieldResponses['field_34']!!}
                               </div>
                       </div>                                      

                        <div class="">
                        </div>
                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

                <div class="ibox">
                    <div class="ibox-title" id="title_success_factors">
                        <h2>5 Success Factors</h2>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">             
                       
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_35']}}</label>
                               <div>
                                   {!!$report->fieldResponses['field_35']!!}
                               </div>
                       </div>                                      
                        <div class="">
                        </div>

                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

                <div class="ibox">
                    <div class="ibox-title" id="title_tribal_customs">
                        <h2>TRIBAL CUSTOMS</h2>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">             
                       
                       <div class="form-group">
                               <label class=" control-label">{{$report->fields['field_36']}}</label>
                               <div>
                                   {!!$report->fieldResponses['field_36']!!}
                               </div>
                       </div>                                      
                        <div class="">
                        </div>

                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

                <div class="ibox">
                    <div class="ibox-title" id="title_overall_comments">
                        <h2>OVERALL COMMENTS</h2>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">             
                       
                       <div class="form-group">
                               <label class=" control-label"></label>
                               <div>
                                   {!!$report->fieldResponses['field_37']!!}
                               </div>
                       </div>                                      
                        <div class="">
                        </div>

                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

           </div>
       </div>

    </div>

@endsection        

@section('scripts')
<script>

    $(':radio:not(:checked)').attr('disabled', true);
</script>



@endsection