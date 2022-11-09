<?php
/**
 * Name: Start Page
 * Description: Set a preferred page to load on login from home page
 * Version: 1.0
 * Author: Mike Macgirvin <http://macgirvin.com/profile/mike>
 * Maintainer: Mike Macgirvin <mike@macgirvin.com> 
 */

use App;
use Zotlabs\Lib\Apps;
use Zotlabs\Extend\Hook;
use Zotlabs\Extend\Route;

function startpage_load() {
	Hook::register('home_init', 'addon/startpage/startpage.php', 'startpage_home_init');
	Route::register('addon/startpage/Mod_Startpage.php','startpage');
}


function startpage_unload() {
	Hook::unregister('home_init', 'addon/startpage/startpage.php', 'startpage_home_init');
	Route::unregister('addon/startpage/Mod_Startpage.php','startpage');
}

function startpage_home_init(&$b) {
	if(! local_channel())
		return;

	if(! Apps::addon_app_installed(local_channel(),'startpage'))
		return;

	$channel = App::get_channel();

	$b['startpage'] = $channel['channel_startpage'];
}
