/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

 /*
CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For the complete reference:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.height = '450px';
	
	
	config.toolbar = [
	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
	{ name: 'tools', items: [ 'Maximize' ] },
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
	//{ name: 'editing', groups: [ 'find', 'selection' ], items: [ 'Scayt' ] },
	
	//{ name: 'others', items: [ '-' ] },
	//'/',
	{ name: 'styles', items: [ 'Format' ] },
	
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
	{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
	{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
	{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
	{ name: 'colors' },
  { name: 'about', items: [ 'About' ] }
];

	
	// Remove some buttons, provided by the standard plugins, which we don't
	// need to have in the Standard(s) toolbar.
	config.removeButtons = 'Underline';

	// Se the most common block elements.
	//config.format_tags = 'p;h2;h3;h4';

  config.allowedContent = true;

	// Make dialogs simpler.
	config.removeDialogTabs = 'image:advanced;link:advanced';
	
	config.entities_latin = false; 
	
	config.filebrowserBrowseUrl = '../../../../../media/admin/js/ckeditor/plugins/elfinder/elfinder.html';
	
  	
};
*/

/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.on( 'dialogDefinition', function( ev ) {
    var dialogName = ev.data.name;
    var dialogDefinition = ev.data.definition;

    if ( dialogName == 'table' ) {
        var info = dialogDefinition.getContents( 'info' );
        var advanced = dialogDefinition.getContents( 'advanced' );

               // Set default width to 100%
        info.get( 'txtBorder' )[ 'default' ] = '0';         // Set default border to 0
        //advanced.get( 'txtGenClass' )['default'] = 'something';
        //advanced.get( 'txtId' )[ 'default' ] = 'table-responsible';
    }

});

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For the complete reference:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
 // config.skin = 'bootstrapck';
	config.toolbarGroups = [
	    { name: 'document',	   groups: [ 'mode',] },
	    { name: 'tools' },
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
	//	{ name: 'filebrowser', groups: [ 'filebrowser' ] },
	//	{ name: 'others' },
	 	'/',
	//	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },

		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align'] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons, provided by the standard plugins, which we don't
    config.removeButtons = 'Styles,Print,Preview,NewPage,ShowBlocks,Flash,PageBreak,Smiley';

	config.removeDialogTabs = 'image:advanced;link:advanced';

	config.allowedContent = true;

	config.entities_latin = false;
/*
    config.filebrowserBrowseUrl = '/media/admin/js/kcfinder/browse.php?opener=ckeditor&type=files';
    config.filebrowserImageBrowseUrl = '/media/admin/js/kcfinder/browse.php?opener=ckeditor&type=images';
    config.filebrowserFlashBrowseUrl = '/media/admin/js/kcfinder/browse.php?opener=ckeditor&type=flash';
    config.filebrowserUploadUrl = '/media/admin/js/kcfinder/upload.php?opener=ckeditor&type=files';
    config.filebrowserImageUploadUrl = '/media/admin/js/kcfinder/upload.php?opener=ckeditor&type=images';
    config.filebrowserFlashUploadUrl = '/media/admin/js/kcfinder/upload.php?opener=ckeditor&type=flash';
*/
    config.filebrowserBrowseUrl = '/admin/file_manager';
/*
    config.filebrowserBrowseUrl = '/media/admin/js/elfinder/elfinder.html';

    config.filebrowserBrowseUrl = '/media/admin/js/fileman/index.html';
    config.filebrowserImageBrowseUrl = '/media/admin/js/fileman/index.html?type=images';
    config.filebrowserUploadUrl = '/media/admin/js/fileman/index.html';
    config.filebrowserImageUploadUrl = '/media/admin/js/fileman/index.html?type=images';*/

};
