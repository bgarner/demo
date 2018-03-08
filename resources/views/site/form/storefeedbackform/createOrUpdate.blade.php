<!DOCTYPE html>
<html>

<head>
    @section('title', 'Store Feedback Form')
    @include('site.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/custom/site/event.css">
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
</head>

<body class="fixed-navigation">
    <div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          @include('site.includes.sidenav')
	        </div>
	    </nav>

	<div id="page-wrapper" class="gray-bg" >

	<div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                    	@if(isset($formInstance))
							<h5>Edit Store Feedback Form</h5>
                    	@else
                        	<h5>New Store Feedback Form</h5>
                        @endif
                    </div>
                    <div class="ibox-content">

						@if(isset($formInstance))
							<form class="form-horizontal" id="editStoreFeedbackForm">
							<input type="text" hidden value="{{$formInstance->form_data}}" id="formdata">

						@else
						    <form class="form-horizontal" id="createNewStoreFeedbackForm">
						@endif

							<div class="form-group">
								<label class="col-sm-2 control-label">Department</label>
					            <div class="col-sm-10">
					            	<select name="department" id="department">
					            		<option data-dept="hg" value="dept-hg">Hardgoods</option>
					            		<option data-dept="sg" value="dept-sg">Softgoods</option>
					            		<option data-dept="fw" value="dept-fw">Footwear</option>
					            	</select>
					            </div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Category</label>
					            <div class="col-sm-10">
					            	<select name="category" id="category">

										<option data-dept="hg" data-category="Ski/Snowboard" value="dept-hg-category-Ski/Snowboard"> Ski/Snowboard </option>
										<option data-dept="hg" data-category="Hockey" value="dept-hg-category-Hockey"> Hockey </option>
										<option data-dept="hg" data-category="Golf" value="dept-hg-category-Golf"> Golf </option>
										<option data-dept="hg" data-category="Fitness/Yoga" value="dept-hg-category-Fitness/Yoga"> Fitness/Yoga </option>
										<option data-dept="hg" data-category="Boxing" value="dept-hg-category-Boxing"> Boxing </option>
										<option data-dept="hg" data-category="Soccer" value="dept-hg-category-Soccer"> Soccer </option>
										<option data-dept="hg" data-category="Basektball" value="dept-hg-category-Basketball"> Basektball </option>
										<option data-dept="hg" data-category="Baseball/Softball" value="dept-hg-category-Baseball/Softball"> Baseball/Softball </option>
										<option data-dept="hg" data-category="Volleybaall" value="dept-hg-category-Volleybaall"> Volleybaall </option>
										<option data-dept="hg" data-category="Football" value="dept-hg-category-Football"> Football </option>
										<option data-dept="hg" data-category="Yoga" value="dept-hg-category-Yoga"> Yoga </option>
										<option data-dept="hg" data-category="Bike" value="dept-hg-category-Bike"> Bike </option>
										<option data-dept="hg" data-category="Racquets" value="dept-hg-category-Racquets"> Racquets </option>
										<option data-dept="hg" data-category="Other" value="dept-hg-category-Other"> Other </option>

										<option data-dept="sg" data-category="Outerwear" value="dept-sg-category-Outerwear"> Outerwear </option>
										<option data-dept="sg" data-category="Lifestyle" value="dept-sg-category-Lifestyle"> Lifestyle </option>
										<option data-dept="sg" data-category="Athletic" value="dept-sg-category-Athletic"> Athletic </option>
										<option data-dept="sg" data-category="Casual" value="dept-sg-category-Casual"> Casual </option>
										<option data-dept="sg" data-category="Kids" value="dept-sg-category-Kids"> Kids </option>
										<option data-dept="sg" data-category="Toddler" value="dept-sg-category-Toddler"> Toddler </option>
										<option data-dept="sg" data-category="Other" value="dept-sg-category-Other"> Other </option>

										<option data-dept="fw" data-category="Running" value="dept-fw-category-Running"> Running </option>
										<option data-dept="fw" data-category="Training" value="dept-fw-category-Training"> Training </option>
										<option data-dept="fw" data-category="Court" value="dept-fw-category-Court"> Court </option>
										<option data-dept="fw" data-category="Outdoor" value="dept-fw-category-Outdoor"> Outdoor </option>
										<option data-dept="fw" data-category="Lifesyle" value="dept-fw-category-Lifesyle"> Lifesyle </option>
										<option data-dept="fw" data-category="Trend" value="dept-fw-category-Trend"> Trend </option>
										<option data-dept="fw" data-category="Kids" value="dept-fw-category-Kids"> Kids </option>
										<option data-dept="fw" data-category="Toddler" value="dept-fw-category-Toddler"> Toddler </option>
										<option data-dept="fw" data-category="Winter/Rain" value="dept-fw-category-Winter/Rain"> Winter/Rain </option>
										<option data-dept="fw" data-category="Other" value="dept-fw-category-Other"> Other </option>
					            	</select>
					            </div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Sub Category</label>
					            <div class="col-sm-10">
					            	<select name="subcategory" id="subcategory">
										<option data-dept="hg" value="dept-hg-subcategory-Men\'s">Men's</option>
										<option data-dept="hg" value="dept-hg-subcategory-Women\'s">Women's</option>
										<option data-dept="hg" value="dept-hg-subcategory-Jr/Kid\'s">Jr/Kid's</option>

										<option data-dept="sg" value="dept-sg-subcategory-Men\'s">Men's</option>
										<option data-dept="sg" value="dept-sg-subcategory-Women\'s"> Women's</option>
										<option data-dept="sg" value="dept-sg-subcategory-Kid\'s"> Kid's</option>
										<option data-dept="sg" value="dept-sg-subcategory-Toddler"> Toddler</option>

										<option data-dept="fw" value="dept-fw-subcategory-Men\'s"> Men's</option>
										<option data-dept="fw" value="dept-fw-subcategory-Women\'s"> Women's</option>
										<option data-dept="fw" value="dept-fw-subcategory-Kid\'s"> Kid's</option>
										<option data-dept="fw" value="dept-fw-subcategory-Toddler"> Toddler</option>

					            	</select>
					            </div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Requirement</label>
					            <div class="col-sm-10">
					            	<select name="requirement" id="requirement">
										<option value="requirement-more">More</option>
										<option value="requirement-less">Less</option>
										<option value="requirement-opportunity">Opportunity</option>

					            	</select>
					            </div>

							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Brand</label>
					            <div class="col-sm-10"><input type="text" id="brand" name="brand" class="form-control" value=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Style Number</label>
					            <div class="col-sm-10"><input type="text" id="styleNumber" name="styleNumber" class="form-control" value=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Size</label>
					            <div class="col-sm-10"><input type="text" id="size" name="size" class="form-control" value=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Quantity</label>
					            <div class="col-sm-10"><input type="number" min=0 max=100 id="quantity" name="quantity" class="form-control" value=""></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Description</label>
					            <div class="col-sm-10"><input type="text" id="description" name="description" class="form-control" value=""></div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Comments</label>
					            <div class="col-sm-10"><input type="text" id="comments" name="comments" class="form-control" value=""></div>
							</div>

                            <div class="form-group">
								<label class="col-sm-2 control-label">Your Name</label>
					            <div class="col-sm-10"><input type="text" id="submitted_by" name="submitted_by" class="form-control" value=""></div>
							</div>

                            <div class="form-group">
								<label class="col-sm-2 control-label">Your Position</label>
					            <div class="col-sm-10"><input type="text" id="submitted_by_position" name="submitted_by_position" class="form-control" value=""></div>
							</div>


                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-sm-10"><input type="checkbox" id="dm_approval" name="dm_approval"> I have approval from my DM to make this request. A copy of this form will be eamiled to them.</div>
                            </div>


						{{Form::close()}}

                    </div> <!-- ibox-content closes -->

                </div><!-- ibox closes -->

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<a class="btn btn-white" href="/{{$storeNumber}}/form/storefeedbackform"><i class="fa fa-close"></i> Cancel</a>
						<button class="btn btn-primary" id="form_send"><i class="fa fa-check"></i> Save and Send</button>
		            </div>
		        </div>


            </div>
        </div>


    </div><!-- wrapper closes -->


		@include('admin.includes.footer')

	    @include('admin.includes.scripts')

		@include('site.includes.bugreport')

		<script type="text/javascript" src="/js/vendor/moment.js"></script>
		<script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="/js/plugins/ckeditor-standard/ckeditor.js"></script>
		<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
		<script src="/js/custom/site/form/storefeedbackform.js"></script>



		<script type="text/javascript">

			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});

		</script>

	</body>
	</html>
