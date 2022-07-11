CKEditor5.editorClassic.ClassicEditor.create(
  document.querySelector("#editor"),
  {
    plugins: [
      CKEditor5.essentials.Essentials,
      CKEditor5.autoformat.Autoformat,
      CKEditor5.basicStyles.Bold,
      CKEditor5.basicStyles.Italic,
      CKEditor5.basicStyles.Underline,
      CKEditor5.basicStyles.Code,
      CKEditor5.blockQuote.BlockQuote,
      CKEditor5.cloudServices.CloudServices,
      CKEditor5.heading.Heading,
      CKEditor5.image.Image,
      CKEditor5.image.ImageCaption,
      CKEditor5.image.ImageStyle,
      CKEditor5.image.ImageToolbar,
      CKEditor5.image.ImageUpload,
      CKEditor5.indent.Indent,
      CKEditor5.link.Link,
      CKEditor5.list.List,
      CKEditor5.mediaEmbed.MediaEmbed,
      CKEditor5.pasteFromOffice.PasteFromOffice,
      CKEditor5.table.Table,
      CKEditor5.table.TableCaption,
      CKEditor5.table.TableProperties,
      CKEditor5.table.TableCellProperties,
      CKEditor5.table.TableToolbar,
      CKEditor5.typing.TextTransformation,
      CKEditor5.upload.Base64UploadAdapter,
      CKEditor5.htmlEmbed.HtmlEmbed,
    ],
    toolbar: {
      items: [
        "heading",
        "|",
        "htmlEmbed",
        "|",
        "bold",
        "italic",
        "underline",
        "code",
        "link",
        "bulletedList",
        "numberedList",
        "|",
        "outdent",
        "indent",
        "|",
        "uploadImage",
        "blockQuote",
        "insertTable",
        "mediaEmbed",
        "undo",
        "redo",
      ],
    },
    image: {
      toolbar: [
        "imageStyle:inline",
        "imageStyle:block",
        "imageStyle:side",
        "|",
        "toggleImageCaption",
        "imageTextAlternative",
      ],
    },
    table: {
      contentToolbar: [
        "tableColumn",
        "tableRow",
        "mergeTableCells",
        "|",
        "tableProperties",
        "tableCellProperties",
        "|",
        "toggleTableCaption",
      ],
    },
    htmlEmbed: {
      showPreviews: true,
      sanitizeHtml: (inputHtml) => {
        const outputHtml = sanitize(inputHtml);
        return {
          html: outputHtml,
          hasChanged: true,
        };
      },
    },
  }
)
  .then((editor) => {
    window.editor = editor;
  })
  .catch((error) => {
    console.error("There was a problem initializing the editor.", error);
  });
