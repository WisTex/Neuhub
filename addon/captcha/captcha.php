<?php
/**
 * Name: Captcha
 * Description: Inserts CAPTCHA into login and register forms
 * Version: 1.0
 * Depends: Core
 * Recommends: None
 * Category: Spam control
 * Author: Randall Jaffe
*/

/**
 * * Captcha Addon
 * This is the primary file defining the addon.
 * It defines the name of the addon and gives information about the addon to other components of Hubzilla.
*/

use Zotlabs\Lib\Apps;
use Zotlabs\Extend\Hook;
use Zotlabs\Extend\Route;

include_once(__DIR__ . '/lib/Captcha.php');

/**
 * * These functions register (add) the hook handlers and admin route.
*/
function captcha_load() {
	Hook::register('login_hook', 'addon/captcha/captcha.php', 'captcha_login');
	Hook::register('login_auth', 'addon/captcha/captcha.php', 'captcha_loginAuth');
	Hook::register('register_hook', 'addon/captcha/captcha.php', 'captcha_register');
	Hook::register('register_auth', 'addon/captcha/captcha.php', 'captcha_registerAuth');
}

// * These functions unregister (remove) the hook handlers and admin route.
function captcha_unload() {
	Hook::unregister('login_hook', 'addon/captcha/captcha.php', 'captcha_login');
	Hook::unregister('login_auth', 'addon/captcha/captcha.php', 'captcha_loginAuth');
	Hook::unregister('register_hook', 'addon/captcha/captcha.php', 'captcha_register');
	Hook::unregister('register_auth', 'addon/captcha/captcha.php', 'captcha_registerAuth');
}

/** 
 * * These functions run when the hook handlers are executed.
*/
function captcha_login(&$loginFormMarkup) {
	//die("\n\nform markup:\n\n" . $loginFormMarkup);
	$loginFormMarkup = (Captcha::_ENABLED['login']) ? Captcha::UpdateFormMarkup($loginFormMarkup) : $loginFormMarkup;
}

function captcha_loginAuth(&$publicPostVars) {
	//die("\n\nauth info:\n\n" . print_r($publicPostVars, true));
	if (Captcha::_ENABLED['login'] && !Captcha::Authenticate($publicPostVars)) {
		$publicPostVars['error-msg'] = 'CAPTCHA solved incorrectly';
	}
}

function captcha_register(&$registerFormMarkup) {
	//die("\n\nregister markup:\n\n" . $registerFormMarkup);
	$registerFormMarkup = (Captcha::_ENABLED['register']) ? Captcha::UpdateFormMarkup($registerFormMarkup) : $registerFormMarkup;
}

function captcha_registerAuth(&$publicPostVars) {
	//die("\n\nauth info:\n\n" . print_r($publicPostVars, true));
	if (Captcha::_ENABLED['register'] && !Captcha::Authenticate($publicPostVars)) {
		$publicPostVars['error-msg'] = 'CAPTCHA solved incorrectly';
	}
}