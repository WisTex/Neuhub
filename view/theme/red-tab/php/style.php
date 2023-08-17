<?php

// This pulls the default config and styles from Redbasic.
// This allows your child theme to only specify changes. Anything undefined is pulled from Redbasic.
// No need to change these two lines unless you are completely rewriting the theme.
require_once('view/theme/redbasic/php/config.php');
require_once('view/theme/redbasic/php/style.php');

// ! If you change the name of the directory containing the theme, be sure to change this line to match.
echo @file_get_contents('view/theme/red-tabler/css/style.css');
