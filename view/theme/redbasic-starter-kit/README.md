# Redbasic Starter Kit

This is a deriviative theme for Redbasic that you can use as a starting point for creating your own themes.

You can override various part of the Redbasic theme simply by creating a new file with the name of the file you want to override.

For example, if you want to change the navigation bar at the top of the page, you would create a file called `navbar_default.tpl` and put it in the `tpl` directory. This will override the `navbar_default.tpl` located in the `/view/tpl` directory. 

I recommend copying the original file and modifying it, but you can start from scratch if you want.

## Getting Started

1. Make of a copy of this theme and rename the `redbasic-starter-kit` directory to the name of your new theme.
2. Change the details in `theme.php` .
3. Test the new theme by uploading it to the `/view/themes` directory of your Hubzilla installation. Use Git or upload by FTP or use cPanel File Manager.

Testing is optional, but if you have never installed a derivative theme before, this will tell you if you installed it in the right place and gives you a good starting point to work from.

## Modifying the Theme

Whatever you place in each folder overrides the default file. You can also add additional files.

- **Layout**: Files in `/php` override files in `/view/php` and in the Redbasic theme.
- **Templates**: Files in `/tpl` override files in `/view/tpl` and in the Redbasic theme.

- **CSS**: Files in `/css` override files in `/view/css` and in the Redbasic theme.
- **Javascript**: Files in `/js` override files in `/view/js` and in the Redbasic theme.
- **Images**: Add your own images here.

## Finishing Touches

1. Update `screenshot.png` with a screenshot of your new theme.
2. Update `theme.php` again if you want to give it a new version number.

## Notes

Version 1.0 of this theme does not work with Schemes yet. 