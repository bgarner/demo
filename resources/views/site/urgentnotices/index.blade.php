<!DOCTYPE html>
<html>

<head>
    @section('title', 'Urgent Notices')
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    @include('site.includes.head')
    <style>
    .modal-lg{ height: 95%; width: 80% !important; padding: 0; }
    .modal-content{ height: 100% !important;}
    .modal-body{ padding: 0; margin: 0; height: 100% !important; }
    </style>
</head>

<body class="fixed-navigation">
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
           @include('site.includes.sidenav')
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
              @include('site.includes.topbar')
        </div>


<div class="wrapper wrapper-content">
        <div class="row">
<!--             <div class="col-lg-2"> -->

           {{--  @include('site.alerts.alertssidebar') --}}

            <!-- </div> -->
            <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">

                <h2>
                	{{__("Urgent Notices")}}
                    @include('site.includes.help-icon', ['parentView' => 'site.urgentnotices.index', 'section' => 'help_urgentnotice_overall'])
                </h2>



            </div>
                <div class="mail-box">


                <table class="table table-hover table-mail">
                <tbody>
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th> {{__("Title")}}</th>
                            <th> {{__("Description")}} </th>
                            <th> {{__("Date")}} </th>
                        </tr>
                    </thead>


                    @foreach($notices as $notice)
                    	<tr>
                    		<td class="check-mail"><i class="fa fa-bolt"></i></td>
                    		<td><a class="trackclick" data-urgentnotice-id="{{ $notice->id }}" href="/{{ Request::segment(1) }}/urgentnotice/show/{{ $notice->id }}">{{ $notice->title }}</td>
                    		<td>{{ $notice->trunc }}</td>
                    		<td class="mail-date">{{ $notice->prettyDate }} <small style="font-weight: normal;padding-left: 10px;">({{ $notice->since }} {{__("ago")}})</small></td>
                    	</tr>
                 	@endforeach
                </tbody>
                </table>


                </div>
            </div>
        </div>
        </div>



    @include('site.includes.footer')

    @include('site.includes.scripts')

    <script type="text/javascript">
        $("body").on("click", ".launchPDFViewer", function(e){
            var filepath = $(this).attr("data-file");
            $("#fileviewmodal").find('iframe').attr("src", filepath);
        });
    </script>


    @include('site.includes.bugreport')
    @include('site.includes.modal')

</body>
</html>
