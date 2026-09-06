<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class : Casdoor_client
 * Minimal OAuth2/OIDC authorization-code-flow client for the Casdoor SSO engine.
 * Written by hand (cURL + http_build_query) instead of pulling a Composer OAuth2
 * library, since this app is stuck on PHP 5.6 / CodeIgniter 3.
 */
class Casdoor_client
{
	protected $config;

	public function __construct()
	{
		$ci = &get_instance();
		$ci->config->load('casdoor');
		$this->config = $ci->config->item('casdoor');
	}

	public function get_authorize_url($state)
	{
		$params = array(
			'client_id'     => $this->config['client_id'],
			'response_type' => 'code',
			'redirect_uri'  => $this->config['redirect_uri'],
			'scope'         => $this->config['scope'],
			'state'         => $state,
		);

		return $this->config['endpoint'] . '/login/oauth/authorize?' . http_build_query($params);
	}

	/**
	 * Exchanges an authorization code for an access token.
	 * Returns the decoded token response, or NULL on failure.
	 */
	public function exchange_code_for_token($code)
	{
		$payload = array(
			'grant_type'    => 'authorization_code',
			'client_id'     => $this->config['client_id'],
			'client_secret' => $this->config['client_secret'],
			'code'          => $code,
			'redirect_uri'  => $this->config['redirect_uri'],
		);

		$response = $this->_post($this->config['endpoint'] . '/api/login/oauth/access_token', $payload);

		return (isset($response['access_token'])) ? $response : NULL;
	}

	/**
	 * Fetches the OIDC userinfo claims (sub, email, name, ...) for an access token.
	 * Returns the decoded claims, or NULL on failure.
	 */
	public function get_userinfo($access_token)
	{
		$ch = curl_init($this->config['endpoint'] . '/api/userinfo');

		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_HTTPHEADER     => array('Authorization: Bearer ' . $access_token),
			CURLOPT_TIMEOUT        => 10,
		));

		$body   = curl_exec($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		if ($status !== 200 || $body === FALSE)
		{
			return NULL;
		}

		return json_decode($body, TRUE);
	}

	protected function _post($url, $payload)
	{
		$ch = curl_init($url);

		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_POST           => TRUE,
			CURLOPT_POSTFIELDS     => http_build_query($payload),
			CURLOPT_TIMEOUT        => 10,
		));

		$body   = curl_exec($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		if ($body === FALSE)
		{
			return NULL;
		}

		$decoded = json_decode($body, TRUE);

		return ($status === 200) ? $decoded : NULL;
	}
}
