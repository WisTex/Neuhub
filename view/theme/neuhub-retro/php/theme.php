<?php

/**
 *   * Name: Neuhub Retro
 *   * Description: An updated version of the Redbasic theme.
 *   * Version: 2.4
 *   * MinVersion: 8.0
 *   * MaxVersion: 10.0
 *   * Author: Scott M. Stolz
 *   * Maintainer: Scott M. Stolz
 *   * License: MIT License (Expat Version) - https://license.neuhub.org
 *   * Copyright: 2022 © WisTex TechSero Ltd. Co.
 *   * Website: https://neuhub.org
 *   * Respository: https://github.com/WisTex/Neuhub
 *   * Compat: Hubzilla [*]
 *
 */

// When you create a new theme, don't forget to edit the information above.
// If you change the name of the theme to `yournewname` change `redbasicchild_init` to `yournewname_init` so it has a unique name.
// You will also need to edit the style.php file if you change the directory name.

function neuhubretro_init(&$App) {

    App::$theme_info['extends'] = 'redbasic';


}
