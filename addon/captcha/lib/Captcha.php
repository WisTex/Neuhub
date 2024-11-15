<?php

// Captcha Addon Settings and Utility Functions
// Supports the addition of reCAPTCHA, etc., in the future
class Captcha {
	const _ENABLED = [
		'login' => true,
		'register' => true
	];
	const _TYPE = 'hcaptcha';
	const _CONFIG = [
		'hcaptcha' => [
			'endpoint' => 'https://api.hcaptcha.com/siteverify',
			'tokenIndex' => 'h-captcha-response',
			'sitekey' => '606111c0-15f1-4a55-a5e2-cc1dbe184c53',
			'secret' => 'ES_b5058ad768064b4281e03ced65e2bc48'
		],
		'recaptcha' => [
			'endpoint' => 'https://www.google.com/recaptcha/api/siteverify',
			'tokenIndex' => 'g-recaptcha-response',
			'sitekey' => '',
			'secret' => ''			
		]
	];
	const _INSERTION_PATTERN = '/<button.*?type="submit"/s';

	public static function UpdateFormMarkup(string $markup): string {
		$captchaMarkup = replace_macros(get_markup_template(self::_TYPE . '.tpl', 'addon/captcha'), [
			'$sitekey' => self::_CONFIG[self::_TYPE]['sitekey']
		]);
		return preg_replace(self::_INSERTION_PATTERN, $captchaMarkup . "$0", $markup);
	}

	public static function Authenticate(array $post): bool {
		$data = array(
			'secret' => self::_CONFIG[self::_TYPE]['secret'],
			'response' => $post[self::_CONFIG[self::_TYPE]['tokenIndex']] ?? '',
			'sitekey' => self::_CONFIG[self::_TYPE]['sitekey']
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::_CONFIG[self::_TYPE]['endpoint']);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		//die(print_r($response));
		$authSuccess = false;
		if (curl_errno($ch) == 0 && (int)curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200 && !empty($response)) {
			$responseData = json_decode($response, true);
			$authSuccess = isset($responseData['success']) && (bool)$responseData['success'];
		}
		return $authSuccess;
	}
}