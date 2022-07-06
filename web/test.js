import ImageInsert from '@ckeditor/ckeditor5-image/src/imageinsert';

ClassicEditor
.create( document.querySelector( '#editor' ),{
    toolbar: {
    items: [
        'heading', '|',
        'fontfamily', 'fontsize', '|',
        'alignment', '|',
        'fontColor', 'fontBackgroundColor', '|',
        'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', '|',
        'link', '|',
        'outdent', 'indent', '|',
        'bulletedList', 'numberedList', 'todoList', '|',
        'code', 'codeBlock', '|',
        'insertTable', '|',
        'uploadImage', 'blockQuote', '|',
        'undo', 'redo',
        ],
        image: {
            toolbar: [
                'imageStyle:inline',
                'imageStyle:block',
                'imageStyle:side',
                '|',
                'toggleImageCaption',
                'imageTextAlternative'
            ]
        },
shouldNotGroupWhenFull: true
}

} )
.catch( error => {
console.error( error );
} );