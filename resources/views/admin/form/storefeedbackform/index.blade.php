<!DOCTYPE html>
<html>

<head>
    @section('title', 'Forms')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<link rel="stylesheet" href="/css/plugins/dataTables/datatables.min.css">
	{{-- <link rel="stylesheet" href="/css/plugins/dataTables/dataTables.tableTools.min.css"> --}}
	<style>
        .modal-dialog{
            height: 380px;
        }

    </style>
</head>

<body class="fixed-navigation adminview">
    <div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          @include('admin.includes.sidenav')
	        </div>
	    </nav>

	<div id="page-wrapper" class="gray-bg" >


		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Store Feedback</h5>
                            <div class="ibox-tools">

                            </div>
                        </div>
                        <div class="ibox-content">

                            <table class="table">
                                <thead>
                                    <th>Store</th>
                                    <th>Date Submitted</th>
                                    <th>Submitted By</th>
                                    <th>Request</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    @foreach($forms as $form)

                                        <tr>
                                            <td>{{ $form->store_number }}</td>
                                            <td><a href="{{\Request::url()}}/{{$form->id}}">{{$form->created_at}}</a></td>
                                            <td>{{$form->submitted_by}}</td>
                                            <td>we will fill this in a min</td>
                                            <td>stattus goes here</td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>


                        </div> <!-- ibox-content closes -->

                    </div><!-- ibox closes -->
                </div>
		    </div>
		</div>

		@include('admin.includes.footer')

	    @include('admin.includes.scripts')




		<script>
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});



		</script>


		@include('site.includes.modal')
        @include('admin.folder.foldermodal')

	</body>
	</html>
