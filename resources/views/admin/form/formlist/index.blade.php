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
                            <h5>Forms</h5>
                            <div class="ibox-tools">


                            </div>
                        </div>

                        <div class="ibox-content">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Form Name</th>
                                        <th>Description</th>
                                        <th>New</th>
                                        <th>In Progress</th>
                                    </tr>
                                <thead>

                                <tbody>
                                    @foreach($forms as $form)
                                    <tr>
                                        <td><a href="/admin/form/{{ $form->form_path }}">{{ $form->form_label }}</a></td>
                                        <td>{{ $form->description }}</td>
                                        <td>{{ $form->count_new }}</td>
                                        <td>{{ $form->count_in_progress }}</td>
                                    </tr>
                                    @endforeach



                                </tbody>


                            </table>

                        </div>

                    </div>
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
