<!DOCTYPE html>
<html>

<head>
    @section('title', 'Product Request Form')
    @include('site.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/custom/site/event.css">
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
</head>

<body class="fixed-navigation adminview">
    <div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          @include('site.includes.sidenav')
	        </div>
	    </nav>

	<div id="page-wrapper" class="gray-bg" >
		<div class="row border-bottom">
            @include('site.includes.topbar')
        </div>

	<div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                    	@if(isset($formInstance))
							<h5>Edit Store Feedback Form</h5>
                    	@else
                        	<h5>New Product Request</h5>
                        @endif
                    </div>
                    <div class="ibox-content">

						@if(isset($formInstance))
							<form class="form-horizontal" id="editProductRequestForm">
							<input type="text" hidden value="{{$formInstance->form_data}}" id="formdata">

						@else
						    <form class="form-horizontal" id="createNewProductRequestForm">
						@endif

							<input type="hidden" name="form_id" id="form_id" value="{{ $form_id }}" />

							<div class="form-group">
								<label class="col-sm-2 control-label">Department <span class="req">*</span></label>
					            <div class="col-sm-10">
					            	<select name="department" id="department" class="form-control input-sm">
					            		<option>Select</option>
					            	</select>
					            </div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Category <span class="req">*</span></label>
					            <div class="col-sm-10">
					            	<select name="category" id="category" class="form-control input-sm">
					            		<option>Select</option>
					            	</select>
					            </div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Sub Category <span class="req">*</span></label>
					            <div class="col-sm-10">

					            	<select name="subcategory" id="subcategory" class="form-control input-sm">
					            		<option>Select</option>
					            	</select>
					            </div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Gender <span class="req">*</span></label>
					            <div class="col-sm-10">
					            	<select name="gender" id="gender" class="form-control input-sm">
					            		<option></option>
										<option value="Mens">Mens</option>
										<option value="Womens">Womens</option>
										<option value="Boys">Boys</option>
										<option value="Girls">Girls</option>
										<option value="Toddler">Toddler</option>
										<option value="Infant">Infant</option>


					            	</select>
					            </div>

							</div>


							<div class="form-group">
								<label class="col-sm-2 control-label">Requirement <span class="req">*</span></label>
					            <div class="col-sm-10">
					            	<select name="requirement" id="requirement" class="form-control input-sm">
					            		<option>Select</option>
										<optgroup label="Replenishment">
										    <option value="Replenishment-More"> More</option>
										<option value="Replenishment-Less"> Less</option>
										</optgroup> 
										<optgroup label="Assortment">
										    <option value="Assortment-StyleRequest"> Specific Style</option>
											<option value="Assortment-Collection/New Assortment"> Collection/New Assortment
										</optgroup>
										
										
					            	</select>
					            </div>

							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Brand</label>
					            <div class="col-sm-10"><input type="text" id="brand" name="brand" class="form-control" value=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Description</label>
					            <div class="col-sm-10"><input type="text" id="description" name="description" class="form-control" value=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Style Number</label>
					            <div class="col-sm-10"><input type="text" pattern="\d*" maxlength="9" id="styleNumber" name="styleNumber" class="form-control" value=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Size</label>
					            <div class="col-sm-10"><input type="text" id="size" name="size" class="form-control" value=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Quantity</label>
					            <div class="col-sm-10"><input type="text" pattern="\d*" maxlength="3" id="quantity" name="quantity" class="form-control" value="0"></div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Comments</label>
					            <div class="col-sm-10"><input type="text" id="comments" name="comments" class="form-control" value=""></div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Your Name
								<span class="req">*</span></label>
					            <div class="col-sm-10"><input type="text" id="submitted_by" name="submitted_by" class="form-control" value=""></div>
							</div>		


							<div class="form-group">
								<label class="col-sm-2 control-label">Your Position<span class="req">*</span></label>
					            <div class="col-sm-10"><input type="text" id="submitted_by_position" name="submitted_by_position" class="form-control" value=""></div>
							</div>														

							<div class="form-group">
								<label class="col-sm-2 control-label"></label>
					            <div class="col-sm-10"><input type="checkbox" id="dm_approval" name="dm_approval" class="" />  I have approval from my DM for this request.</div>
							</div>							


						{{Form::close()}}

                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<a class="btn btn-white" href="/{{$storeNumber}}/form/productrequest"><i class="fa fa-close"></i> Cancel</a>
						<button class="btn btn-primary" id="form_send"><i class="fa fa-check"></i> Save and Send</button>
		            </div>
		        </div>


            </div>
        </div>


    </div><!-- wrapper closes -->


		@include('site.includes.footer')

	    @include('site.includes.scripts')

		@include('site.includes.bugreport')

		<script type="text/javascript" src="/js/vendor/moment.js"></script>
		<script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
		<script src="/js/custom/forms/ProductRequestForm.js"></script>
		<script src="/js/custom/forms/ProductRequestFormOptions.js"></script>
		<script src="/js/custom/forms/respondToQuestion.js"></script>



		<script type="text/javascript">

			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});

		</script>
		@include('site.includes.modal')
	</body>
	</html>
