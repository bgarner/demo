<div class="modal inmodal" id="newdonationmodal" tabindex="-1" role="event" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">
        <div class="modal-content animated fadeInDown">
{{--                 <div class="modal-header clearfix">
                    <h4 id="modalTitle" class="modal-title">New Donation</h4>
                </div> --}}
                <div id="modalBody" class="modal-body event-modal-body" style="padding: 20px;">
                    
            

                    <form method="get" class="form-horizontal">
                        <h5>ABOUT YOU</h5>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small><span class="req">*</span>Your Name</small></label>
                            <div class="col-sm-10"><input type="text" class="form-control input-sm" id="emp_name" name="emp_name"></div>
                        </div>      

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small><span class="req">*</span>Employee Number</small></label>
                            <div class="col-sm-10"><input type="text" class="form-control input-sm" id="emp_number" name="emp_number"></div>
                        </div>                                               
                       
                        <div class="hr-line-dashed"></div>                       
                        <h5>ABOUT THE ORGANIZATION</h5>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small><span class="req">*</span>Organization Name</small></label>
                            <div class="col-sm-10"><input type="text" class="form-control input-sm" id="org_name" name="org_name"></div>
                        </div>        

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small>Team/Event Name</small></label>
                            <div class="col-sm-10"><input type="text" class="form-control input-sm" id="team_event_name" name="team_event_name"></div>
                        </div>      

                        <div class="form-group">
                            
                            <small style="padding-left: 60px;"><i>If an event...<br /><br /></i></small>
                            
                            <div class="row">
                                <div class="col-sm-6">
                                        <label class="col-sm-5 control-label"><small>Date</small></label>
                                        <div class="input-group date col-sm-7">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control input-sm" value="" id="event_date" name="event_date">
                                        </div>
                                </div>

                                <div class="col-sm-6">

                                    <label class="col-sm-4 control-label"><small>Location</small></label>
                                    <div class="col-sm-8"><input type="text" class="form-control input-sm" id="event_location" name="event_location"></div>  
                                </div>
                            </div>                          
                        </div>    

                        <div class="hr-line-dashed"></div> 
                        <h5>PERSON RECIEVING DONATION</h5>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small><span class="req">*</span>Name</small></label>
                            <div class="col-sm-10"><input type="text" class="form-control input-sm" id="pickup_name" name="pickup_name"></div>
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small><span class="req">*</span>Phone</small></label>
                            <div class="col-sm-10"><input type="text" class="form-control input-sm" id="pickup_phone" name="pickup_phone"></div>
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small>E-mail</small></label>
                            <div class="col-sm-10"><input type="text" class="form-control input-sm" id="pickup_email" name="pickup_email"></div>
                        </div> 

                        <div class="form-group">
                            
                            <div class="row">
                                <div class="col-sm-6">
                                        <label class="col-sm-5 control-label"><small>Pickup Date</small></label>
                                        <div class="input-group date col-sm-7">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control input-sm" value="" id="pickup_date" name="pickup_date">
                                        </div>
                                </div>

                                <div class="col-sm-6">

                                </div>
                            </div>                          
                        </div>  
            
                     
                        <div class="hr-line-dashed"></div>                            
                        <h5>DONATION DETAILS</h5>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small><span class="req">*</span>Type</small></label>
                            <div class="col-sm-10">
                                <select class="form-control input-sm" name="donationtype" id="donationtype">
                                    <option></option>
                                    <option value="giftcard">Gift Card</option>
                                    <option value="product">Product</option>
                                </select>
                            </div>
                        </div>     

                        <div id="prodcutfields">
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><small><span class="req">*</span>Product Name</small></label>
                                <div class="col-sm-10"><input type="text" class="form-control input-sm" id="product_name" name="product_name"></div>
                            </div>  

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><small><span class="req">*</span>Style Number</small></label>
                                <div class="col-sm-10"><input type="text" class="form-control input-sm" id="style_number" name="style_number"></div>
                            </div>                          

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><small><span class="req">*</span>UPC Number</small></label>
                                <div class="col-sm-10"><input type="text" class="form-control input-sm" id="upc" name="upc"></div>
                            </div>                                                  

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><small><span class="req">*</span>Value</small></label>
                                <div class="input-group date col-sm-7" style="padding-left: 15px;">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control input-sm" value="" id="product_value" name="product_value">
                                </div>
                            </div>   
                        </div>

                        <div id="giftcardfields">                                                                                                                  
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><small><span class="req">*</span>Gift Card Number</small></label>
                                <div class="col-sm-10"><input type="text" class="form-control input-sm" id="gc_number" name="gc_number"></div>
                            </div>  

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><small><span class="req">*</span>Value</small></label>
                                <div class="input-group date col-sm-7" style="padding-left: 15px;">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control input-sm" value="" id="gc_value" name="gc_value">
                                </div>
                            </div>  

                        </div>


                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><small>Additional Notes</small></label>
                            <div class="col-sm-10"><input type="text" class="form-control input-sm" name="notes" id="notes"></div>
                        </div>                          

                        <div class="hr-line-dashed"></div>
                        <h5>DISTRICT MANAGER APPROVAL</h5>
                        <div class="form-group">
                            <div class="col-sm-10">
                                 <input type="checkbox" id="approval" name="approval" />&nbsp;&nbsp;Yes, I have approval from my District Manager for this donation.</label>
                            </div>
                        </div>
                      

                    </form>  
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-primary btn-sm btn-outline" data-dismiss="modal"><i class="fa fa-times"></i> Close</button> --}}
                    <button class="btn btn-primary pull-right" type="submit" id="donationsubmit">Submit</button>
                </div>
        </div>
    </div>
</div>