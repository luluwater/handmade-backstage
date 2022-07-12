<<<<<<< HEAD
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
=======

  CKEDITOR.ClassicEditor.create(document.getElementById("atricle_editor"), {
    toolbar: {
      items: [
        "exportPDF",
        "exportWord",
        "|",
        "findAndReplace",
        "selectAll",
        "|",
        "heading",
        "|",
        "bold",
        "italic",
        "strikethrough",
        "underline",
        "code",
        "subscript",
        "superscript",
        "removeFormat",
        "|",
        "bulletedList",
        "numberedList",
        "todoList",
>>>>>>> efc37a07a995910586736d8b5f8b6943bf49bad7
        "|",
        "outdent",
        "indent",
        "|",
<<<<<<< HEAD
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
=======
        "undo",
        "redo",
        "-",
        "fontSize",
        "fontFamily",
        "fontColor",
        "fontBackgroundColor",
        "highlight",
        "|",
        "alignment",
        "|",
        "link",
        "insertImage",
        "blockQuote",
        "insertTable",
        "mediaEmbed",
        "codeBlock",
        "htmlEmbed",
        "|",
        "specialCharacters",
        "horizontalLine",
        "pageBreak",
        "|",
        "textPartLanguage",
        "|",
        "sourceEditing",
      ],
      shouldNotGroupWhenFull: true,
    },
    list: {
      properties: {
        styles: true,
        startIndex: true,
        reversed: true,
      },
    },

    heading: {
      options: [{
          model: "paragraph",
          title: "Paragraph",
          class: "ck-heading_paragraph"
        },
        {
          model: "heading1",
          view: "h1",
          title: "Heading 1",
          class: "ck-heading_heading1",
        },
        {
          model: "heading2",
          view: "h2",
          title: "Heading 2",
          class: "ck-heading_heading2",
        },
        {
          model: "heading3",
          view: "h3",
          title: "Heading 3",
          class: "ck-heading_heading3",
        },
        {
          model: "heading4",
          view: "h4",
          title: "Heading 4",
          class: "ck-heading_heading4",
        },
        {
          model: "heading5",
          view: "h5",
          title: "Heading 5",
          class: "ck-heading_heading5",
        },
        {
          model: "heading6",
          view: "h6",
          title: "Heading 6",
          class: "ck-heading_heading6",
        },
      ],
    },

    placeholder: "開始寫文章吧!!",

    fontFamily: {
      options: [
        "default",
        "Arial, Helvetica, sans-serif",
        "Courier New, Courier, monospace",
        "Georgia, serif",
        "Lucida Sans Unicode, Lucida Grande, sans-serif",
        "Tahoma, Geneva, sans-serif",
        "Times New Roman, Times, serif",
        "Trebuchet MS, Helvetica, sans-serif",
        "Verdana, Geneva, sans-serif",
      ],
      supportAllValues: true,
    },

    fontSize: {
      options: [10, 12, 14, "default", 18, 20, 22],
      supportAllValues: true,
    },

    htmlSupport: {
      allow: [{
        name: /.*/,
        attributes: true,
        classes: true,
        styles: true,
      }, ],
    },

    htmlEmbed: {
      showPreviews: true,
    },

    link: {
      decorators: {
        addTargetToExternalLinks: true,
        defaultProtocol: "https://",
        toggleDownloadable: {
          mode: "manual",
          label: "Downloadable",
          attributes: {
            download: "file",
          },
        },
      },
    },

    mention: {
      feeds: [{
        marker: "@",
        feed: [
          "@apple",
          "@bears",
          "@brownie",
          "@cake",
          "@cake",
          "@candy",
          "@canes",
          "@chocolate",
          "@cookie",
          "@cotton",
          "@cream",
          "@cupcake",
          "@danish",
          "@donut",
          "@dragée",
          "@fruitcake",
          "@gingerbread",
          "@gummi",
          "@ice",
          "@jelly-o",
          "@liquorice",
          "@macaroon",
          "@marzipan",
          "@oat",
          "@pie",
          "@plum",
          "@pudding",
          "@sesame",
          "@snaps",
          "@soufflé",
          "@sugar",
          "@sweet",
          "@topping",
          "@wafer",
        ],
        minimumCharacters: 1,
      }, ],
    },
    removePlugins: [
      "CKBox",
      "CKFinder",
      "EasyImage",
      "RealTimeCollaborativeComments",
      "RealTimeCollaborativeTrackChanges",
      "RealTimeCollaborativeRevisionHistory",
      "PresenceList",
      "Comments",
      "TrackChanges",
      "TrackChangesData",
      "RevisionHistory",
      "Pagination",
      "WProofreader",
      "MathType",
    ],

>>>>>>> efc37a07a995910586736d8b5f8b6943bf49bad7
  });
