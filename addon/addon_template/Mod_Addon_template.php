<?php
/**
 * Addon Template: primary module and two pages within one route.
 * Copyright (c) 2026 WisTex TechSero Ltd. Co.
 * SPDX-License-Identifier: MIT
 * License: MIT Expat License
 *
 * URLs:
 *   /addon_template         default page
 *   /addon_template/about   second page, dispatched using argv(1)
 *
 * Hubzilla dispatches requests to the Controller methods.
 */
namespace Zotlabs\Module;

use Zotlabs\Web\Controller;

class Addon_template extends Controller {
    public function get() {
        // Hubzilla provides argc()/argv() for URL path components.
        $section = (argc() > 1) ? argv(1) : '';
        if ($section !== '' && $section !== 'about') {
            http_status_exit(404, 'Not Found');
        }

        $title = ($section === 'about') ? t('About this example') : t('Addon Template');
        $message = ($section === 'about')
            ? t('This is a second page served by the same Hubzilla module.')
            : t('This is the default page of a working Hubzilla addon.');

        // Use Hubzilla's template lookup and macro replacement, not a custom renderer.
        return replace_macros(
            get_markup_template('example.tpl', 'addon/addon_template'),
            [
                '$title' => $title,
                '$message' => $message,
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
