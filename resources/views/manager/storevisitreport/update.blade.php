@extends('manager.layouts.master')

@section('title', 'New Store Visit Report')

@section('style')
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">

@endsection


@section('content')
    
    <div class="row wrapper border-bottom white-bg page-heading">

        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
            <h2>{{__("Store Visit Report")}}</h2>

        </div>

    </div>
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                {!! Form::open([
                    'action' => ['StoreVisitReport\ManagerStoreVisitReportController@update',
                    $report->id],
                    'method' => 'PATCH']) !!}
                    
                <div class="ibox">
                    
                    <div class="ibox-content">
                        <div class="form-group">
                            <label class=" control-label">Store Number</label>
                            <div>
                                {!! Form::select('store_number', $stores, $report->store_number, [ 'class'=>'chosen', 'id'=> 'storeSelect']) !!}
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="ibox">
                    <div class="ibox-title">
                        <h2>TABLET SALES</h2>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="form-group">
                                <label class=" control-label">Last Week's Tablet Sales Result:</label>
                                <div>
                                    <input type="number" class="form-control" name="field_1" value="{{$report->fieldResponses['field_1']}}" >
                                </div>
                        </div>                                     
                        <div class="form-group">
                                <label class=" control-label">6Wk Trend Tablet Sales Result:</label>
                                <div>
                                    <input type="number" class="form-control" name="field_2" value="{{$report->fieldResponses['field_2']}}">
                                </div>
                        </div>                                      
                        <div class="form-group">
                                <label class=" control-label">Are PDTs and Tablets in use in each dept?</label>
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
                                <label class=" control-label">Validate staff understanding and coach Winning Habits. Provide findings and coaching notes:</label>
                                <div>
                                    
                                    <textarea id="" cols="30" rows="10" name="field_4" >{!! $report->fieldResponses['field_4'] !!}</textarea> 
                                </div>
                        </div>                                      
                        <div class="form-group">
                                <label class=" control-label">How is Tablet Sales being coached / communicated on a daily basis?</label>
                                <div>
                                    <textarea id="" cols="30" rows="10" name="field_5" >{!! $report->fieldResponses['field_5']!!}</textarea>
                                </div>
                        </div>                                      
                        <div class="form-group">
                                <label class=" control-label">IMPROVEMENT PLAN</label>
                                <div>
                                    <textarea id="" cols="30" rows="10" name="field_6" >{!! $report->fieldResponses['field_6'] !!}</textarea>
                                </div>
                        </div>

                        <div>
                            <a class="btn btn-white" href="/manager/storevisitreport"><i class="fa fa-close"></i> Cancel</a>
                            <button type="submit" class="btn btn-primary store-visit-save-progress"><i class="fa fa-check"></i> Save</button>
                        </div>

                    </div>   
                </div>

                <div class="ibox">
                    <div class="ibox-title">
                        <h2>EFFECTIVE SCHEDULING</h2>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">             
                        <div class="form-group">
                           <label class=" control-label">Reviewed hiring needs and open postings:</label>

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
                               <label class=" control-label">Are schedules being posted 3 weeks out?</label>
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
                            <label class=" control-label">Is Autofill being used weekly:</label>

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
                            <label class=" control-label">Validate that the management schedule aligns with business needs. Provide findings and coaching notes:</label>
                            <div>
                               
                                <textarea id="" cols="30" rows="10" name="field_10" >{!! $report->fieldResponses['field_10'] !!}</textarea> 
                            </div>
                       </div>                                      
                       <div class="form-group">
                            <label class=" control-label">Validate that staff schedule aligns with business needs. Provide findings and coaching notes:</label>
                            <div>
                                <textarea id="" cols="30" rows="10" name="field_11" >{!!$report->fieldResponses['field_11']!!}</textarea>
                            </div>
                       </div>                                      
                       <div class="form-group">
                            <label class=" control-label">IMPROVEMENT PLAN</label>
                            <div>
                                <textarea id="" cols="30" rows="10" name="field_12">{!! $report->fieldResponses['field_12'] !!}</textarea>
                            </div>
                       </div>                                      
						<div class="">
                            <a class="btn btn-white" href="/manager/storevisitreport"><i class="fa fa-close"></i> Cancel</a>
                            <button type="submit" class="btn btn-primary store-visit-save-progress"><i class="fa fa-check"></i> Save</button>
                        </div>

                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

                <div class="ibox">
                    <div class="ibox-title">
                        <h2>MOD</h2>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">             
                        <div class="form-group">
                           <label class=" control-label">MOD Schedule is in place and posted?</label>
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
                            <label class=" control-label">MOD Show Me Steps are at 100%?</label>
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
                            <label class=" control-label">Validate management understanding and coach Winning Habits. Provide findings and coaching notes:</label>
                            <div>
                                   
                                <textarea id="" cols="30" rows="10" name="field_15"> {!!$report->fieldResponses['field_15']!!} </textarea> 
                            </div>
                       </div>                                      
                       <div class="form-group">
                            <label class=" control-label">How well is this executed in store? Is it effective, making an impact? Provide findings, coaching notes:</label>
                            <div>
                                <textarea id="" cols="30" rows="10" name="field_16">{!!$report->fieldResponses['field_16']!!}</textarea>
                            </div>
                       </div>                                      
                       <div class="form-group">
                            <label class=" control-label">IMPROVEMENT PLAN</label>
                            <div>
                                <textarea id="" cols="30" rows="10" name="field_17">
                                       {!!$report->fieldResponses['field_17']!!}
                                </textarea>
                            </div>
                       </div>                                      

						<div class="">
                            <a class="btn btn-white" href="/manager/storevisitreport"><i class="fa fa-close"></i> Cancel</a>

                            <button type="submit" class="btn btn-primary store-visit-save-progress"><i class="fa fa-check"></i> Save</button></div>
                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

                <div class="ibox">
                    <div class="ibox-title">
                        <h2>DOM</h2>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">             
                        <div class="form-group">
                           <label class=" control-label">Last Week's Aged Orders %:</label>
                           <div>
                               <input type="number" class="form-control" name="field_18" value="{{$report->fieldResponses['field_18']}}">
                           </div>
                       </div>                                     
                       <div class="form-group">
                            <label class=" control-label">6Wk Trend Aged Orders %:</label>
                            <div>
                                <input type="number" class="form-control" name="field_19" value="{{$report->fieldResponses['field_19']}}">
                            </div>
                       </div> 
                       <div class="form-group">
                            <label class=" control-label">Last Week's Dirty Node %:</label>
                            <div>
                                <input type="number" class="form-control" name="field_20" value="{{$report->fieldResponses['field_20']}}">
                            </div>
                       </div> 
                       <div class="form-group">
                            <label class=" control-label">6Wk Trend Dirty Node %:</label>
                            <div>
                                <input type="number" class="form-control" name="field_21" value="{{$report->fieldResponses['field_21']}}">
                            </div>
                       </div> 
                       <div class="form-group">
                            <label class=" control-label">Is store using DOM Staffing Tool for scheduling? Determine packer/picking hours?</label>

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
                            <label class=" control-label">Has the store reviewed upcoming order forecast to assess supply needs?</label>

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
                            <label class=" control-label">Validate dirty nodes list on portal and weekly use of dirty node scanning app. Provide findings, notes:</label>
                            <div>
                                   
                                <textarea id="" cols="30" rows="10" name="field_24">{!!$report->fieldResponses['field_24']!!}</textarea> 
                            </div>
                       </div>                                      
                       <div class="form-group">
                            <label class=" control-label">Validate that Stock Locator setup is underway or in place (where applicable). Provide findings, notes:</label>
                            <div>
                                <textarea id="" cols="30" rows="10" name="field_25">{!!$report->fieldResponses['field_25']!!}</textarea>
                            </div>
                       </div>                                      
                       <div class="form-group">
                            <label class=" control-label">IMPROVEMENT PLAN</label>
                            <div>
                                <textarea id="" cols="30" rows="10" name="field_26">{!!$report->fieldResponses['field_26']!!}</textarea>
                            </div>
                       </div>                                      
						<div class="">
                            <a class="btn btn-white" href="/manager/storevisitreport"><i class="fa fa-close"></i> Cancel</a>
                            <button type="submit" class="btn btn-primary store-visit-save-progress"><i class="fa fa-check"></i> Save</button>
                        </div>

                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

                <div class="ibox">
                    <div class="ibox-title">
                        <h2>AUDITS</h2>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">             
                        <div class="form-group">
                           <label class=" control-label">Last Month's Self Audit %:</label>
                           <div>
                               <input type="number" class="form-control" name="field_27" value="{{$report->fieldResponses['field_27']}}">
                           </div>
                       </div>                                     
                       <div class="form-group">
                               <label class=" control-label">Last Official Full Store Audit %</label>
                               <div>
                                   <input type="number" class="form-control" name="field_28" value="{{$report->fieldResponses['field_28']}}">
                               </div>
                       </div> 
                       <div class="form-group">
                           <label class=" control-label">Are thorough, accurate Self Audits being completed by SGM monthly?</label>

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
                           <label class=" control-label">Are thorough bag checks are being completed every night?</label>

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
                           <label class=" control-label">Audit 5 new hire employee files for ALL necessary forms, signatures, etc. Provide findings, notes:</label>
                           <div>
                               
                               <textarea id="" cols="30" rows="10" name="field_31">{!!$report->fieldResponses['field_31']!!}</textarea> 
                           </div>
                       </div>                                      
                       
                       <div class="form-group">
                           <label class=" control-label">IMPROVEMENT PLAN</label>
                           <div>
                               <textarea id="" cols="30" rows="10" name="field_32">
                                   {!!$report->fieldResponses['field_32']!!}
                               </textarea>
                           </div>
                       </div>                                      

                        <div class="">
                            <a class="btn btn-white" href="/manager/storevisitreport"><i class="fa fa-close"></i> Cancel</a>
                            <button type="submit" class="btn btn-primary store-visit-save-progress"><i class="fa fa-check"></i> Save</button>
                        </div>
                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

                <div class="ibox">
                    <div class="ibox-title">
                        <h2>VISUAL INITIATIVES</h2>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">             
                       
                       <div class="form-group">
                            <label class=" control-label">Validate the following where applicable: Category Store Setup, Helly Shops, Woods Shops, Gym Bag fixture, Holiday Impulse Lanes, Sports Nutrition. Provide findings and notes:</label>
                            <div>
                                   
                                <textarea id="" cols="30" rows="10" name="field_33">{!!$report->fieldResponses['field_33']!!}</textarea> 
                            </div>
                       </div>                                      
                       
                       <div class="form-group">
                            <label class=" control-label">IMPROVEMENT PLAN on INVENTORY INTENSITY</label>
                            <div>
                                <textarea id="" cols="30" rows="10" name="field_34">{!!$report->fieldResponses['field_34']!!}</textarea>
                            </div>
                       </div>                                      

						<div class="">
                            <a class="btn btn-white" href="/manager/storevisitreport"><i class="fa fa-close"></i> Cancel</a>
                            <button type="submit" class="btn btn-primary store-visit-save-progress"><i class="fa fa-check"></i> Save</button>
                        </div>
                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

                <div class="ibox">
                    <div class="ibox-title">
                        <h2>5 Success Factors</h2>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">             
                       
                       <div class="form-group">
                            <label class=" control-label">IMPROVEMENT PLAN</label>
                            <div>
                                <textarea id="" cols="30" rows="10" name="field_35">{!!$report->fieldResponses['field_35']!!}</textarea>
                            </div>
                       </div>                                      
						<div class="">
                            <a class="btn btn-white" href="/manager/storevisitreport"><i class="fa fa-close"></i> Cancel</a>
                            <button type="submit" class="btn btn-primary store-visit-save-progress"><i class="fa fa-check"></i> Save</button>
                        </div>

                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

                <div class="ibox">
                    <div class="ibox-title">
                        <h2>TRIBAL CUSTOMS</h2>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">             
                       
                       <div class="form-group">
                            <label class=" control-label">IMPROVEMENT PLAN</label>
                            <div>
                                <textarea id="" cols="30" rows="10" name="field_36">{!!$report->fieldResponses['field_36']!!}</textarea>
                            </div>
                       </div>                                      
						<div class="">
                            <a class="btn btn-white" href="/manager/storevisitreport"><i class="fa fa-close"></i> Cancel</a>
                            <button type="submit" class="btn btn-primary store-visit-save-progress"><i class="fa fa-check"></i> Save</button>
                        </div>

                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

                <div class="ibox">
                    <div class="ibox-title">
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
                                <textarea id="" cols="30" rows="10" name="field_37">
                                       {!!$report->fieldResponses['field_37']!!}
                                </textarea>
                            </div>
                       </div>                                      
						<!-- <div class="">
                            <a class="btn btn-white" href="/manager/storevisitreport"><i class="fa fa-close"></i> Cancel</a>
                            <button type="submit" class="btn btn-primary store-visit-save-progress"><i class="fa fa-check"></i> Save</button>
                        </div> -->

                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->
				
                <div class="form-group">
                    <div class=" col-sm-offset-2">
                        <input type="text" hidden name="is_draft" value="1">
                        <a class="btn btn-white" href="/manager/storevisitreport"><i class="fa fa-close"></i> Cancel</a>
                        <button type="submit" class="btn btn-primary" id="store-visit-submit"><i class="fa fa-check"></i> Submit Report</button>
                    </div>
                </div>
				{!! Form::close() !!}
            </div>
        </div>


    </div>

@endsection        

@section('scripts')

    
    <script type="text/javascript" src="/js/plugins/ckeditor-custom/ckeditor.js"></script>
    <script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
    <script type="text/javascript" src="/js/custom/manager/storevisitreport/validateReport.js"></script>


@endsection