@extends('manager.layouts.master')

@section('title', 'New Store Visit Report')

@section('style')
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
    <style>
    .sweet-alert p {
        color: #a91f1f !important;
    }
    </style>

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
                

                {{ Form::open(['action' => 'StoreVisitReport\ManagerStoreVisitReportController@store', 'method' => 'POST']) }}
                
                <div class="ibox">
                    
                    <div class="ibox-content">
                        <div class="form-group">
                                    <label class=" control-label">Store Number</label>
                                    <div>
                                        {!! Form::select('store_number', $stores, null, [ 'class'=>'chosen', 'id'=> 'storeSelect']) !!}
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
                                    <label class=" control-label">{{$fields['field_1']}}</label>
                                    <div>
                                        <input type="number" class="form-control form-field" name="field_1" value="" >
                                    </div>
                            </div>                                     
                            <div class="form-group">
                                    <label class=" control-label">{{$fields['field_2']}}</label>
                                    <div>
                                        <input type="number" class="form-control form-field" name="field_2" value="">
                                    </div>
                            </div>                                      
                            <div class="form-group">
                                    <label class=" control-label">{{$fields['field_3']}}</label>
                                    <div>
                                        <input type="radio" name="field_3" value="0">
                                        <label class=" control-label">
                                            &nbsp;No
                                        </label>
                                        &nbsp;
                                        <input type="radio" name="field_3" value="1">
                                        <label class=" control-label">
                                            &nbsp;Yes
                                        </label>
                                    </div>
                            </div>                                      
                            <div class="form-group">
                                    <label class=" control-label">{{$fields['field_4']}}</label>
                                    <div>
                                        
                                        <textarea id="" cols="30" rows="10" class="form-field" name="field_4" ></textarea> 
                                    </div>
                            </div>                                      
                            <div class="form-group">
                                    <label class=" control-label">{{$fields['field_5']}}</label>
                                    <div>
                                        <textarea id="" cols="30" rows="10" class="form-field" name="field_5" ></textarea>
                                    </div>
                            </div>                                      
                            <div class="form-group">
                                    <label class=" control-label">{{$fields['field_6']}}</label>
                                    <div>
                                        <textarea id="" cols="30" rows="10" class="form-field" name="field_6" ></textarea>
                                    </div>
                            </div>

                            <div>
                            <button type="submit" class="btn btn-primary store-visit-save-progress"><i class="fa fa-check"></i> Save</button></div>

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
                           <label class=" control-label">{{$fields['field_7']}}</label>

                           <div>
                                <input type="radio" name="field_7" value="0">
                                <label class=" control-label">
                                    &nbsp;No
                                </label>
                                &nbsp;
                                <input type="radio" name="field_7" value="1" >
                                <label class=" control-label">
                                    &nbsp;Yes
                                </label>
                            </div>
                       </div>                                     
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_8']}}</label>
                               <div>
                                    <input type="radio" name="field_8" value="0">
                                    <label class=" control-label">
                                        &nbsp;No
                                    </label>
                                    &nbsp;
                                    <input type="radio" name="field_8" value="1">
                                    <label class=" control-label">
                                        &nbsp;Yes
                                    </label>
                                </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_9']}}</label>

                               <div>
                                    <input type="radio" name="field_9" value="0" >
                                    <label class=" control-label">
                                        &nbsp;No
                                    </label>
                                    &nbsp;
                                    <input type="radio" name="field_9" value="1" >
                                    <label class=" control-label">
                                        &nbsp;Yes
                                    </label>
                                </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_10']}}</label>
                               <div>
                                   
                                   <textarea id="" cols="30" rows="10" class="form-field" name="field_10" ></textarea> 
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_11']}}</label>
                               <div>
                                   <textarea id="" cols="30" rows="10" class="form-field" name="field_11" ></textarea>
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_12']}}</label>
                               <div>
                                   <textarea id="" cols="30" rows="10" class="form-field" name="field_12"></textarea>
                               </div>
                       </div>                                      
						<div class="">
						<button type="submit" class="btn btn-primary store-visit-save-progress"><i class="fa fa-check"></i> Save</button></div>

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
                           <label class=" control-label">{{$fields['field_13']}}</label>
                           <div>
                                <input type="radio" name="field_13" value="0" >
                                <label class=" control-label">
                                    &nbsp;No
                                </label>
                                &nbsp;
                                <input type="radio" name="field_13" value="1" >
                                <label class=" control-label">
                                    &nbsp;Yes
                                </label>
                            </div>
                       </div>                                     
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_14']}}</label>
                               <div>
                                    <input type="radio" name="field_14" value="0" >
                                    <label class=" control-label">
                                        &nbsp;No
                                    </label>
                                    &nbsp;
                                    <input type="radio" name="field_14" value="1" >
                                    <label class=" control-label">
                                        &nbsp;Yes
                                    </label>
                                </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_15']}}</label>
                               <div>
                                   
                                   <textarea id="" cols="30" rows="10" class="form-field" name="field_15"></textarea> 
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_16']}}</label>
                               <div>
                                   <textarea id="" cols="30" rows="10" class="form-field" name="field_16"></textarea>
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_17']}}</label>
                               <div>
                                   <textarea id="" cols="30" rows="10" class="form-field" name="field_17"></textarea>
                               </div>
                       </div>                                      

						<div class="">
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
                           <label class=" control-label">{{$fields['field_18']}}</label>
                           <div>
                               <input type="number" class="form-control form-field" name="field_18" value="">
                           </div>
                       </div>                                     
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_19']}}</label>
                               <div>
                                   <input type="number" class="form-control form-field" name="field_19" value="">
                               </div>
                       </div> 
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_20']}}</label>
                               <div>
                                   <input type="number" class="form-control form-field" name="field_20" value="">
                               </div>
                       </div> 
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_21']}}</label>
                               <div>
                                   <input type="number" class="form-control form-field" name="field_21" value="">
                               </div>
                       </div> 
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_22']}}</label>

                               <div>
                                    <input type="radio" name="field_22" value="0">
                                    <label class=" control-label">
                                        &nbsp;No
                                    </label>
                                    &nbsp;
                                    <input type="radio" name="field_22" value="1">
                                    <label class=" control-label">
                                        &nbsp;Yes
                                    </label>
                                </div>
                       </div> 
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_23']}}</label>

                               <div>
                                    <input type="radio" name="field_23" value="0" >
                                    <label class=" control-label">
                                        &nbsp;No
                                    </label>
                                    &nbsp;
                                    <input type="radio" name="field_23" value="1" >
                                    <label class=" control-label">
                                        &nbsp;Yes
                                    </label>
                                </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_24']}}</label>
                               <div>
                                   
                                   <textarea id="" cols="30" rows="10" class="form-field" name="field_24"></textarea> 
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_25']}}</label>
                               <div>
                                   <textarea id="" cols="30" rows="10" class="form-field"name="field_25"></textarea>
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_26']}}</label>
                               <div>
                                   <textarea id="" cols="30" rows="10" class="form-field" name="field_26"></textarea>
                               </div>
                       </div>                                      
						<div class="">
						<button type="submit" class="btn btn-primary store-visit-save-progress"><i class="fa fa-check"></i> Save</button></div>

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
                           <label class=" control-label">{{$fields['field_27']}}</label>
                           <div>
                               <input type="number" class="form-control form-field" name="field_27" value="">
                           </div>
                       </div>                                     
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_28']}}</label>
                               <div>
                                   <input type="number" class="form-control form-field" name="field_28" value="">
                               </div>
                       </div> 
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_29']}}</label>

                               <div>
                                    <input type="radio" name="field_29" value="0">
                                    <label class=" control-label">
                                        &nbsp;No
                                    </label>
                                    &nbsp;
                                    <input type="radio" name="field_29" value="1" >
                                    <label class=" control-label">
                                        &nbsp;Yes
                                    </label>
                                </div>

                       </div> 
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_30']}}</label>

                               <div>
                                    <input type="radio" name="field_30" value="0" >
                                    <label class=" control-label">
                                        &nbsp;No
                                    </label>
                                    &nbsp;
                                    <input type="radio" name="field_30" value="1" >
                                    <label class=" control-label">
                                        &nbsp;Yes
                                    </label>
                                </div>
                       </div> 
                       
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_31']}}</label>
                               <div>
                                   
                                   <textarea id="" cols="30" rows="10" class="form-field" name="field_31"></textarea> 
                               </div>
                       </div>                                      
                       
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_32']}}</label>
                               <div>
                                   <textarea id="" cols="30" rows="10" class="form-field" name="field_32">
                                   </textarea>
                               </div>
                       </div>                                      

						<div class="">
						<button type="submit" class="btn btn-primary store-visit-save-progress"><i class="fa fa-check"></i> Save</button></div>
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
                               <label class=" control-label">{{$fields['field_33']}}</label>
                               <div>
                                   
                                   <textarea id="" cols="30" rows="10" class="form-field" name="field_33"></textarea> 
                               </div>
                       </div>                                      
                       
                       <div class="form-group">
                               <label class=" control-label">{{$fields['field_34']}}</label>
                               <div>
                                   <textarea id="" cols="30" rows="10" class="form-field" name="field_34"></textarea>
                               </div>
                       </div>                                      

						<div class="">
						<button type="submit" class="btn btn-primary store-visit-save-progress"><i class="fa fa-check"></i> Save</button></div>
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
                               <label class=" control-label">{{$fields['field_35']}}</label>
                               <div>
                                   <textarea id="" cols="30" rows="10" class="form-field" name="field_35"></textarea>
                               </div>
                       </div>                                      
						<div class="">
						<button type="submit" class="btn btn-primary store-visit-save-progress"><i class="fa fa-check"></i> Save</button></div>

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
                               <label class=" control-label">{{$fields['field_36']}}</label>
                               <div>
                                   <textarea id="" cols="30" rows="10" class="form-field" name="field_36"></textarea>
                               </div>
                       </div>                                      
						<div class="">
						<button type="submit" class="btn btn-primary store-visit-save-progress"><i class="fa fa-check"></i> Save</button></div>

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
                               <label class=" control-label" hidden>{{$fields['field_37']}}</label>
                               <div>
                                   <textarea id="" cols="30" rows="10" class="form-field" name="field_37">
                                   </textarea>
                               </div>
                       </div>                                      
						<div class="">
						<button type="submit" class="btn btn-primary store-visit-save-progress"><i class="fa fa-check"></i> Save</button></div>

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