<?php
/**
 * Name: CustomPage
 * Description: Add a custom page (with a custom URL).
 * Version: 1.0
 * Depends: Core
 * Recommends: None
 * Category: CustomPage
 * Author: Randall Jaffe
 * Maintainer: Scott M. Stolz
 * Copyright: 2024 WisTex TechSero Ltd. Co.
 * License: MIT License
*/

/**
 * * CustomPage Addon
 * This is the primary file defining the addon.
 * It defines the name of the addon and gives information about the addon to other components of Hubzilla.
*/

/**
 * TODO: To Add Pages
 * If you would like to add pages: 
 * 
 * 1. Add your custom page to the `const` variable below.
 * 2. Add routes for each custom URL (both register and unregister).
 * 3. Create a module for each URL (in modules directory). 
 *    - Change the class name in the module.
 *    - Change the page title in the module.
 *    - Add programming logic or database calls (if you want to do more than just display the html in the tpl file).
 * 4. Create a template for each URL (tpl file).
 * 5. Create a pdl file if you do not want to use the default theme layout (in pdl directory). 
 * 
 * ! Note: If you already have this addon installed on a site: 
 * You will need to deactivate it and reenable it in the Hubzilla admin area (addons section)
 * for it to recognize the new pages. (It needs to register the new pages.)
 */

use Zotlabs\Lib\Apps;
use Zotlabs\Extend\Hook;
use Zotlabs\Extend\Route;
use Zotlabs\Render\Comanche;
use Zotlabs\Module\Webdesign;
use Zotlabs\Module\Hubzilla;
use Zotlabs\Module\Main;

class CustomPage {
    const _CUSTOM_PAGES = ['main', 'webdesign', 'hubzilla'];
    public static function loadAssets(): void {
        if (file_exists(PROJECT_BASE . '/addon/custompage/view/js/custompage.js'))
            head_add_js('/addon/custompage/view/js/custompage.js');

        if (file_exists(PROJECT_BASE . '/addon/custompage/view/css/custompage.css'))
            head_add_css('/addon/custompage/view/css/custompage.css');
    }
}

/**
 * * This function registers (adds) the hook handler and route.
 * The custompage_customize_header() hook handler is registered for the "page_header" hook
 * The custompage_customize_footer() hook handler is registered for the "page_end" hook
 * The "webdesign" route is created for Mod_Webdesign module 
*/
function custompage_load() {
    Hook::register('logged_in', 'addon/custompage/custompage.php', 'custompage_logged_in');
    Hook::register('module_loaded', 'addon/custompage/custompage.php', 'custompage_load_module');
    Hook::register('load_pdl', 'addon/custompage/custompage.php', 'custompage_load_pdl');
    Hook::register('page_header', 'addon/custompage/custompage.php', 'custompage_customize_header');
    Hook::register('page_end', 'addon/custompage/custompage.php', 'custompage_customize_footer');
    Hook::register('home_content', 'addon/custompage/custompage.php', 'custompage_home_redirect');
    Hook::register('home_init', 'addon/custompage/custompage.php', 'custompage_home_redirect_loggedin');
	/* You will need a route and a corresponding module for every custom URL */
    Route::register('addon/custompage/modules/Mod_Main.php', 'main');
    Route::register('addon/custompage/modules/Mod_Webdesign.php', 'webdesign');
    Route::register('addon/custompage/modules/Mod_Hubzilla.php', 'hubzilla');
}

// * This function unregisters (removes) the hook handler and route.
function custompage_unload() {
    Hook::unregister('logged_in', 'addon/custompage/custompage.php', 'custompage_logged_in');
    Hook::unregister('module_loaded', 'addon/custompage/custompage.php', 'custompage_load_module');
    Hook::unregister('load_pdl', 'addon/custompage/custompage.php', 'custompage_load_pdl');
	Hook::unregister('page_header', 'addon/custompage/custompage.php', 'custompage_customize_header');
    Hook::unregister('page_end', 'addon/custompage/custompage.php', 'custompage_customize_footer');
    Hook::unregister('home_content', 'addon/custompage/custompage.php', 'custompage_home_redirect');
    Hook::unregister('home_init', 'addon/custompage/custompage.php', 'custompage_home_redirect_loggedin');
    /* You will need a route and a corresponding module for every custom URL */
    Route::unregister('addon/custompage/modules/Mod_Main.php', 'main');
	Route::unregister('addon/custompage/modules/Mod_Webdesign.php', 'webdesign');
    Route::unregister('addon/custompage/modules/Mod_Hubzilla.php', 'hubzilla');
}

/** 
 * * This function runs when the hook handler is executed.
 * @param $user: A reference to App::$account or App::$user
*/
function custompage_logged_in(&$user) {
	goaway(z_root() . "/hq");
	killme();
}

/** 
 * * This function runs when the hook handler is executed.
 * @param $o: A reference to Home module get() output
*/
function custompage_home_redirect(&$o) {
	//header("Location: " . z_root() . "/main", true, 301);
	//killme();
    require_once('addon/custompage/modules/Mod_Main.php');
    $module = new Main();
    if (method_exists($module, 'init')) {
        $module->init();
    }
    $pdl = @file_get_contents('addon/custompage/pdl/mod_main.pdl');
    App::$comanche->parse($pdl);
    App::$pdl = $pdl;
    CustomPage::loadAssets();
    if (method_exists($module, 'get')) {
        $o = $module->get();
    }
}

/** 
 * * This function runs when the hook handler is executed.
 * @param $ret: A reference to Home module init() object
*/
function custompage_home_redirect_loggedin(&$ret) {
    //$ret['startpage'] = z_root() . "/main";
    require_once('addon/custompage/modules/Mod_Main.php');
    $module = new Main();
    $module->_moduleName = 'main';
    $pdl = @file_get_contents('addon/custompage/pdl/mod_main.pdl');
    App::$comanche = new Comanche();
    App::$comanche->parse($pdl);
    App::$pdl = $pdl;
    CustomPage::loadAssets();
    if (method_exists($module, 'get')) {
        App::$page['content'] = $module->get();
    }
    construct_page();
    killme();
}

/** 
 * * This function runs when the hook handler is executed.
 * @param $arr: A reference to current module
*/
function custompage_load_module(&$arr) {
	if (in_array($arr['module'], CustomPage::_CUSTOM_PAGES)) {
        //$type = ucfirst($arr['module']);
		//require_once('addon/custompage/modules/Mod_' . $type . '.php');
        //$arr['controller'] = new $type();
		//$arr['installed']  = true;
	}
}

/** 
 * * This function runs when the hook handler is executed.
 * @param $arr: A reference to current module and layout
*/
function custompage_load_pdl(&$arr) {
    //die(print_r($arr));
	$pdl = 'addon/custompage/pdl/mod_' . $arr['module'] . '.pdl';
    if (in_array($arr['module'], CustomPage::_CUSTOM_PAGES) && file_exists($pdl)) {
        $arr['layout'] = @file_get_contents($pdl);
	}
}

/** 
 * * This function runs when the hook handler is executed.
 * @param $content: A reference to page header content
*/
function custompage_customize_header(&$content) {
    // Replace Neuhub page header with a custom header
    if (in_array(App::$module, CustomPage::_CUSTOM_PAGES)) {
        //$content = replace_macros(get_markup_template('header_custom.tpl', 'addon/custompage'), []);
        CustomPage::loadAssets();
    }
}

/** 
 * * This function runs when the hook handler is executed.
 * @param $content: A reference to page footer content
*/
function custompage_customize_footer(&$content) {
    // Replace Neuhub page footer with a custom footer
    if (in_array(App::$module, CustomPage::_CUSTOM_PAGES)) {
        //$content .= replace_macros(get_markup_template('footer_custom.tpl', 'addon/custompage'), []);
    }
}

