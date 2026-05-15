/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    config.htmlEncodeOutput = false;
    config.entities = false;
    config.extraPlugins = 'fontawesome,leaflet';

    CKEDITOR.dtd.$removeEmpty['i'] = false;
    CKEDITOR.dtd.$removeEmpty['span'] = false;

    // Alternative Google API key for Leaflet. Please use your own through Opencart's module settings.
    config.leaflet_maps_google_api_key = 'AIzaSyApORjK2F49NiPhMRZCsEc61n8N7neVKBg';

    // Quicktable Options
    config.qtWidth = '100%'; // Width of inserted table
    config.qtClass = 'table table-bordered'; // Class of table

    // Codemirror theme
    config.theme = 'eclipse';

    // Enable Google Web Fonts plugin.
    config.font_names = 'GoogleWebFonts;' + config.font_names;

    // Line Heights
    config.line_height="1.0;1.2;1.4;1.5;1.6;1.8;2.0;2.5;3.0;4.0;5.0;6.0;7.0;8.0;9.0;10.0";

    // Paste from word
    config.pasteFromWordPromptCleanup = true;
    config.pasteFromWordNumberedHeadingToList = true;
    config.pasteFromWordRemoveFontStyles=false;
    config.pasteFromWordRemoveStyles=false;

    // Image 2 Styling (text-* are bootstrap classes for both text and images)
    config.image2_alignClasses = [ 'text-left', 'text-center', 'text-right' ];
    config.image2_captionedClass = 'image-captioned';
    config.filebrowserBrowseUrl='a'; // fixes bug with image2 and filebrowser integration

    // Bootstrap glyphicons and fontawesome requirements.
    config.contentsCss = [CKEDITOR.getUrl('../../javascript/bootstrap/css/bootstrap.css'),CKEDITOR.getUrl('plugins/glyphicons/css/css/bootstrap.css'),CKEDITOR.getUrl('plugins/fontawesome/font-awesome/css/font-awesome.min.css')];

    // Media Embed API (it is recommended to create your own API key at iframely.com).
    config.embed_provider = '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}';

    // Toolbar configuration.
    config.toolbar = [
        { name: 'document', items: [ 'Source', 'autoFormat', 'CommentSelectedRange', 'UncommentSelectedRange', 'AutoComplete', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
        { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
        { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt', 'AutoCorrect' ] },
        { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField', '-', 'simplebutton' ] },
        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
        '/',
        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        { name: 'paragraph', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-',  '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
        { name: 'insert', items: [ 'Image', 'Slideshow', 'Table', 'HorizontalRule', 'PageBreak', 'Iframe', '-', 'Glyphicons', 'FontAwesome', 'Symbol', 'SpecialChar', '-', 'leaflet', 'Embed', 'Youtube', 'videosnapshot', 'Html5video', 'Flash', '-', 'WidgetcommonQuotebox', 'WidgetcommonBox', 'Smiley', 'qrc' ] },
        '/',
        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize', 'lineheight', 'letterspacing' ] },
        { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
        { name: 'about', items: [ 'About' ] }
    ];

    // Skin selector.
    config.skin = 'moono-lisa';
};


