FCKConfig.AutoDetectLanguage = false ;
FCKConfig.DefaultLanguage = "cs" ;

FCKConfig.Plugins.Add( 'fckEmbedMovies') ;

FCKConfig.ToolbarSets["Default"] = [
	['FitWindow','Source','DocProps'],
	['Cut','Copy','Paste','PasteText','PasteWord','-','Print'],
	['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],['TextColor','BGColor'],
	['ShowBlocks','-','About'],
	'/',
	['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
	['OrderedList','UnorderedList','-','Outdent','Indent','Blockquote'],
	['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
	['Link','Unlink','Anchor'],
	['Image','EmbedMovies','Table','Rule','SpecialChar','PageBreak'],
	'/',
	['Style','FontFormat']
	
] ;
FCKConfig.EnterMode = 'br' ;	

FCKConfig.IncludeLatinEntities = false ;
FCKConfig.ProcessHTMLEntities = false ;
FCKConfig.IncludeGreekEntities = false ;
FCKConfig.ProcessNumericEntities = false ;
FCKConfig.FillEmptyBlocks = false;

