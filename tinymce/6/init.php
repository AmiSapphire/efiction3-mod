<?php
$image_list_path = STORIESPATH . "/" . USERUID . "/images/imagelist.js";
$image_list_exists = file_exists($image_list_path);

if (USERUID && $image_list_exists)
{
echo "
<script src='".STORIESPATH . "/" . USERUID . "/images/imagelist.js"."'></script>";
}
echo "
	<script language=\"javascript\" type=\"text/javascript\"><!--";
	$tinylanguage = $language;
	if (!file_exists(_BASEDIR . "tinymce/langs/{$language}.js"))
	{
		$tinylanguage = "en";
	}
	$tinymessage = dbquery("SELECT message_text FROM ".TABLEPREFIX."fanfiction_messages WHERE message_name = 'tinyMCE' LIMIT 1");
	list($tinysettings) = dbrow($tinymessage);
	if(!empty($tinysettings) && $current != "adminarea") {
		echo $tinysettings;
	}
	else {
		echo "
	tinymce.init({
  		selector: 'textarea:not(.mceNoEditor)',
  		resize: 'both',
  		menubar: false,
		language: '$tinylanguage',
  		theme: 'silver',
		invalid_styles: 'color,font-size,margin,line-height,font-family,margin-top,margin-bottom',
		plugins: 'wordcount emoticons fullscreen anchor code image link',
		skin: 'tinymce-5',
		min_height: 300,
		min_width: 200,
		height: 300,
		width: 580,
		toolbar_location: 'top',
	    browser_spellcheck: true,
		relative_urls: false,
		remove_script_host: false,
    	convert_urls: true,
		toolbar1: 'bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist | undo redo | fullscreen code | link unlink | emoticons image anchor hr ',	image_advtab: true,
	    menu: {
			file: { title: 'File', items: 'newdocument' },
			edit: { title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall' },
			insert: { title: 'Insert', items: 'link media | template hr' },
			view: { title: 'View', items: 'visualaid' },
			table: { title: 'Table', items: 'inserttable tableprops deletetable | cell row column' },
			tools: { title: 'Tools', items: '' }
    	},";
		if (USERUID && $image_list_exists)
			echo "	image_list: tinyMCE6ImageList ,";
		echo "
		theme_silver_resizing: true,".($current == "adminarea" ? "\n\t\tentity_encoding: 'raw'" : "\n\t\tinvalid_elements: 'script,object,applet,iframe'")."
   });

";
	}
	echo "
var tinyMCEmode = true;
	function toogleEditorMode(id) {
		var elm = document.getElementById(id);

		if (tinyMCE.get(id) == null)
		tinymce.EditorManager.execCommand('mceToggleEditor', true, id);
		else
		tinymce.EditorManager.execCommand('mceToggleEditor', false, id);
	}
";
echo " --></script>";
