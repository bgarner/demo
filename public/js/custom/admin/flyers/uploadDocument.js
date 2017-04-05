// HTML heavily inspired by http://blueimp.github.io/jQuery-File-Upload/ -->
// Get the template HTML and remove it from the doument
var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);


var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/admin/flyer", // Set the url
    paramName: "document",
    maxFiles: 1,
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    addRemoveLinks: false,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
    accept: function(file, done) {
      // TODO: Image upload validation
      done();
    },
    sending: function(file, xhr, formData) {
       console.log($('#folder-title').attr('data-folderid'));
      // Pass token. You can use the same method to pass any other values as well such as a id to associate the image with for example.
        formData.append("_token", $('[name=_token').val()); // Laravel expect the token post value to be named _token by default
        formData.append("banner_id", $('[name=banner_id]').val());
        formData.append("flyer_name", $('[name=flyer_name]').val());
        formData.append("start_date", $('[name=start_date]').val());
        formData.append("end_date", $('[name=end_date]').val());
        // formData.append("uploadOption", $('#uploadOptionProductLaunch option:selected').val());

    },
    init: function () {
      this.on("success", function (file, response) {
        console.log(response)
        });
    } 

});
myDropzone.on("drop", function (e) {
  $("#watermark").hide();
  $('#actions .start').removeClass('disabled');
  $('#actions .cancel').removeClass('disabled');
})


myDropzone.on("addedfile", function (file) {
    // Hookup the start button
      $("#watermark").hide();
      $('#actions .start').removeClass('disabled');
      $('#actions .cancel').removeClass('disabled');
      file.previewElement.querySelector(".start").onclick = function () {
        myDropzone.enqueueFile(file);
      };
});

// Update the total progress bar
myDropzone.on("totaluploadprogress", function (progress) {
  document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
});

myDropzone.on("sending", function (file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1";
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
});

// Hide the total progress bar when nothing's uploading anymore
myDropzone.on("queuecomplete", function (progress) {
    document.querySelector("#total-progress").style.opacity = "0";
    $(".file-row .delete").hide();
    //window.location = '/admin/document/add-meta-data?package=' + upload_package_id + "&banner_id=" + banner_id + "&parent=" + folder_id;
    var metadatalink = $("<a class='btn btn-primary next-action' href='/admin/flyer'><i class='fa fa-check'></i> Done </a>");
    
    $( ".file-actions .btn" ).fadeOut( "slow", function() {
      $( ".file-actions" ).empty();
      $(metadatalink).appendTo(".file-actions");
    });
    
    
    
});

// Setup the buttons for all transfers
// The "add files" button doesn't need to be setup because the config
// `clickable` has already been specified.
document.querySelector("#actions .start").onclick = function () {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
};
document.querySelector("#actions .cancel").onclick = function () {
    myDropzone.removeAllFiles(true);
    $("#watermark").show();
    $('#actions .start').addClass('disabled');
    $('#actions .cancel').addClass('disabled');
};

myDropzone.on('removedfile', function(file) {
  if( $("#previews").has(".file-row").length < 1 ) {
    $("#watermark").show();
    $('#actions .start').addClass('disabled');
    $('#actions .cancel').addClass('disabled');
  }
});
        
