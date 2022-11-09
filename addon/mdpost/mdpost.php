<?php

/**
 * Name: MarkdownPoster
 * Description: Use Markdown in posts/comments.
 * 
 */

function mdpost_load() {
	\Zotlabs\Extend\Hook::register('post_content','addon/mdpost/mdpost.php','mdpost_post_content');
	\Zotlabs\Extend\Hook::register('get_features','addon/mdpost/mdpost.php','mdpost_get_features');
}
function mdpost_unload() {
	\Zotlabs\Extend\Hook::unregister('post_content','addon/mdpost/mdpost.php','mdpost_post_content');
	\Zotlabs\Extend\Hook::unregister('get_features','addon/mdpost/mdpost.php','mdpost_get_features');
}


function mdpost_post_content(&$x) {

	if(! (local_channel() && local_channel() == intval($x['profile_uid'])))
		return;

	if($x['mimetype'] !== 'text/bbcode')
		return;

	if(feature_enabled(local_channel(),'markdown')) {
		require_once('include/markdown.php');
		$body = preg_replace_callback('/\[share(.*?)\]/ism','\share_shield',$x['content']);
		$body = markdown_to_bb($body,true,['preserve_lf' => true]);
		$x['content'] = preg_replace_callback('/\[share(.*?)\]/ism','\share_unshield',$body);
	}

}


function mdpost_get_features(&$x) {

	$entry = [
		'markdown',                                                                         
		t('Markdown'),                                                                      
		t('Use markdown for editing posts'),                                                
		false,                                                                              
		get_config('feature_lock','markdown')
	];

	$x['features']['editor'][] = $entry;

}
