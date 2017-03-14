CKEDITOR.plugins.add( 'folderlink', {
    icons: 'folderlink',
    init: function( editor ) {
        editor.addCommand( 'folderlink', new CKEDITOR.dialogCommand( 'folderlinkDialog' ) );
        editor.ui.addButton( 'FolderLink', {
            label: 'Add Folder Link',
            command: 'folderlink',
            toolbar: 'links'
        });

        CKEDITOR.dialog.add( 'folderlinkDialog', this.path + 'dialogs/folderlink.js' );
    }
});