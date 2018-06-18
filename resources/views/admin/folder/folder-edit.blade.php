

    <style type="text/css">
/*        form {
            border: thin solid #e9e9e9;
            margin-top: 25px;
            padding: 20px;
        }
        .form-title{
            padding-top:20px;
            font-size:22px;
            font-weight: bold;
        }
        .deleteFolder{

        }*/
        #addWeekContainer, #addFolderContainer, #addChildFolderContainer{
            display: block;
            display: none;
        }
    </style>

    {!! Form::model($folder, ['action' => ['Document\FolderAdminController@update', 'id'=>$folder->id], 'method' => 'PUT']) !!}

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Folder <i>{{$folder->name}}</i></h4>
    </div>

    <div class="modal-body">
        
        <input type="hidden" name="banner_id" value={{$banner->id}}>

        <div class="form-group">
            <h5 class="clearfix">Folder Name</h5>
            {!! Form::text('name', $folder->name, ['class'=>'form-control']) !!}
        </div>

        @if(!empty($params))
            @if ($params["param_name"] == "has_children")
            
                <h5>Child Folders</h5>
                @foreach($params["param_value"] as $child)
                    
                    <div class="form-group" style="padding-left: 20px; font-size: 16px;">
                        <i class="fa fa-folder-o"></i> {{ $child["name"] }}
                        {{-- <a class="btn btn-default editFolder" href="/admin/folder/{{$child['global_folder_id']}}/edit"><i class="fa fa-pencil"></i> Edit </a> --}}
                    </div>

                @endforeach
                <div class="form-group">
                   <button class="btn btn-white pull-left addChild"><i class="fa fa-folder"></i> Add Folder </button>
                   <br /><br />
                   <div id="addChildFolderContainer"></div>
                </div>
            
            @elseif($params["param_name"] == "has_weeks")
                
                <label>
                    <input type="checkbox" name="removeWeeks" value=1 id="removeWeeks">
                    Remove week folders?
                </label>
            
            @endif

        @else 
                <div class="form-group clearfix">
                    <button class="btn btn-white pull-left" value="addFolder" id="addFolder"><i class="fa fa-folder"></i> Add Folder </button>
                    <button class="btn btn-white pull-left" value="addWeek" id="addWeek"><i class="fa fa-calendar"></i> Add Weeks </button>
                    <br /><br />
                    <div id="addWeekContainer"></div>
                    <div id="addFolderContainer"></div>
                </div>
                
        @endif
            
            <h5 class="clearfix">Tags</h5>
            {!! Form::select('tags[]', $tags, $selected_tags, ['class'=>'chosen', 'multiple'=>'true']) !!}

    </div>

    <div class="modal-footer">

        @if(empty($params))
            <button class="deleteFolder btn btn-danger pull-left" id="deleteFolder{{$folder->id}}" data-id=
            "{{$folder->id}}"><i class="fa fa-trash"></i> Delete Folder </button>
        @else
            <div class="disabled-button-container pull-left" data-toggle="tooltip" data-placement="right"  title="Only empty folders can be deleted">
                <a class="btn btn-danger" disabled="disabled"><i class="fa fa-trash"></i> Delete Folder </a>
            </div>
        @endif

        <button type="button" class="btn btn-white cancel-modal" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
        <button class="btn btn-primary"><i class='fa fa-check'></i> Save changes</button>
    </div>

    {!! Form::close() !!}

	
    <script type="text/javascript" src="/js/custom/admin/folders/editFolder.js"></script>
    <script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
    <script type="text/javascript">
        $(function () {
            $('.disabled-button-container').tooltip()
            $('.chosen').chosen({
                width:'100%'
            })
        })
    </script>


