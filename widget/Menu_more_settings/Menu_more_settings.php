<?php

/**
 *   * Name: Settings menu
 *   * Description: Display the channel settings menu
 */

namespace Zotlabs\Widget;

class Menu_more_settings {

	function widget($arr) {

		if(! local_channel())
			return;

		$channel = \App::get_channel();

		$tabs = array(
			array(
				'label'	=> t('Channel home settings'),
				'url' 	=> z_root().'/settings/channel_home',
				'selected'	=> ((argv(1) === 'channel_home') ? 'active' : ''),
			),

			array(
				'label'	=> t('Connections settings'),
				'url' 	=> z_root().'/settings/connections',
				'selected'	=> ((argv(1) === 'connections') ? 'active' : ''),
			),

			array(
				'label'	=> t('Streams settings'),
				'url' 	=> z_root().'/settings/network',
				'selected'	=> ((argv(1) === 'network') ? 'active' : ''),
			),
			
			array(
				'label'	=> t('Directory settings'),
				'url' 	=> z_root().'/settings/directory',
				'selected'	=> ((argv(1) === 'directory') ? 'active' : ''),
			),			

			array(
				'label'	=> t('Calendar settings'),
				'url' 	=> z_root().'/settings/calendar',
				'selected'	=> ((argv(1) === 'calendar') ? 'active' : ''),
			),

			array(
				'label'	=> t('Photo settings'),
				'url' 	=> z_root().'/settings/photos',
				'selected'	=> ((argv(1) === 'photos') ? 'active' : '')
			)
		);


		$tabtpl = get_markup_template("generic_links_widget.tpl");
		return replace_macros($tabtpl, array(
			'$title' => t('Personalization'),
			'$class' => 'settings-widget',
			'$items' => $tabs,
		));
	}

}
