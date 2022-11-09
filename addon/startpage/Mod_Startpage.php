<?php

namespace Zotlabs\Module;

use App;
use Zotlabs\Lib\Apps;
use Zotlabs\Web\Controller;

class Startpage extends Controller {

	function post() {

		if(! local_channel())
			return;

		if(! Apps::addon_app_installed(local_channel(),'startpage'))
			return;

		check_form_security_token_redirectOnErr('/startpage', 'startpage');

		$channel = App::get_channel();

		$page = strip_tags(trim($_POST['startpage']));
		$page = trim($page,'/');

		if($page == 'channel')
			$page = 'channel/' . $channel['channel_address'];
		elseif($page == '')
			$page = '';
		else
			if(strpos($page,'http') !== 0)
				$page = $page;

		$r = q("update channel set channel_startpage = '%s' where channel_id = %d",
			dbesc($page),
			intval(local_channel())
		);

	}

	function get() {

		if(! local_channel())
			return;

		if(! Apps::addon_app_installed(local_channel(), 'startpage')) {
			//Do not display any associated widgets at this point
			App::$pdl = '';
			$papp = Apps::get_papp('Startpage');
			return Apps::app_render($papp, 'module');
		}

		$r = q("select channel_startpage from channel where channel_id = %d",
			intval(local_channel())
		);

		$page = $r[0]['channel_startpage'];

		$sc .= replace_macros(get_markup_template('field_input.tpl'), array(
			'$field'	=> array('startpage', t('Page to load after login'), $page, t('Examples: &quot;apps&quot;, &quot;network?f=&gid=37&quot; (privacy collection), &quot;channel&quot; or &quot;notifications/system&quot; (leave blank for default network page (grid).'))
		));

		$tpl = get_markup_template("settings_addon.tpl");

		$o .= replace_macros($tpl, array(
			'$action_url' => 'startpage',
			'$form_security_token' => get_form_security_token("startpage"),
			'$title' => t('Startpage'),
			'$content'  => $sc,
			'$baseurl'   => z_root(),
			'$submit'    => t('Submit'),
		));

		return $o;

	}

}
