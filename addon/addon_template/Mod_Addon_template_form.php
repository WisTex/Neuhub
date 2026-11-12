<?php
/**
 * Addon Template: HTML form, POST handling, CSRF validation, and identity settings.
 *
 * URL: /addon_template_form
 * Copyright (c) 2026 WisTex TechSero Ltd. Co.
 * SPDX-License-Identifier: MIT
 * License: MIT Expat License
 *
 * Hubzilla's router calls get() for GET requests and post() for POST requests.
 * Both methods are inherited from Zotlabs\Web\Controller. The class name must
 * match the registered route (Addon_template_form -> addon_template_form).
 */
namespace Zotlabs\Module;

use App;
use Zotlabs\Web\Controller;

class Addon_template_form extends Controller {
    // The same identifier must be passed when creating and checking the token.
    // It keeps tokens for unrelated forms from being interchangeable.
    private const FORM_ID = 'addon_template_form';

    public function post() {
        // Enforce the same authentication requirement used by get().
        // Never rely on hiding a form to prevent unauthorized POST requests.
        // App::get_observer() returns an xchan identity record for a locally
        // or remotely authenticated visitor, or no record for anonymous access.
        $observer = App::get_observer();
        $observer_hash = $observer['xchan_hash'] ?? '';
        if (!$observer_hash) {
            notice(t('You must be authenticated to save this preference.') . EOL);
            goaway(z_root() . '/addon_template_form');
            return;
        }

        // Native CSRF protection:
        // check_form_security_token($typename, $formname = 'form_security_token')
        // returns true when the submitted token matches the current session
        // and form type, and has not expired (currently three hours).
        // Unlike the redirecting variant, this lets us control the response.
        if (!check_form_security_token(self::FORM_ID)) {
            notice(check_form_security_std_err_msg());
            goaway(z_root() . '/addon_template_form');
            return;
        }

        // PHP receives form fields in $_POST. Validate before saving.
        // This example stores a short plain-text preference, not arbitrary HTML.
        $message = trim((string) ($_POST['example_message'] ?? ''));
        if (mb_strlen($message) > 120) {
            notice(t('Please enter no more than 120 characters.') . EOL);
            goaway(z_root() . '/addon_template_form');
            return;
        }

        // set_xconfig($xchan_hash, $family, $key, $value) stores a
        // preference for this network identity on THIS hub. A network identity
        // generally identifies a channel, not necessarily an entire human
        // account; multiple channels can have distinct xchan_hash values.
        // The 'addon_template' family namespaces our keys.
        set_xconfig($observer_hash, 'addon_template', 'example_message', $message);
        info(t('Your example preference was saved on this hub.') . EOL);

        // Post/Redirect/Get: refreshing the resulting page will not repeat POST.
        goaway(z_root() . '/addon_template_form');
    }

    public function get() {
        $observer = App::get_observer();
        $observer_hash = $observer['xchan_hash'] ?? '';
        // The page itself remains accessible anonymously, but its form does
        // not. The POST handler independently enforces this same requirement.
        if (!$observer_hash) {
            return replace_macros(
                get_markup_template('form_unavailable.tpl', 'addon/addon_template'),
                [
                    '$title' => t('Form and identity configuration example'),
                    '$message' => t('Sign on with a Hubzilla identity to edit and save your preference.'),
                    '$home_url' => z_root() . '/addon_template',
                    '$home_label' => t('Back to addon template')
                ]
            );
        }

        // get_xconfig($xchan_hash, $family, $key, $default = false)
        // retrieves a previously saved identity-scoped value from this hub.
        $saved = (string) get_xconfig($observer_hash, 'addon_template', 'example_message', '');

        // get_form_security_token($typename = '') generates a form-specific
        // CSRF token. The HTML field must be named form_security_token,
        // matching check_form_security_token()'s default $formname argument.
        $token = get_form_security_token(self::FORM_ID);

        // Hubzilla's template engine inserts variables named $title, etc.
        // Escape user-controlled values before inserting into HTML attributes.
        return replace_macros(
            get_markup_template('form.tpl', 'addon/addon_template'),
            [
                '$title' => t('Form and identity configuration example'),
                '$description' => t('Edit a short preference associated with your authenticated network identity on this hub.'),
                '$action_url' => z_root() . '/addon_template_form',
                '$token' => htmlspecialchars($token, ENT_QUOTES, 'UTF-8'),
                '$value' => htmlspecialchars($saved, ENT_QUOTES, 'UTF-8'),
                '$field_label' => t('Example preference'),
                '$submit_label' => t('Save example'),
                '$home_url' => z_root() . '/addon_template',
                '$home_label' => t('Back to addon template')
            ]
        );
    }
}
