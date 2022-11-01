<?php

// Boostrap CSS
head_add_css('/vendor/twbs/bootstrap/dist/css/bootstrap.min.css');
head_add_css('/view/theme/neuhub-red-dash/assets/bootstrap/css/bootstrap.min.css');

head_add_css('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i');

// Neuhub uses Font Awesome instead of Fork Awesome.
// head_add_css('/library/fork-awesome/css/fork-awesome.min.css');
head_add_css('/view/theme/neuhub-red-dash/assets/fonts/fontawesome-all.min.css');
head_add_css('/view/theme/neuhub-red-dash/assets/fonts/font-awesome.min.css');
head_add_css('/view/theme/neuhub-red-dash/assets/fonts/fontawesome5-overrides.min.css');
head_add_css('/view/theme/neuhub-red-dash/assets/fonts/fa5/css/all.css');


// A font that includes Hubzilla logos and icons.
head_add_css('/view/theme/neuhub-red-dash/assets/fonts/hubzilla/style.css');

// CSS
head_add_css('/library/bootstrap-tagsinput/bootstrap-tagsinput.css');
head_add_css('/view/css/bootstrap-red.css');
head_add_css('/library/datetimepicker/jquery.datetimepicker.css');
head_add_css('/library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css');

require_once('view/php/theme_init.php');

// Boostrap Javascript
head_add_js('/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js');
// head_add_js('/view/theme/neuhub-red-dash/assets/bootstrap/js/bootstrap.min.js');

// Other Javascript
head_add_js('/library/bootbox/bootbox.min.js');
head_add_js('/library/bootstrap-tagsinput/bootstrap-tagsinput.js');
head_add_js('/library/datetimepicker/jquery.datetimepicker.js');
head_add_js('/library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js');
// head_add_js('/view/theme/neuhub-red-dash/js/popper.min.js');
// head_add_js('/view/theme/redbasic/js/redbasic.js');

