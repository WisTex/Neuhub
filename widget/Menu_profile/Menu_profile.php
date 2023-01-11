<?php

/**
 *   * Name: Profile Menu Widget
 *   * Description: Display additional navigation related to the current profiles.
 *   * Version: 1.0
 *   * Author: Scott M. Stolz
 *   * Maintainer: Scott M. Stolz
 *   * Copyright: WisTex TechSero Ltd. Co.
 *   * License: MIT License (Expat Verion) - https://license.neuhub.org
 */

namespace Zotlabs\Widget;

class Menu_profile {

	function widget($arr) {

		if(! local_channel())
			return;

		$channel = \App::get_channel();

		$tabs = array(
			array(
				'label'	=> t('View Channel'),
				'url' 	=> z_root().'/channel/'.$channel['channel_address'],
				'selected'	=> ((argv(0) === 'channel') ? 'active' : ''),
			),

			array(
				'label'	=> t('View Profile'),
				'url' 	=> z_root().'/profile/'.$channel['channel_address'],
				'selected'	=> ((argv(0) === 'profile') ? 'active' : ''),
			),

			array(
				'label'	=> t('Edit Profile'),
				'url' 	=> z_root().'/profiles/'.$channel['channel_id'],
				'selected'	=> ((argv(0) === 'profiles') ? 'active' : ''),
			),

			array(
				'label'	=> t('Channels'),
				'url' 	=> z_root().'/manage',
				'selected'	=> ((argv(0) === 'manage') ? 'active' : '')
			)
		);


		$tabtpl = get_markup_template("generic_links_widget.tpl");
		return replace_macros($tabtpl, array(
			'$title' => t('Profile'),
			'$class' => 'settings-widget',
			'$items' => $tabs,
		));
	}

}
