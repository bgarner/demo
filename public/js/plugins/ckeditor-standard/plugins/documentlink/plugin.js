CKEDITOR.plugins.add( 'documentlink', {
    icons: 'documentlink',
    init: function( editor ) {
        editor.addCommand( 'documentlink', new CKEDITOR.dialogCommand( 'documentlinkDialog' ) );
        editor.ui.addButton( 'DocumentLink', {
            label: 'Add Document Link',
            command: 'documentlink',
            toolbar: 'links'
        });

        CKEDITOR.dialog.add( 'documentlinkDialog', this.path + 'dialogs/documentlink.js' );
    }
});