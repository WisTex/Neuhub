<?php

/**
 *   * Name: Redbasic Child Theme
 *   * Description: A derivative theme of Redbasic that you can use as a starting point for creating your own themes.
 *   * Version: 1.2.2
 *   * MinVersion: 7.2
 *   * MaxVersion: 10.0
 *   * Author: Scott M. Stolz
 *   * Maintainer: Scott M. Stolz
 *   * License: MIT License (Expat Version) - https://license.neuhub.org
 *   * Copyright: 2022 © WisTex TechSero Ltd. Co.
 *   * Respository: https://github.com/WisTex/Neuhub
 *   * Compat: Hubzilla [*]
 *
 */

// When you create a new theme, don't forget to edit the information above.
// If you change the name of the theme to `yournewname` change `redbasicchild_init` to `yournewname_init` so it has a unique name.
// You will also need to edit the style.php file if you change the directory name.

function redbasicchild_init(&$App) {

    App::$theme_info['extends'] = 'redbasic';


}
