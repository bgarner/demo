<div class="modal inmodal" id="newdonationmodal" tabindex="-1" role="event" aria-hidden="true" style="display: none;" >

    <div class="modal-dialog">
        <div class="modal-content animated fadeInDown">
{{--                 <div class="modal-header clearfix">
                    <h4 id="modalTitle" class="modal-title">New Donation</h4>
                </div> --}}
                <div id="modalBody" class="modal-body event-modal-body" style="padding: 20px;">
                    
            

                    <form method="get" class="form-horizontal">
                        <h5>ABOUT YOU</h5>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small>Your Name</small></label>
                            <div class="col-sm-10"><input type="text" class="form-control input-sm"></div>
                        </div>      

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small>Employee Number</small></label>
                            <div class="col-sm-10"><input type="text" class="form-control input-sm"></div>
                        </div>                                               
                       
                        <div class="hr-line-dashed"></div>                       
                        <h5>ABOUT THE ORGANIZATION</h5>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small>Organization Name</small></label>
                            <div class="col-sm-10"><input type="text" class="form-control input-sm"></div>
                        </div>        

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small>Team/Event Name</small></label>
                            <div class="col-sm-10"><input type="text" class="form-control input-sm"></div>
                        </div>      

{{--                         <div class="form-group">
                            <label class="col-sm-2 control-label"><small>Sport</small></label>
                            <div class="col-sm-10">
                                <select class="form-control input-sm" name="account">
                                    <option></option>
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                </select>
                            </div>
                        </div>   --}}             



                        <div class="form-group">
                            
                            <small style="padding-left: 60px;"><i>If an event...<br /><br /></i></small>
                            
                            <div class="row">
                                <div class="col-sm-6">
                                        <label class="col-sm-5 control-label"><small>Date</small></label>
                                        <div class="input-group date col-sm-7">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control input-sm" value="11/02/2016">
                                        </div>
                                </div>

                                <div class="col-sm-6">

                                    <label class="col-sm-4 control-label"><small>Location</small></label>
                                    <div class="col-sm-8"><input type="text" class="form-control input-sm"></div>  
                                </div>
                            </div>                          
                        </div>    

                        <div class="hr-line-dashed"></div> 
                        <h5>PERSON RECIEVING DONATION</h5>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small>Name</small></label>
                            <div class="col-sm-10"><input type="text" class="form-control input-sm"></div>
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small>Phone</small></label>
                            <div class="col-sm-10"><input type="text" class="form-control input-sm"></div>
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small>E-mail</small></label>
                            <div class="col-sm-10"><input type="text" class="form-control input-sm"></div>
                        </div> 

                        <div class="form-group">
                            
              
                            
                            <div class="row">
                                <div class="col-sm-6">
                                        <label class="col-sm-5 control-label"><small>Pickup Date</small></label>
                                        <div class="input-group date col-sm-7">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control input-sm" value="11/02/2016">
                                        </div>
                                </div>

                                <div class="col-sm-6">

                                </div>
                            </div>                          
                        </div>  
            
                     
                        <div class="hr-line-dashed"></div>                            
                        <h5>DONATION DETAILS</h5>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small>Type</small></label>
                            <div class="col-sm-10">
                                <select class="form-control input-sm" name="account">
                                    <option>Gift Card</option>
                                    <option>Product</option>
                                </select>
                            </div>
                        </div>     

 
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small>Product Name</small></label>
                            <div class="col-sm-10"><input type="text" class="form-control input-sm"></div>
                        </div>  

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small>Style Number</small></label>
                            <div class="col-sm-10"><input type="text" class="form-control input-sm"></div>
                        </div>                          

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small>UPC Number</small></label>
                            <div class="col-sm-10"><input type="text" class="form-control input-sm"></div>
                        </div>                                                  

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small>Value</small></label>
                            <div class="input-group date col-sm-7" style="padding-left: 15px;">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control input-sm" value="">
                            </div>
                        </div>   

                                                                                                                  

{{--                         <div class="form-group">
                            <label class="col-sm-2 control-label"><small>Gift Card Number</small></label>
                            <div class="col-sm-10"><input type="text" class="form-control input-sm"></div>
                        </div>  

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small>Value</small></label>
                            <div class="input-group date col-sm-7" style="padding-left: 15px;">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control input-sm" value="">
                            </div>
                        </div>   --}}



                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small>Additional Notes</small></label>
                            <div class="col-sm-10"><input type="text" class="form-control input-sm"></div>
                        </div>                          

                        <div class="hr-line-dashed"></div>
                        <h5>DISTRICT MANAGER APPROVAL</h5>
                        <div class="form-group">
                        <div class="col-sm-10">
                        
                        <div class="icheckbox_square-green checked" style="position: relative;"><input type="checkbox" value="" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>

                         {{--                <div class="i-checks"><label class=""> <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" value="" style="position: absolute; opacity: 0;">
                                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                        </div>  --}}
                                        <i></i> &nbsp;&nbsp;Yes, I have approval from my District Manager for this donation.</label>
                                    </div>
                        </div>
                      

                    </form>  
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-primary btn-sm btn-outline" data-dismiss="modal"><i class="fa fa-times"></i> Close</button> --}}
                    <button class="btn btn-primary pull-right" type="submit">Submit</button>
                </div>
        </div>
    </div>
</div>