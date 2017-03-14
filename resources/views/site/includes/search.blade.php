<div class="row" style="border:thin solid #ccc; position:relative; top:2px;">
	<form role="form" class="form-inline" style="width: 100%; padding-left: 10px; " method="get" action="/{{ Request::segment(1) }}/search">
		{{--{{ csrf_field() }}--}}
		
	    {{--<div class="visible-xs visible-sm">--}}
		<div>
            <i class="fa fa-search" style="display: inline !important; font-size: 12px; color: #ccc; line-height: 12px; position:relative; top:9px; float:left ; width:5%"></i>
	    	<span style="width:75%; float:left" class="search-container"> <input type="text" name="q" id="top-search" placeholder="Search . . . " id="search" style="border: none;font-size: 12px; position:relative; width:75%; top:6px;"></span>
		
	    	<span style="width:20%" class="submit-container"><button type="submit" class="btn btn-primary btn-sm search-submit" style="display: inline ; border-radius:0px; font-size:12px;float:right; width:20%">Search</button></span>
	    </div>
	    {{--<div class="hidden-xs hidden-sm">--}}
	    	{{--<i class="fa fa-search" style="display: inline !important; font-size: 20px; color: #ccc; line-height: 10px; position:relative; top:3px;  "></i>--}}

	    	{{--<input type="text" class="form-control" name="q" id="top-search" placeholder="Search . . . " id="search" style="border: none;font-size: 16px; position:relative; ">--}}

	    	{{--<button type="submit" class="btn btn-primary btn-sm" style="display: inline ; border-radius:0px; font-size:15px;float:right;">Search</button>--}}
	    {{--</div>--}}
	
	</form>
</div>