# Neuhub Example Code & Experiments

### Build your own website, community, and audience without giving up control.

* By Federated Works https://federated.works
* Project home page: https://neuhub.org
* Extends Hubzilla https://hubzilla.org
* Sponsored by WisTex TechSero Ltd. Co. https://wistex.com

## This Repository

This repository contains example code and experiments that you can use to build your own Hubzilla Themes, Addons, and Widgets.

Most of the code here would need to be modifed to be useful. 

If you want code ready to deploy, visit the deployment repositories instead. That is where most of the development happens.

## Deployment Repositories

Code that is released resides in a trio of repositories:

* https://framagit.org/federated-works/neuhub/hubzilla-themes
* https://framagit.org/federated-works/neuhub/hubzilla-addons
* https://framagit.org/federated-works/neuhub/hubzilla-widgets

Typically, Neuhub themes require certain addons and widgets, which means you would install all three.

You can add Neuhub themes, addons, and widgets by executing the following commands. 
```
util/add_theme_repo https://framagit.org/federated-works/neuhub/hubzilla-themes.git neuhubthemes
util/add_addon_repo https://framagit.org/federated-works/neuhub/hubzilla-addons.git neuhubaddons
util/add_widget_repo https://framagit.org/federated-works/neuhub/hubzilla-widgets.git neuhubwidgets
```
See the Hubzilla INSTALL.txt file for more details. (More thorough instructions will be added here later.)