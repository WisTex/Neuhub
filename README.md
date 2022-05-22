# Neuhub Bootstrap Hubzilla Themes
**A collection of Hubzilla themes and templates.**

We are in the process of creating some new themes for Hubzilla and are designing them with different types websites in mind. Everything in this repository is currently a work in progress. 

Items that have been tested and working are listed below. Everything else is experimental.

Your contributions are welcome.

## Themes

### Live

These have been tested and are working:

- **Redbasic Derivative Starter Kit** 1.0 - A Starting point for creating your own theme.
  - https://github.com/WisTex/CHG-Hubzilla-Themes/tree/main/view/theme/redbasic-starter-kit

### Unfinished

These are currently under development and are not fully functional.

- **Purplebasic** 0.2 - Where I am experimenting with features.
  - https://github.com/WisTex/Neuhub/tree/main/view/theme/purplebasic
  - DEVELOPMENT VERSION - NOT FOR PRODUCTION
  - Important Notes
    - Most features for remotely authenticated users work.
    - Some features for local users do not work yet.
  - Known Issues
    - Notifications not working on mobile
    - Navigation broken in Firefox
    - PDL Editor navigation broken
    - Some Javascript resources not loading properly.
    - Contains experimental code that will be removed in the release.
    - Documentation not complete, incorrect documentation as placeholders.

- **Other Versions**
  - Not working at all. Still setting up initial configuration.
  - Theme and directory names may be renamed as well.

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
