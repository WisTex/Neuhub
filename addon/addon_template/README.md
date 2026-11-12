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
| `/addon_template_form` | `Mod_Addon_template_form.php` | GET/POST, CSRF validation, and network-identity configuration (**implemented; not yet live-tested**) |

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
- Open the three original URLs and verify their links
- Open `/addon_template_form`, verify the form is hidden for anonymous visitors, submit as an
  authenticated visitor, confirm persistence after refresh, and verify
  unauthenticated POST requests and invalid CSRF tokens are rejected
- Confirm an unknown `/addon_template/...` page returns 404
- Disable addon and confirm routes are removed; re-enable and retest

## Live installation verification

**Verified by the site operator on November 12, 2026**, on a new Hubzilla
installation at https://wistex.team/:

- `/addon_template` — primary module renders correctly.
- `/addon_template/about` — second page within the same module works.
- `/addon_template_help` — separately registered module works.

The site operator confirmed that all three URLs work. This is a real
installation test of the initial routing and template examples, not a claim
that all possible installations, configurations, or future features have
been tested. The unknown-path 404 and addon-disable behavior have not
yet been reported as tested.

The form example is **implemented but not yet live-tested**. Its template is
`view/tpl/form.tpl`. It uses Hubzilla's `get_form_security_token()` and
`check_form_security_token()` for CSRF protection, `App::get_observer()` to
identify either a locally or remotely authenticated visitor, and
`get_xconfig()` / `set_xconfig()` for network-identity-scoped preferences.
Anonymous visitors see an explanation instead of a form. The POST handler
also independently rejects unauthenticated submissions before checking the
CSRF token or saving data. The explanatory template is
`view/tpl/form_unavailable.tpl`. The saved setting is
local to the hub and does not automatically follow the identity elsewhere.

Remaining examples (additional permissions, site configuration, hooks, widgets)
are planned but **not implemented or verified**.

## Documentation and commenting standard for future examples

**Audience:** A developer who knows basic PHP and web development but has
never developed for Hubzilla. Code must be understandable without prior
knowledge of Hubzilla's addon architecture.

For every new example:

1. Start the source file with its purpose, copyright, and explicit MIT
   Expat License reference.
2. Explain where Hubzilla discovers or calls the file, function, or class.
   For hooks, identify the event and explain what Hubzilla passes to the
   callback. For routes, show the URL that triggers the module.
3. Explain unfamiliar Hubzilla functions and conventions **at the point
   of use**, including what they return or change and why they are needed.
   Distinguish native Hubzilla behavior from code supplied by this addon.
4. Explain request flow (GET, POST, validation, permissions, rendering)
   and any non-obvious security or data-handling decisions.
5. Show how to copy or adapt the example, including other files or
   registrations that must change. Document how to reverse registrations.
6. Prefer short, readable, directly usable examples over unnecessary
   helper layers. Comments should explain intent and platform behavior,
   not simply restate PHP syntax.
7. Add each example to the README index and label its validation status:
   **implemented**, **syntax-checked**, or **live-tested**, as applicable.
   Do not claim live testing until it has actually been performed.

When a Hubzilla API or lifecycle behavior is uncertain, verify it against
the relevant Hubzilla implementation rather than presenting a guess as fact.

## Attribution

When adapting this code, preserve copyright and MIT Expat License notices.

## Practical feature: dashboard greeting

The `/addon_template_form` page demonstrates a complete user-facing feature:
a signed-on visitor sees their previously saved greeting (or a friendly empty
state), edits it in a prefilled Bootstrap form, saves with CSRF protection,
and sees the updated greeting after redirect. Saving a blank value clears it.
Anonymous visitors see an explanation instead of a nonfunctional form;
unauthenticated POSTs are rejected independently.

To adapt the feature, change `CONFIG_FAMILY` and `CONFIG_KEY` in
`Mod_Addon_template_form.php`, and customize the form labels, field name,
validation, and display template together. The same key is used for reads and
writes. The greeting is stored by network identity in this hub's `xconfig`;
this is not a shared preference across every channel owned by one person.

**Validation:** implemented in the development branch; live behavior still
needs testing, including create, edit, clear, anonymous access, and invalid POST.
