<?php

// This pulls the default config and styles from Redbasic.
// This allows your child theme to only specify changes. Anything undefined is pulled from Redbasic.
// No need to change these two lines unless you are completely rewriting the theme.
require_once('view/theme/redbasic/php/config.php');
require_once('view/theme/redbasic/php/style.php');

// ! If you change the name of the directory containing the theme, be sure to change this line to match.
// You can add CSS (or override the CSS in the Redbasic theme) by putting it in this file.
echo @file_get_contents('view/theme/neuhub-tab/css/style.css');
