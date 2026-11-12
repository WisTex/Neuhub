<?php
/**
 * Name: Addon Template
 * Description: Working, commented reference for Hubzilla addon development.
 * Version: 0.1.0
 * Depends: Core
 * Category: Development
 * Author: WisTex TechSero Ltd. Co.
 * Copyright: 2026 WisTex TechSero Ltd. Co.
 * License: MIT Expat License
 *
 * This file is the addon entry point. Hubzilla reads the metadata above.
 * Hubzilla calls addon_template_load() when enabling the addon and
 * addon_template_unload() when disabling it.
 */

use Zotlabs\Extend\Route;

function addon_template_load() {
    // Each independent URL root needs a matching registered module.
    // The module files contain the actual request handlers.
    Route::register('addon/addon_template/Mod_Addon_template.php', 'addon_template');
    Route::register('addon/addon_template/Mod_Addon_template_help.php', 'addon_template_help');
}

function addon_template_unload() {
    // Always reverse the registrations made by _load().
    Route::unregister('addon/addon_template/Mod_Addon_template.php', 'addon_template');
    Route::unregister('addon/addon_template/Mod_Addon_template_help.php', 'addon_template_help');
}
