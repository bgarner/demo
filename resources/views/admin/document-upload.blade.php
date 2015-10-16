
<div class="container" id="container">
   <div id="actions" class="row">
    {!! csrf_field() !!}
    <input type="hidden" name="upload_package_id"  id="upload_package_id" value="{{ $packageHash }}" />
    <input type="hidden" name="folder_id" value="3" />

      <div class="col-lg-7">
        <!-- The fileinput-button span is used to style the file input field as button -->
        <span class="btn btn-success fileinput-button dz-clickable">
            <i class="glyphicon glyphicon-plus"></i>
            <span>Add files...</span>
        </span>
        <button type="submit" class="btn btn-primary start">
            <i class="glyphicon glyphicon-upload"></i>
            <span>Start upload</span>
        </button>
        <button type="reset" class="btn btn-warning cancel">
            <i class="glyphicon glyphicon-ban-circle"></i>
            <span>Cancel upload</span>
        </button>
      </div>

      <div class="col-lg-5">
        <!-- The global file processing state -->
        <span class="fileupload-process">
          <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="opacity: 0;">
            <div class="progress-bar progress-bar-success" style="width: 100%;" data-dz-uploadprogress=""></div>
          </div>
        </span>
      </div>

    </div>

    <div class="table table-striped" id="previews">

        <div id="template" class="file-row">
        <!-- This is used as the file preview template -->
            <div>
                <span class="preview"><img data-dz-thumbnail /></span>
            </div>

            <div>
                <p class="name" data-dz-name></p>
{{--                 <input type="text" name="title[]" />
                <input type="text" name="description[]" /> --}}
                <strong class="error text-danger" data-dz-errormessage></strong>
            </div>

            <div>
                <p class="size" data-dz-size></p>
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                  <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                </div>
            </div>

            <div>
              <button class="btn btn-primary start">
                  <i class="glyphicon glyphicon-upload"></i>
                  <span>Start</span>
              </button>
              <button data-dz-remove class="btn btn-warning cancel">
                  <i class="glyphicon glyphicon-ban-circle"></i>
                  <span>Cancel</span>
              </button>
              <button data-dz-remove class="btn btn-danger delete">
                <i class="glyphicon glyphicon-trash"></i>
                <span>Remove</span>
              </button>
            </div>
      </div>

    </div>
</div>

