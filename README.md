# Neuhub
**A collection of themes, widgets, modules, and addons for Hubzilla, Streams, and compatible distributions.**

We are starting with a two-column theme that is intended for "content & community" websites. Later, we will add additional widgets and addons that will provide additional functionality.

Your contributions and feedback are welcome.

## Components

- Neuhub Red Dash Theme
- Messages Module (substitute for Notifications)
- Example Addon
- Example Module
- Example Widget

## Themes

### Beta Versions

We are looking for beta testers for the following themes:

- **Neuhub Red Dash** 0.4 - A theme based on Redbasic and SB Admin.

## Neuhub Red Dash Release Notes

Known Issues
* PDL Editor navigation broken.
* Some remote resources not loading properly.
* Contains experimental code that will be removed in the release.

## Installation

Summary: 

- Copy all of the files except the README.md and LICENSE files to the web root of your Hubzilla or Streams installation.

Steps:
1. Upload the `neuhub-red-dash` folder to the `/view/theme/` folder.
2. Upload contents of the `/Zotlabs/SiteModule` folder to the `/Zotlabs/SiteModule` folder.
3. Upload contents of the `/addon` folder to the `/addon` folder.
4. Upload contents of the `/widget` folder to the `/widget` folder.
5. Enable the theme in your admin.
6. Assign as the default theme and/or as an individual channel's theme.

## Use Cases

I would like to make the new template as versatile as possible. We might eventually need to make multiple configurations because there are many distinct use cases, such as:

* **Solo Hubs** - The focus is on the channel, and every channel can have its own unique theme (like how you can customize the colors on redbasic). Similar to how redbasic works now.
* **Forum Websites** - Navigation is similar to a traditional forum, with multiple forum areas. You can easily view and switch between all of the forum channels on the same website. The focus is on the website and the fact that it has multiple forum channels.
* **Public Hubs** - Similar to solo hubs, but some additional navigation to the hub home page and other pages the hub operator wants to highlight. The public hub operator has more control over common navigation sitewide.
* **Multi-Author Blog** - Additional navigation for finding and navigating public content. Add pages and navigation that turn the site into a multi-author website, listing content from multiple channels on the main website.

I know a lot of this can be accomplished via the PDL Editor, but having pre-configured themes for each use case would make things easier for site owners. Ideally, we will just make one theme that adapts based on certain configuration settings.

## Objectives

Some of the things I want to work on are:

* Usability for non-techy users.
* Responsive design that works well on both mobile and desktop.
* Social media posts look like social media posts.
* Forum posts look like forum posts
* Articles look like blog posts.
* Navigation according to each use case above.
* Design it so that the PDL Editor and Apps still work as intended.
* It is compatible with Bootstrap code examples (containers, grids, panels, cards, etc.).

## Collaboration 

If you have any suggestions or want to contribute code, that would be appreciated.

## Credits

Special thanks to all of the people before me that created awesome code and made it available. The themes in this repository would not be possible without their hard work, and the themes here use some of their code or are inspired by their code. Hopefully I did not miss anyone.

### Redbasic Theme (used in Hubzilla, Streams, Zap, <i>et. al.</i>)

- Hubzilla Website: https://hubzilla.org/
- Hubzilla Repository: https://framagit.org/hubzilla/core
- Streams Repository: https://codeberg.org/streams/streams
- Zot Repository: https://codeberg.org/zot

Main Redbasic Contributors

- Fabrixxm
- Mike Macgirvin
- Mario Vavti

### DeadSuperHero Hubzilla Themes

Repository: https://github.com/DeadSuperHero/hubzilla-themes

- Sean Tilley
- Andrew Manning

### Third Party Tools

- IcoMoon - https://icomoon.io/ - For making it easy to create the Hubzilla font.
- Convertio -  https://convertio.co/png-svg/ - For converting PNG to SVG so I can create the Hubzilla font.
