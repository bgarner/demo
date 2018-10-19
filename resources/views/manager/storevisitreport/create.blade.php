@extends('manager.layouts.master')

@section('title', 'New Store Visit Report')

@section('style')


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
                                    <div class="">
                                        <input type="text" class="form-control">
                                    </div>
                            </div>                                     
                            <div class="form-group">
                                    <label class=" control-label">6Wk Trend Tablet Sales Result:</label>
                                    <div class="">
                                        <input type="text" class="form-control">
                                    </div>
                            </div>                                      
                            <div class="form-group">
                                    <label class=" control-label">Are PDTs and Tablets in use in each dept?</label>
                                    <div class="">
                                        <input type="text" class="form-control">
                                    </div>
                            </div>                                      
                            <div class="form-group">
                                    <label class=" control-label">Validate staff understanding and coach Winning Habits. Provide findings and coaching notes:</label>
                                    <div class="">
                                        
                                        <textarea name="" id="" cols="30" rows="10"></textarea> 
                                    </div>
                            </div>                                      
                            <div class="form-group">
                                    <label class=" control-label">How is Tablet Sales being coached / communicated on a daily basis?</label>
                                    <div class="">
                                        <textarea name="" id="" cols="30" rows="10"></textarea>
                                    </div>
                            </div>                                      
                            <div class="form-group">
                                    <label class=" control-label">IMPROVEMENT PLAN</label>
                                    <div class="">
                                        <textarea name="" id="" cols="30" rows="10"></textarea>
                                    </div>
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
                           <label class=" control-label">Reviewed hiring needs and open postings:               </label>
                           <div class="">
                               <input type="text" class="form-control">
                           </div>
                       </div>                                     
                       <div class="form-group">
                               <label class=" control-label">Are schedules being posted 3 weeks out?                </label>
                               <div class="">
                                   <input type="text" class="form-control">
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">Is Autofill being used weekly:</label>
                               <div class="">
                                   <input type="text" class="form-control">
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">Validate that the management schedule aligns with business needs. Provide findings and coaching notes:</label>
                               <div class="">
                                   
                                   <textarea name="" id="" cols="30" rows="10"></textarea> 
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">Validate that staff schedule aligns with business needs. Provide findings and coaching notes:</label>
                               <div class="">
                                   <textarea name="" id="" cols="30" rows="10"></textarea>
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">IMPROVEMENT PLAN</label>
                               <div class="">
                                   <textarea name="" id="" cols="30" rows="10"></textarea>
                               </div>
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
                           <div class="">
                               <input type="text" class="form-control">
                           </div>
                       </div>                                     
                       <div class="form-group">
                               <label class=" control-label">MOD Show Me Steps are at 100%?</label>
                               <div class="">
                                   <input type="text" class="form-control">
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">Validate management understanding and coach Winning Habits. Provide findings and coaching notes:</label>
                               <div class="">
                                   
                                   <textarea name="" id="" cols="30" rows="10"></textarea> 
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">How well is this executed in store? Is it effective, making an impact? Provide findings, coaching notes:</label>
                               <div class="">
                                   <textarea name="" id="" cols="30" rows="10"></textarea>
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">IMPROVEMENT PLAN</label>
                               <div class="">
                                   <textarea name="" id="" cols="30" rows="10"></textarea>
                               </div>
                       </div>                                      


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
                           <div class="">
                               <input type="text" class="form-control">
                           </div>
                       </div>                                     
                       <div class="form-group">
                               <label class=" control-label">6Wk Trend Aged Orders %:</label>
                               <div class="">
                                   <input type="text" class="form-control">
                               </div>
                       </div> 
                       <div class="form-group">
                               <label class=" control-label">Last Week's Dirty Node %:</label>
                               <div class="">
                                   <input type="text" class="form-control">
                               </div>
                       </div> 
                       <div class="form-group">
                               <label class=" control-label">6Wk Trend Dirty Node %:</label>
                               <div class="">
                                   <input type="text" class="form-control">
                               </div>
                       </div> 
                       <div class="form-group">
                               <label class=" control-label">Is store using DOM Staffing Tool for scheduling? Determine packer/picking hours?</label>
                               <div class="">
                                   <input type="text" class="form-control">
                                   <br>
                               </div>
                       </div> 
                       <div class="form-group">
                               <label class=" control-label">Has the store reviewed upcoming order forecast to assess supply needs?</label>
                               <div class="">
                                   <input type="text" class="form-control">
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">Validate dirty nodes list on portal and weekly use of dirty node scanning app. Provide findings, notes:</label>
                               <div class="">
                                   
                                   <textarea name="" id="" cols="30" rows="10"></textarea> 
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">Validate that Stock Locator setup is underway or in place (where applicable). Provide findings, notes:</label>
                               <div class="">
                                   <textarea name="" id="" cols="30" rows="10"></textarea>
                               </div>
                       </div>                                      
                       <div class="form-group">
                               <label class=" control-label">IMPROVEMENT PLAN</label>
                               <div class="">
                                   <textarea name="" id="" cols="30" rows="10"></textarea>
                               </div>
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
                           <div class="">
                               <input type="text" class="form-control">
                           </div>
                       </div>                                     
                       <div class="form-group">
                               <label class=" control-label">Last Official Full Store Audit %</label>
                               <div class="">
                                   <input type="text" class="form-control">
                               </div>
                       </div> 
                       <div class="form-group">
                               <label class=" control-label">Are thorough, accurate Self Audits being completed by SGM monthly?</label>
                               <div class="">
                                   <input type="text" class="form-control">
                               </div>
                       </div> 
                       <div class="form-group">
                               <label class=" control-label">Are thorough bag checks are being completed every night?</label>
                               <div class="">
                                   <input type="text" class="form-control">
                               </div>
                       </div> 
                       
                       <div class="form-group">
                               <label class=" control-label">Audit 5 new hire employee files for ALL necessary forms, signatures, etc. Provide findings, notes:</label>
                               <div class="">
                                   
                                   <textarea name="" id="" cols="30" rows="10"></textarea> 
                               </div>
                       </div>                                      
                       
                       <div class="form-group">
                               <label class=" control-label">IMPROVEMENT PLAN</label>
                               <div class="">
                                   <textarea name="" id="" cols="30" rows="10"></textarea>
                               </div>
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
                               <div class="">
                                   
                                   <textarea name="" id="" cols="30" rows="10"></textarea> 
                               </div>
                       </div>                                      
                       
                       <div class="form-group">
                               <label class=" control-label">IMPROVEMENT PLAN on INVENTORY INTENSITY</label>
                               <div class="">
                                   <textarea name="" id="" cols="30" rows="10"></textarea>
                               </div>
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
                               <div class="">
                                   <textarea name="" id="" cols="30" rows="10"></textarea>
                               </div>
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
                               <div class="">
                                   <textarea name="" id="" cols="30" rows="10"></textarea>
                               </div>
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
                               <div class="">
                                   <textarea name="" id="" cols="30" rows="10"></textarea>
                               </div>
                       </div>                                      


                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

                <div class="form-group">
                    <div class=" col-sm-offset-2">
                        <a class="btn btn-white" href="/admin/communication"><i class="fa fa-close"></i> Cancel</a>
                        <button class="btn btn-primary communication-create"><i class="fa fa-check"></i> Submit Report</button>
                    </div>
                </div>

            </div>
        </div>


    </div>

@endsection        

@section('scripts')


@endsection