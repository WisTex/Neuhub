<?php

// Add your custom CSS files here.
head_add_css('/library/fork-awesome/css/fork-awesome.min.css');
// head_add_css('/vendor/twbs/bootstrap/dist/css/bootstrap.min.css'); // Tabler already uses Bootstrap, so this would conflict with it.
head_add_css('/library/bootstrap-tagsinput/bootstrap-tagsinput.css');
head_add_css('/view/css/bootstrap-red.css');
head_add_css('/library/datetimepicker/jquery.datetimepicker.css');
head_add_css('/library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css');
head_add_css('/view/css/default.css');

require_once('view/php/theme_init.php');

// Add your custom JS files here.
// head_add_js('/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js'); // Tabler already uses Bootstrap, so this would conflict with it.
head_add_js('/library/bootbox/bootbox.min.js');
head_add_js('/library/bootstrap-tagsinput/bootstrap-tagsinput.js');
head_add_js('/library/datetimepicker/jquery.datetimepicker.js');
head_add_js('/library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js');
head_add_js('/view/theme/redbasic/js/redbasic.js');
