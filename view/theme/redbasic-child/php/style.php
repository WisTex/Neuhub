<?php

require_once('view/theme/redbasic/php/config.php');
require_once('view/theme/redbasic/php/style.php');

// If you change the name of the directory containing the theme, be sure to change this line to match.
echo @file_get_contents('view/theme/redbasic-child/css/style.css');
