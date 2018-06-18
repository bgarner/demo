    <!-- Mainly scripts -->
    <script src="/js/env.js?<?=time()?>"></script>
    <script src="/js/jquery-2.1.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/js/plugins/dataTables/datatables.min.js?<?=time();?>"></script>
    <script src="/js/plugins/videojs/video.js?<?=time();?>"></script>
    
    <!-- Custom and plugin javascript -->
    <script src="/js/inspinia.js"></script>
    <script src="/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
{{--     <script src="/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/js/jquery-ui.custom.min.js"></script> --}}

    <!-- Alerts -->
    <script src="/js/plugins/sweetalert/sweetalert.min.js"></script>
    
    <script src="/js/custom/site/launchModal.js?<?=time();?>"></script>
    <script src="/js/custom/trackEvent.js?<?=time();?>"></script>
    <script src="/js/custom/sendBugReport.js?<?=time();?>"></script>
    <script src="/js/vendor/moment.js"></script>
    <script src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
    

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


    </script>

    
