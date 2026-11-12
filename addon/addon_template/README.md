# Hubzilla Addon Template (development reference)

Copyright (c) 2026 WisTex TechSero Ltd. Co. — MIT Expat License.

This is **source-code documentation first**, not a user-facing showcase.
It uses Hubzilla's own addon lifecycle, route registration, Controller classes,
translation functions, and template engine.

## Install

Place this directory at `addon/addon_template/` in a Hubzilla installation
(or deploy the parent addon repository using your existing Hubzilla addon setup).
Enable **Addon Template** through Hubzilla's standard administrator addon interface.
No database migration or external service is required.

## Working examples

| URL | File | Technique |
| --- | --- | --- |
| `/addon_template` | `Mod_Addon_template.php` | Default GET page |
| `/addon_template/about` | `Mod_Addon_template.php` | Second page using path arguments |
| `/addon_template_help` | `Mod_Addon_template_help.php` | Independently registered module |

The shared HTML template is `view/tpl/example.tpl`.
The entry point `addon_template.php` registers/unregisters both modules.

## How to add a page

**Same module:** Add another path case to `Addon_template::get()`, then
provide a corresponding response or template. Use `argv()` to inspect the path.

**Independent module:** Create `Mod_Yourroute.php` containing a
`Zotlabs\\Module\\Yourroute` Controller; add matching `Route::register()`
and `Route::unregister()` calls in the entry point. Re-enable the addon
if needed to refresh registrations.

## Validation checklist

- PHP syntax checks for each PHP file
- Enable addon via Hubzilla administrator interface
- Open all three URLs and verify their links
- Confirm an unknown `/addon_template/...` page returns 404
- Disable addon and confirm routes are removed; re-enable and retest

**Status:** Initial implementation, not yet tested on a running Hubzilla site.
Additional examples (forms, permissions, settings, hooks, widgets) will be
added only after the core routing pattern has been validated.

## Attribution

When adapting this code, preserve copyright and MIT Expat License notices.
