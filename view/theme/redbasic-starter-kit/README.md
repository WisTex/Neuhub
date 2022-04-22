# Redbasic Derivative Starter Kit

This is a derivative theme for Redbasic that you can use as a starting point for creating your own themes.

You can override various parts of the Redbasic theme simply by creating a new file with the name of the file you want to override.

For example, if you want to change the navigation bar at the top of the page, you would create a file called `navbar_default.tpl` and put it in the `tpl` directory. This will override the `navbar_default.tpl` located in the `/view/tpl` directory. 

I recommend copying the original file and modifying it, but you can start from scratch if you want.

## Getting Started

1. Make a copy of this theme and rename the `redbasic-starter-kit` directory to the name of your new theme.
2. Change the details in `theme.php`.
3. Test the new theme by uploading it to the `/view/theme` directory of your Hubzilla installation. Use Git or upload by FTP or use cPanel File Manager.

Afetr uploading, your theme should be located at: `/view/theme/whatever-you-named-the-directory/`

Testing is optional, but if you have never installed a derivative theme before, this will tell you if you installed it in the right place and gives you a good starting point to work from.

## Modifying the Theme

Whatever you place in each folder overrides the default file. You can also add additional files.

If you are just making minor changes, then editing the `tpl` and `css` files would probably work well. But if you are changing the basic structure and layout, then you will probably need to copy `/view/php/default.php` to `/view/theme/your-theme-name/php/default.php` and then make your changes there. You can also create new layouts by creating your own php file in `/view/theme/your-theme-name/php/` and then use the PDL Editor in Hubzilla to select it.

- **Layout**: Files in the `php` directory override files in `/view/php` and in the Redbasic theme.
- **Templates**: Files in the `tpl` directory override files in `/view/tpl` and in the Redbasic theme.

- **CSS**: Files in the `css` directory override files in `/view/css` and in the Redbasic theme.
- **Javascript**: Files in the `js` directory override files in `/view/js` and in the Redbasic theme.
- **Images**: Add your own images here.

## Finishing Touches

1. Update `screenshot.png` with a screenshot of your new theme.
2. Update `theme.php` again if you want to give it a new version number.
3. Change the `README.md` file if you plan on sharing this with others.
4. Upload your changes to your website via Git, FTP, or cPanel File Manager.

## Notes

Version 1.0 of this theme does not work with Schemes yet. 

## Credits

I studied the themes from https://github.com/DeadSuperHero/hubzilla-themes and used their structure as a model. 

And, of course, this theme references code from the Redbasic theme located at: https://framagit.org/hubzilla/core
