<?php

/**
 *   * Name: Neuhub Tab
 *   * Description: A theme by Neuhub.org using the Tabler UI Kit.
 *   * Version: 0.1
 *   * MinVersion: 8.0
 *   * MaxVersion: 10.0
 *   * Author: Scott M. Stolz
 *   * Maintainer: Scott M. Stolz
 *   * License: MIT License (Expat Version) - https://license.neuhub.org
 *   * Copyright: 2023 © WisTex TechSero Ltd. Co., Nuehub, Tabler, and others.
 *   * Website: https://neuhub.org
 *   * Respository: https://github.com/WisTex/Neuhub
 *   * Compat: Hubzilla [*]
 *
 */

// ! When you create a new theme, don't forget to edit the information above and below.
// If you change the name of the theme to `yournewname` change `redbasicchild_init` to `yournewname_init` so it has a unique name.
// You will also need to edit the style.php file if you change the directory name.

function neuhubtab_init(&$App) {

    // If your theme does not have a template file (*.tpl), it will use the Redbasic version.
    // This way, if new templates are added to the core, it is automatically supported. 
    // Although keep in mind that Redbasic assumes you are using Bootstrap in your theme.
    App::$theme_info['extends'] = 'redbasic';

}
