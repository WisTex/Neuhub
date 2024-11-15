<?php

/*
 * Neuhub Tab Theme - Configuration File
 * Author: Scott M. Stolz
 * License: MIT (Expat version) - https://license.neuhub.org
 * Copyright (c) 2022 WisTex TechSero Ltd. Co.
 * Source: https://neuhub.org/
 */

// ! Important Instructions:
// * Rename this file neuhub-config.php (or make a copy called neuhub-config.php) so it does not get overwritten by changes.

// ! Important Note:
// This is a standard configuration file for most Neuhub themes. 
// Different themes use this information in different ways. 
// Some themes don't use all of these variables.
// See the theme documentation for details.

// * Left Sidebar Icon Class and Title
// Only used in the Red Dash Theme.
// Icon can be any ForkAwesome icon or Hubzilla icon. 
// $SiteIcon = "icon-hz-64"; // Hubzilla Logo
$SiteIcon = "icon-hz-64";
$SidebarTitle = "Hubzilla";

// * Navigation Links

// Override the destination of the Home link. Affects breadcrumbs, footer, and sidebar links to Home.
// For content websites, this would typically called "Home" and link to your website's home page.
// For hubs without content pages, you can call it "Site" or "Hub" and link to "/" instead.
$ShowHomeLink = true;
$HomeURLName = "Home"; 
$HomeURL = "/";

// URL to your Terms of Service
// Shown in the footer in most themes.
$ShowTermsLink = true;
$TermsURLName = "Terms of Service";
$TermsURL = "/help/TermsOfService";

// URL to your Privacy Policy
// Shown in the footer in most themes.
// Some states require you to use the word "Privacy" so it is easier to find.
$ShowPrivacyLink = true;
$PrivacyURLName = "Privacy";
$PrivacyURL = "/help/TermsOfService";

// URL to Site Info (About the website and who administers it.)
// Fill out the site info and admin info fields on https://example.social/admin/site/ to update this page.
$ShowSiteInfo = true;
$SiteInfoURLName = "Site Info";
$SiteInfoURL = "/siteinfo";

// URL to Community Rules
// If you operate a public hub, you should establish some written community rules.
// You can either place it in the Terms of Service or create its own page.
// Change this to true and update the link if the rules has its own page.
$ShowCommunityRules = false;
$CommunityRulesURLName = "Community Rules";
$CommunityRulesURL = "/";

// URL to Information regarding who owns the website.
// Legally required in some countries, like Germany, Austria, and Switzerland.
// If you put the required information in the site information or administrator information fields on https://example.social/admin/site/
// you can link to /siteinfo here. Otherwise, you need to create a unique page and link to it.
$ShowImpressumLink = false;
$ImpressumURLName = "Impressum";
$ImpressumURL = "/siteinfo";

// Link to Abuse Contact Info page and/or DMCA Contact Info page
// If you are running a public hub, you should have some way for people to report issues.
// If you put the required information in the administrator information field on https://example.social/admin/site/
// you can link to /siteinfo here. Otherwise, you need to create a unique page and link to it.
$ShowAbuseLink = false;
$AbuseURLName = "Abuse / DMCA";
$AbuseURL = "/siteinfo";

// Link to Help
$ShowHelpLink = true;
$HelpURLName = "Help";
$HelpURL = "/help";

// Link to Directory
$ShowDirectoryLink = true;
$DirectoryURLName = "Directory";
$DirectoryURL = "/directory";

// * Social Media Links
// Website's Main Channel (usually the channel where you give announcements)
// Example: $WebsiteChannel = "/channel/blog";
$WebsiteChannel = "/";

// Other social media channels for the website.
// Some themes give you the option to display additional social media icons.
$SocialActivityPub = ""; // TODO: Need to find icon for ActivityPub.
$SocialMastodon = "";
$SocialFacebook = "";
$SocialLinkedIn = "";
$SocialTwitter = "";
$SocialYouTube = "";
$SocialDigitalAuthorship = ""; // TODO: Need to find icon for Digital Authorship.
$SocialInstagram = "";
$SocialGithub = "";
$SocialGitlab = "";
$SocialGit = "";
$SocialPatreon = "";
// TODO: Create a way for people to add their own.

// * Copyright Notice (for content on the website)
// Note: It should be the name of the person or company that owns the copyright, not the name of your website.
// $Copyright = "Copyright &copy; 2023 WisTex TechSero Ltd. Co. All rights reserved."; // example
// $Copyright = "Copyright &copy; 2023 <a href='https://wistex.com'>WisTex TechSero Ltd. Co.</a> All rights reserved."; // example
$Copyright = "Copyright &copy; All rights reserved.";
// Instead of a copyright notice, you can put any text you want here. 
// It will appear in the footer where the copyright notice normally would be.

// ? Site Name in Breadcrumbs?
// If true, the Site Name defined in the Site Admin section is used in the breadcrumbs.
// If false, it is replaced with: $SiteNameinBreadcrumbsText (HTML not permitted.)
// Used in the Red Dash theme.
$SiteNameinBreadcrumbs = true;
$SiteNameinBreadcrumbsText = "Home";
// Note: the default is to use the site name instead of "home" in the breadcrumbs to make it obvious to visitors which website they are on.
// This is useful for visitors since Hubzilla websites may look similar. It is also useful if you manage more than one hub.

// ? Site Name in Footer?
// If true, the Site Name defined in the Site Admin section is used in the footer.
// If false, it is replaced with: $SiteNameinFooterText (HTML permitted.)
// Used in the Red Dash theme.
$SiteNameinFooter = true;
$SiteNameinFooterText = "Neuhub";

// Show powered by Hubzilla and Neuhub in footer.
$PoweredBy = true;
// Show that this is an independent federated hub in footer.
$FederatedHub = true;

?>