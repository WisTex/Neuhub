<?php

/**
 * Name: Hilite
 * Description: Syntax highlight code blocks
 * Version: 1.0
 *
 */



function hilite_install() {
	Zotlabs\Extend\Hook::Register('text_highlight','addon/hilite/hilite.php','hilite_text_highlight');
	Zotlabs\Extend\Hook::Register('load_pdl','addon/hilite/hilite.php','hilite_load_pdl');
}

function hilite_uninstall() {
	Zotlabs\Extend\Hook::Unregister('text_highlight','addon/hilite/hilite.php','hilite_text_highlight');
	Zotlabs\Extend\Hook::Unregister('load_pdl','addon/hilite/hilite.php','hilite_load_pdl');
}

function hilite_load_pdl(&$b) {
	$css = head_get_css();
	if(strpos($css,'Text_Highlighter/sample.css') === false)
		head_add_css('/addon/hilite/Text_Highlighter/sample.css');
}

function hilite_text_highlight(&$x) {

	$lang = strtolower($x['language']);

	if($lang === 'js')
        $lang = 'javascript';

    if($lang === 'json') {
        $lang = 'javascript';
        if(! strpos(trim($s), "\n"))
            $s = jindent($s);
    }

	if($lang === 'bash')
		$lang = 'sh';

	$language = ((in_array($lang,['php','css','mysql','sql','abap','diff','html','perl','ruby',
        'vbscript','avrc','dtd','java','xml','cpp','python','javascript','js','json','sh']))
        ? $lang : '');

	if(! $language)
		return;



	$s = $x['text'];

	if(! strpos('Text_Highlighter', get_include_path())) {
        set_include_path(get_include_path() . PATH_SEPARATOR . 'addon/hilite/Text_Highlighter');
    }
    require_once('addon/hilite/Text_Highlighter/Text/Highlighter.php');
    require_once('addon/hilite/Text_Highlighter/Text/Highlighter/Renderer/Html.php');
    $options = array(
        'numbers' => HL_NUMBERS_LI,
        'tabsize' => 4,
    );
    $tag_added = false;
    $s = trim(html_entity_decode($s, ENT_COMPAT));
    $s = str_replace("    ", "\t", $s);

    // The highlighter library insists on an opening php tag for php code blocks. If
    // it isn't present, nothing is highlighted. So we're going to see if it's present.
    // If not, we'll add it, and then quietly remove it after we get the processed output back.

    if($language === 'php') {
        if(strpos('<?php', $s) !== 0) {
            $s = '<?php' . "\n" . $s;
            $tag_added = true;
        }
    }
    $renderer = new Text_Highlighter_Renderer_HTML($options);
    $hl = Text_Highlighter::factory($language);
    $hl->setRenderer($renderer);
    $o = $hl->highlight($s);
    $o = str_replace(["    ", "\n"], ["&nbsp;&nbsp;&nbsp;&nbsp;", ''], $o);

    if($tag_added) {
        $b = substr($o, 0, strpos($o, '<li>'));
        $e = substr($o, strpos($o, '</li>'));
        $o = $b . $e;
    }

	$x['success'] = true;
	$x['text'] = $o;

}

