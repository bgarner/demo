<div class="modal multi-step inmodal" id="newdonationmodal" tabindex="-1" role="event" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title step-1" data-step="1">ABOUT YOU</h4>
                <h4 class="modal-title step-2" data-step="2">ABOUT THE ORGANIZATION</h4>
                <h4 class="modal-title step-3" data-step="3">PERSON RECIEVING DONATION</h4>
                <h4 class="modal-title step-4" data-step="4">DONATION DETAILS</h4>
                <div class="m-progress">
                    <div class="m-progress-bar-wrapper">
                        <div class="m-progress-bar" style="width: 100%;">
                        </div>
                    </div>
                    <div class="m-progress-stats">
                        <span class="m-progress-current"></span>
                        /
                        <span class="m-progress-total"></span>
                    </div>
                    <div class="m-progress-complete" style="display: none;">
                        Completed
                    </div>
                </div>
            </div>
            <div class="modal-body step step-1">
                <div class="form-group">
                    <label class="control-label"><small><span class="req">*</span>Your Name</small></label>
                    <div ><input type="text" class="form-control input-sm" id="emp_name" name="emp_name"></div>
                </div>      

                <div class="form-group">
                    <label class=" control-label"><small><span class="req">*</span>Employee Number</small></label>
                    <div ><input type="text" class="form-control input-sm" id="emp_number" name="emp_number"></div>
                </div>
            </div>
            <div class="modal-body step step-2">
                <div class="form-group">
                    <label class="control-label"><small><span class="req">*</span>Organization Name</small></label>
                    <div><input type="text" class="form-control input-sm" id="org_name" name="org_name"></div>
                </div>        

                <div class="form-group">
                    <label class="control-label"><small>Team/Event Name</small></label>
                    <div><input type="text" class="form-control input-sm" id="team_event_name" name="team_event_name"></div>
                </div>     

                <div class="form-group">
                    <label class="control-label"><small><span class="req">*</span>Sport/Category</small></label>
                    <div>
                        <select class="form-control input-sm" id="sport_category" name="sport_category"> 
                            <option value="" disabled selected>Select a sport/category</option>     
                            @foreach($sport_dropdown as $sport)
                            <option value="{{ $sport->id }}">{{ $sport->sport }}</option> 
                            @endforeach                            
                        </select>
                    </div>
                </div>  

                <div class="form-group">
                    
                    <small ><i>If an event...<br /><br /></i></small>
                    
                    <div class="row">
                        <div class="col-sm-6">
                                <label class="col-sm-4 control-label"><small>Date</small></label>
                                <div class="input-group date col-sm-8">
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
            </div>
            <div class="modal-body step step-3">
                <div class="form-group">
                    <label class="control-label"><small><span class="req">*</span>Name</small></label>
                    <div><input type="text" class="form-control input-sm" id="pickup_name" name="pickup_name"></div>
                </div> 

                <div class="form-group">
                    <label class="control-label"><small><span class="req">*</span>Phone</small></label>
                    <div><input type="text" class="form-control input-sm" id="pickup_phone" name="pickup_phone"></div>
                </div> 

                <div class="form-group">
                    <label class="control-label"><small>E-mail</small></label>
                    <div><input type="text" class="form-control input-sm" id="pickup_email" name="pickup_email"></div>
                </div> 

                <div class="form-group">
                    
                    <div class="row">
                        <div class="col-sm-6">
                                <label class="col-sm-4 control-label"><small><span class="req">*</span>Pickup Date</small></label>
                                <div class="input-group date col-sm-8">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control input-sm" value="" id="pickup_date" name="pickup_date">
                                </div>
                        </div>

                        <div class="col-sm-6">

                        </div>
                    </div>                          
                </div>  
            </div>
            <div class="modal-body step step-4">
                <div class="form-group">
                    <label class="control-label"><small><span class="req">*</span>Type</small></label>
                    <div>
                        <select class="form-control input-sm" name="donationtype" id="donationtype">
                            <option></option>
                            <option value="giftcard">Gift Card</option>
                            <option value="product">Product</option>
                        </select>
                    </div>
                </div>     

                <div id="productfields">
                    <div >
                        <a id="add-product" ><i class="fa fa-plus"></i> Product</a>
                    </div>
                    <div class="product well" id="product1" data-product-number=1>
                        <div class="form-group">
                            <label class="control-label"><small><span class="req">*</span>Product Name</small></label>
                            <div><input type="text" class="form-control input-sm" id="product_name" name="product_name"></div>
                        </div>  

                        <div class="form-group">
                            <label class="control-label"><small><span class="req">*</span>Style Number</small></label>
                            <div><input type="text" class="form-control input-sm" id="style_number" name="style_number"></div>
                        </div>                          

                        <div class="form-group">
                            <label class="control-label"><small><span class="req">*</span>UPC Number</small></label>
                            <div><input type="text" class="form-control input-sm" id="upc" name="upc"></div>
                        </div>                                                  

                        <div class="form-group">
                            <label class="control-label"><small><span class="req">*</span>Value</small></label>
                            <div class="input-group date col-sm-7" style="padding-left: 15px;">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control input-sm" value="" id="product_value" name="product_value">
                            </div>
                        </div>  
                    </div> 
                </div>

                <div id="giftcardfields">
                    <div >
                        <a id="add-gift-card" ><i class="fa fa-plus"></i> Gift Card</a>
                    </div>
                    <div class="giftcard well" id="giftcard1" data-giftcard-number=1>
                        <div class="form-group">
                            <label class="control-label"><small><span class="req">*</span>Gift Card Number</small></label>
                            <div><input type="text" class="form-control input-sm" id="gc_number" name="gc_number"></div>
                        </div>  

                        <div class="form-group">
                            <label class="control-label"><small><span class="req">*</span>Value</small></label>
                            <div class="input-group date col-sm-7" style="padding-left: 15px;">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control input-sm" value="" id="gc_value" name="gc_value">
                            </div>
                        </div>  
                    </div>

                </div>
                <div class="form-group">
                    <label class="control-label"><small>Additional Notes</small></label>
                    <div><input type="text" class="form-control input-sm" name="notes" id="notes"></div>
                </div>                          

                <h5>DISTRICT MANAGER APPROVAL</h5>
                <div class="form-group">
                    <div>
                         <input type="checkbox" id="approval" name="approval" />&nbsp;&nbsp;Yes, I have approval from my District Manager for this donation.</label>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary step step-1" data-step="1" onclick="validateStep1()" style="display: none;">Continue</button>
                <button type="button" class="btn btn-primary step-2" data-step="2" onclick="sendEvent('#newdonationmodal', 1)" style="display: none;">Back</button>
                <button type="button" class="btn btn-primary step step-2" data-step="2" onclick="validateStep2()" style="display: none;">Continue</button>
                <button type="button" class="btn btn-primary step-3" data-step="3" onclick="sendEvent('#newdonationmodal', 2)" style="display: none;">Back</button>
                <button type="button" class="btn btn-primary step step-3" data-step="3" onclick="validateStep3()" style="display: none;">Continue</button>
                <button type="button" class="btn btn-primary step-4" data-step="4" onclick="sendEvent('#newdonationmodal', 3)" style="display: none;">Back</button>
                <button type="button" class="btn btn-primary step step-4" data-step="4" onclick="validateStep4()" style="display: none;">Submit</button>
            </div>
        </div>
    </div>
</div>