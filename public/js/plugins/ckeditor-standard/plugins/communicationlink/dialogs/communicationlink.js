CKEDITOR.dialog.add( 'communicationlinkDialog', function( editor ) {
    return {
        title: 'Add Communication Links',
        minWidth: 400,
        minHeight: 200,
        contents: [
            {
                id: 'tab-basic',
                label: 'Add Communication Link',
                elements: [
                    {
                        type: 'text',
                        id: 'communicationlink_communicationname',
                        label: 'Communication Name',
                        validate: CKEDITOR.dialog.validate.notEmpty( "Communication name cannot be empty." )
                    },
                    {
                        type: 'text',
                        id: 'communicationlink_communicationid',
                        label: 'Communication Id',
                        validate: CKEDITOR.dialog.validate.notEmpty( "Communication Id cannot be empty." ),
                        class: 'hidden'
                        
                    },
                    
                ]
            },
            
        ],
        onOk: function() {
            var dialog = this;

            var link = editor.document.createElement( 'span' );
            
            link.setAttribute( 'data-communicationid',  dialog.getValueOf( 'tab-basic', 'communicationlink_communicationid' ) );
            link.setAttribute('class', 'inline-communication-link');
            link.setText( dialog.getValueOf( 'tab-basic', 'communicationlink_communicationname' ) );
            editor.insertElement( link );
        },
        onShow: function() {
            var dialog = this;
            
            var id = localStorage.getItem('communicationId');
            var name = localStorage.getItem('communicationName');
            var communicationId = dialog.getContentElement('tab-basic', 'communicationlink_communicationid');
            var communicationName = dialog.getContentElement('tab-basic', 'communicationlink_communicationname');
            communicationId.setValue(id);
            communicationName.setValue(name);    
            
        }
        
        
    };
});