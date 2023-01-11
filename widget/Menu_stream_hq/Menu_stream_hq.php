<?php

/**
 *   * Name: Stream HQ Menu Widget
 *   * Description: Display links to HQ, Stream, DMs, and Connections.
 *   * Version: 1.0
 *   * Author: Scott M. Stolz
 *   * Maintainer: Scott M. Stolz
 *   * Copyright: WisTex TechSero Ltd. Co.
 *   * License: MIT License (Expat Verion) - https://license.neuhub.org
 */

namespace Zotlabs\Widget;

class Menu_stream_hq {

	function widget($arr) {

		if(! local_channel())
			return;

		$channel = \App::get_channel();

		if(x($_GET,'dm')) {
			$dm_active = (($_GET['dm'] == 1) ? 'active' : '');
			$filter_active = 'dm';
		}


		$tabs = array(

			array(
				'label'	=> t('Stream'),
				'url' 	=> z_root().'/network',
				'selected'	=> ((argv(0) === 'network' and $filter_active != 'dm') ? 'active' : ''),
			),

			array(
				'label'	=> t('Headquarters (HQ)'),
				'url' 	=> z_root().'/hq',
				'selected'	=> ((argv(0) === 'hq') ? 'active' : ''),
			),



			array(
				'label'	=> t('Direct Messages'),
				'url' 	=> z_root().'/network/?dm=1',
				'selected'	=> $dm_active,
			),

			array(
				'label'	=> t('Connections'),
				'url' 	=> z_root().'/connections',
				'selected'	=> ((argv(0) === 'connections') ? 'active' : '')
			)
		);


		$tabtpl = get_markup_template("generic_links_widget.tpl");
		return replace_macros($tabtpl, array(
			'$title' => t('Social'),
			'$class' => 'settings-widget',
			'$items' => $tabs,
		));
	}

}
