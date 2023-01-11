<?php

/**
 *   * Name: Connections Menu Widget
 *   * Description: Display additional navigation related to connections.
 *   * Version: 1.0
 *   * Author: Scott M. Stolz
 *   * Maintainer: Scott M. Stolz
 *   * Copyright: WisTex TechSero Ltd. Co.
 *   * License: MIT License (Expat Verion) - https://license.neuhub.org
 */

namespace Zotlabs\Widget;

use Zotlabs\Lib\Permcat;
use Zotlabs\Access\PermissionLimits;


class Menu_connections {

	function widget($arr) {

		if(! local_channel())
			return;

		$channel = \App::get_channel();

		$tabs = array(
			array(
				'label'	=> t('All Connections'),
				'url' 	=> z_root().'/connections',
				'selected'	=> ((argv(0) === 'connections' and argv(1) === '') ? 'active' : ''),
			),

			array(
				'label'	=> t('Active Connections'),
				'url' 	=> z_root().'/connections/active',
				'selected'	=> ((argv(1) === 'active') ? 'active' : ''),
			),

			array(
				'label'	=> t('Pending Connections'),
				'url' 	=> z_root().'/connections/pending',
				'selected'	=> ((argv(1) === 'pending') ? 'active' : ''),
			),
			
			array(
				'label'	=> t('Blocked'),
				'url' 	=> z_root().'/connections/blocked',
				'selected'	=> ((argv(1) === 'blocked') ? 'active' : ''),
			),			

			array(
				'label'	=> t('Ignored'),
				'url' 	=> z_root().'/connections/ignored',
				'selected'	=> ((argv(1) === 'ignored') ? 'active' : ''),
			),

			array(
				'label'	=> t('Archived / Unreachable'),
				'url' 	=> z_root().'/connections/archived',
				'selected'	=> ((argv(1) === 'archived') ? 'active' : ''),
			),
			
			array(
				'label'	=> t('Hidden'),
				'url' 	=> z_root().'/connections/hidden',
				'selected'	=> ((argv(1) === 'hidden') ? 'active' : ''),
			)

		);


		$tabtpl = get_markup_template("generic_links_widget.tpl");
		$outputnull = replace_macros($tabtpl, array(
			'$title' => t('Connections'),
			'$class' => 'settings-widget',
			'$items' => $tabs,
		));


		$tabs2 = array(
	
			array(
				'label'	=> t('Connections'),
				'url' 	=> z_root().'/connections',
				'selected'	=> ((argv(0) === 'connections' and argv(1) === '') ? 'active' : ''),
			),

			array(
				'label'	=> t('Contact Roles'),
				'url' 	=> z_root() . '/permcats/',
				'selected'	=> ((argv(0) === 'permcats') ? 'active' : ''),
			),			

			array(
				'label'	=> t('Privacy Groups'),
				'url' 	=> z_root().'/group/new',
				'selected'	=> ((argv(0) === 'group') ? 'active' : ''),
			)
		);


		$tab2tpl = get_markup_template("generic_links_widget.tpl");
		$output = $output . replace_macros($tab2tpl, array(
			'$title' => t('Connections'),
			'$class' => 'settings-widget',
			'$items' => $tabs2,
		));

        return $output;

	}

}
