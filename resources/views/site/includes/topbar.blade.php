<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0" >
{{-- <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a> --}}
{{-- <div class="navbar-header" style="">

</div> --}}
    
    <div class="row">

        <div class="col-md-4 col-sm-4">
            <div class="pull-left" style="padding: 8px 10px 0px 20px;">
                <script>document.write( localStorage.getItem('userStoreName') );</script>
                <br /><a id="storeswitch" style="display: inline;"><i class="fa fa-sitemap "></i> Change Store</a>
            </div>
        </div>

        <div class="col-md-8 col-sm-8">
            <div class="pull-right" style="padding-right: 20px;">
                <form role="form" class="form-inline" style="width: 100%; padding-left: 10px; padding-top: 5px;" method="get" action="/{{ Request::segment(1) }}/search">
                    <i class="fa fa-search" style="display: inline !important; font-size: 24px; color: #ccc; line-height: 10px; position:relative; top: 12px; width: 10%;"></i>

                    <input type="text" class="form-control" name="q" id="top-search" placeholder="" id="search" style="border: none; border-bottom: 1px solid #ccc; font-size: 20px; margin:0px 10px;">

                    <button type="submit" class="btn btn-primary btn-sm" style="display: inline">Search</button>
                </form>

            </div>

        </div>


    </div>
</nav>