<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0" >
{{-- <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a> --}}
{{-- <div class="navbar-header" style="">

</div> --}}

    <style type="text/css">
    
        
        @media (max-width: 1055px)  {
          .truncate {
                display:inline-block;
                width: 100px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        }
        @media  (max-width: 900px) and (min-width: 681px) {
            .truncate{
                width:40px;
            }
            .search-submit{

            }

        }
        @media  (max-width: 680px)  {
            .truncate{
                width: 40px;
            }
        }
        @media  (max-width: 597px)  {
            .truncate{
                display: none;
            }
        }
        @media  (max-width: 620px)  {
            .search-submit, .submit-container {
                width: 40% !important;
            }
            .search, .search-container{
                width:60% !important;
            }

            .fa-search {
                width:0% !important;
            }
        }

        @media  (max-width: 950px) and (min-width: 768px)  {
            .search-submit, .submit-container {
                width: 40% !important;
            }
            .search, .search-container{
                width:60% !important;
            }

            .fa-search {
                width:0% !important;
            }
        }


        @media  (max-width: 511px)  {
            #storeswitch-text {
                display: none;
            }
        }
        .store-details{
            font-size: 22px;
            position: relative;
            top:10px;
            right:-20px;
            float: right;
            
        }

        .form-inline {

            @media (min-width: 768px ) {
            
                .form-group {
                  display: inline-block;
                  margin-bottom: 0;
                  vertical-align: middle;
                }


                .form-control {
                  display: inline-block;
                  width: auto; 
                  vertical-align: middle;
                }

                .input-group > .form-control {
                  width: 100%;
                }
            }
        }

        input:focus::-webkit-input-placeholder { color:transparent; }

    </style>

    <div class="row">
        <div class="navbar-minimalize minimalize-styl-2 btn btn-primary ">
                <i class="fa fa-bars"></i>
        </div>
    
        <div class="col-lg-6 col-md-6 col-sm-5 col-xs-6">
            <div class="" style="padding-right: 20px;margin:10px 0px;">
                @include('site.includes.search')
            </div>
        </div>
        

        <!-- <div class="hidden-xs hidden-sm"> -->
        <div>
            
            <div class="" style="padding: 15px 30px 0px 0px; float:right">
                <span class="truncate" id="store-name">
                </span>
                @if($isComboStore == 1) 
                &nbsp;&nbsp;
                <span class="comboStoreSwitch">
                    <div class="switch">
                        <div class="combostore-onoffswitch onoffswitch">
                            
                            @if($banner->id == 1)
                            <input type="checkbox" checked class="onoffswitch-checkbox" id="comboStore" name="comboStore">
                            @else
                            <input type="checkbox" class="onoffswitch-checkbox" id="comboStore" name="comboStore">
                            @endif
                            
                            <label class="onoffswitch-label" for="comboStore">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </span>
                @endif

                &nbsp;&nbsp;<a id="storeswitch" style="display: inline;"><i class="fa fa-sitemap "></i><span id="storeswitch-text"> Change Store</span></a>
            </div>
        </div>

    </div>

     <script type="text/javascript">
        
        var storeName = localStorage.getItem('userStoreName');
        storeName = storeName.replace(/^A/, "");
        
        storeNameElement = document.getElementById('store-name');
        storeNameElement.innerHTML = storeName;
        storeNameElement.title = storeName;
        
                
    </script>
</nav>