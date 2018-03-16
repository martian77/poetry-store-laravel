const ClassicEditor = require('@ckeditor/ckeditor5-build-classic');

var editor = document.querySelector( '.ckeditor' );

if ( editor ) {
    ClassicEditor
        .create( editor, {
          toolbar: ['bold', 'italic']
        } )
        .catch( error => {
            console.error( error );
        } );
}
