CKEDITOR.plugins.add( 'communicationlink', {
    icons: 'communicationlink',
    init: function( editor ) {
        editor.addCommand( 'communicationlink', new CKEDITOR.dialogCommand( 'communicationlinkDialog' ) );
        editor.ui.addButton( 'CommunicationLink', {
            label: 'Add Communication Link',
            command: 'communicationlink',
            toolbar: 'links'
        });

        CKEDITOR.dialog.add( 'communicationlinkDialog', this.path + 'dialogs/communicationlink.js' );
    }
});