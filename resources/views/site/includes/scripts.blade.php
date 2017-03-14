    <!-- Mainly scripts -->
    <script src="/js/env.js"></script>
    <script src="/js/console.frog.js"></script>
    <script src="/js/jquery-2.1.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    
    <!-- Custom and plugin javascript -->
    <script src="/js/inspinia.js"></script>
    <script src="/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/js/jquery-ui.custom.min.js"></script>

    <!-- Alerts -->
    <script src="/js/plugins/sweetalert/sweetalert.min.js"></script>

    <script src="/js/custom/site/storeselector/storeSelector.js"></script>
    <script src="/js/custom/site/launchModal.js"></script>
    <script src="/js/custom/trackEvent.js"></script>
    <script src="/js/custom/sendBugReport.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    
    <script type="text/javascript">
    // Config box

    if (localStorageSupport) {
        var collapse = localStorage.getItem("collapse_menu");
        var fixedsidebar = localStorage.getItem("fixedsidebar");
        var fixednavbar = localStorage.getItem("fixednavbar");
        var boxedlayout = localStorage.getItem("boxedlayout");
        var fixedfooter = localStorage.getItem("fixedfooter");

        if (collapse == 'on') {
            $('#collapsemenu').prop('checked','checked')
        }
        if (fixedsidebar == 'on') {
            $('#fixedsidebar').prop('checked','checked')
        }
        if (fixednavbar == 'on') {
            $('#fixednavbar').prop('checked','checked')
        }
        if (boxedlayout == 'on') {
            $('#boxedlayout').prop('checked','checked')
        }
        if (fixedfooter == 'on') {
            $('#fixedfooter').prop('checked','checked')
        }
    }

    $(".combostore-onoffswitch").on('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function(e){
        
        var userStoreNumber =  localStorage.getItem('userStoreNumber');
        var userStoreName =  localStorage.getItem('userStoreName');
        var initialStoreNumber = userStoreNumber;
        
        if($("input[name='comboStore']:checked").val()) {
            
            localStorage.setItem("userBanner", 1 );
            if(userStoreNumber.match(/^A/) ){
                userStoreNumber = userStoreNumber.replace("A","");
                userStoreName = userStoreName.replace("A", "");
            }
            
        }
        else{
            
            localStorage.setItem("userBanner", 2 );    
            if(! userStoreNumber.match(/^A/) ){
                userStoreNumber = "A"+userStoreNumber;
                userStoreName = "A"+userStoreName;
            }
        
        }
        localStorage.setItem("userStoreNumber", userStoreNumber );
        localStorage.setItem("userStoreName", userStoreName);
        if(initialStoreNumber != userStoreNumber) {
            window.location = "/"+userStoreNumber;
        }
        
    });

    </script>

