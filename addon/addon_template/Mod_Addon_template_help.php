<?php
/**
 * Addon Template: independent second module.
 * Copyright (c) 2026 WisTex TechSero Ltd. Co.
 * SPDX-License-Identifier: MIT
 * License: MIT Expat License
 *
 * URL: /addon_template_help
 * Unlike /addon_template/about, this URL is registered as its own route
 * in addon_template.php and handled by its own Controller class.
 */
namespace Zotlabs\Module;

use Zotlabs\Web\Controller;

class Addon_template_help extends Controller {
    public function get() {
        return replace_macros(
            get_markup_template('example.tpl', 'addon/addon_template'),
            [
                '$title' => t('Independent Module'),
                '$message' => t('This page is handled by a second registered module in the same addon.'),
                '$home_url' => z_root() . '/addon_template',
                '$about_url' => z_root() . '/addon_template/about',
                '$help_url' => z_root() . '/addon_template_help',
                // This route is registered in addon_template_load().
                '$form_url' => z_root() . '/addon_template_form',
                '$home_label' => t('Home'),
                '$about_label' => t('About'),
                '$help_label' => t('Separate module'),
                '$form_label' => t('Form example')
            ]
        );
    }
}
