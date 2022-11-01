<?php

namespace Zotlabs\Module;

use App;
use Zotlabs\Lib\Apps;
use Zotlabs\Web\Controller;

class Pubcrawl extends Controller {



	function post() {

		if(! local_channel())
			return;

		if(! Apps::addon_app_installed(local_channel(), 'pubcrawl'))
			return;

		check_form_security_token_redirectOnErr('/pubcrawl', 'pubcrawl');

		set_pconfig(local_channel(),'activitypub','downgrade_media', 1 - intval($_POST['activitypub_send_media']));
		set_pconfig(local_channel(),'activitypub','include_groups',intval($_POST['include_groups']));
		info( t('ActivityPub Protocol Settings updated.') . EOL);

	}

	function get() {

		if(! local_channel())
			return;

		if(! Apps::addon_app_installed(local_channel(), 'pubcrawl')) {
			//Do not display any associated widgets at this point
			App::$pdl = '';
			$papp = Apps::get_papp('Activitypub Protocol');
			return Apps::app_render($papp, 'module');
		}

		$desc = t('The activitypub protocol does not support location independence. Connections you make within that network may be unreachable from alternate channel locations.');
		$yes_no = [t('No'),t('Yes')];

		$sc = '<div class="section-content-info-wrapper">' . $desc . '</div><br>';

		$sc .= replace_macros(get_markup_template('field_checkbox.tpl'), array(
			'$field'	=> array('include_groups', t('Deliver to ActivityPub recipients in privacy groups'), get_pconfig(local_channel(),'activitypub','include_groups'), t('May result in a large number of mentions and expose all the members of your privacy group'), $yes_no),
		));

		$sc .= replace_macros(get_markup_template('field_checkbox.tpl'), array(
			'$field'	=> array('activitypub_send_media', t('Send multi-media HTML articles'), 1 - intval(get_pconfig(local_channel(),'activitypub','downgrade_media',true)), t('Not supported by some microblog services such as Mastodon'), $yes_no),
		));

		$tpl = get_markup_template("settings_addon.tpl");

		$o .= replace_macros($tpl, array(
			'$action_url' => 'pubcrawl',
			'$form_security_token' => get_form_security_token("pubcrawl"),
			'$title' => t('Activitypub Protocol'),
			'$content'  => $sc,
			'$baseurl'   => z_root(),
			'$submit'    => t('Submit'),
		));

		return $o;

	}

}
