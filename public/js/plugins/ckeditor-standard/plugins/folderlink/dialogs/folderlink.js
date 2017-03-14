CKEDITOR.dialog.add( 'folderlinkDialog', function( editor ) {
    return {
        title: 'Add Folder Links',
        minWidth: 400,
        minHeight: 200,
        contents: [
            {
                id: 'tab-basic',
                label: 'Add Folder Link',
                elements: [
                    // {
                    //     type : 'button',
                    //     id : 'folderlink_browse',
                    //     label : 'Browse Folders',                        
                    // },
                    {
                        type: 'text',
                        id: 'folderlink_foldername',
                        label: 'Folder Name',
                        validate: CKEDITOR.dialog.validate.notEmpty( "Folder name cannot be empty." )
                    },
                    {
                        type: 'text',
                        id: 'folderlink_folderid',
                        label: 'Folder Id',
                        validate: CKEDITOR.dialog.validate.notEmpty( "Folder Id cannot be empty." ),
                        class: 'hidden'
                        
                    },
                    {
                        type: 'text',
                        id: 'folderlink_folderpath',
                        label: 'Folder Path',
                        validate: CKEDITOR.dialog.validate.notEmpty( "Folder Path cannot be empty." ),
                        
                    },
                    
                ]
            },
            
        ],
        onOk: function() {
            var dialog = this;

            var link = editor.document.createElement( 'div' );
            
            link.setAttribute( 'data-folderid',  dialog.getValueOf( 'tab-basic', 'folderlink_folderid' ) );
            link.setAttribute('class', 'inline-folder-link');
            link.setText( dialog.getValueOf( 'tab-basic', 'folderlink_foldername' ) );
            editor.insertElement( link );
        },
        onShow: function() {
            var dialog = this;
            
            var id = localStorage.getItem('folderId');
            var name = localStorage.getItem('folderName');
            var path = localStorage.getItem('folderPath');
            var folderId = dialog.getContentElement('tab-basic', 'folderlink_folderid');
            var folderName = dialog.getContentElement('tab-basic', 'folderlink_foldername');
            var folderPath = dialog.getContentElement('tab-basic', 'folderlink_folderpath');
            folderId.setValue(id);
            folderName.setValue(name);
            folderPath.setValue(path);
            this.getContentElement('tab-basic','folderlink_folderid').getElement().hide();
            this.getContentElement('tab-basic','folderlink_folderpath').disable();

            
        }
        
        
    };
});