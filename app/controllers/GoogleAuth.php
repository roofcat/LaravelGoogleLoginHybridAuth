<?php

class GoogleAuth 
{
	public $client;
	public $oauth2;
	public $calendar_service;
	public $miscalendarios;
	public $access_token;
	public $code;
	
	public function __construct(Google_Client $googleClient = null) 
	{
		$this->client = $googleClient;

		if ($this->client) 
		{
			$this->client->setClientId('217478432355-fkpsochrqnd6fr7mol6tpbhjld9g0m2d.apps.googleusercontent.com');
			$this->client->setClientSecret('vIHRsUy4rCiWb_lyoroq3zsu');
			$this->client->setRedirectUri('http://localhost:8080/gauth');
			$this->client->setScopes(array('https://www.googleapis.com/auth/userinfo.email',
									'https://www.googleapis.com/auth/userinfo.profile',
									'https://www.googleapis.com/auth/calendar'));
		
			$this->oauth2 = new Google_Service_Oauth2($this->client);
			//$this->calendar_service = new Google_CalendarService($this->client);
		}
	}

	public function isLoggedIn () 
	{
		return isset($this->access_token);
	}

	public function getUser()
	{
		return $this->oauth2->userinfo->get();
	}

	public function getAuthUrl () 
	{
		return $this->client->createAuthUrl();
	}

	public function checkRedirectCode ($code) 
	{
		if (isset($_GET['code']))
		{
			$this->client->authenticate($this->code);

			$this->setToken($this->client->getAccessToken());
			
			$user = $this->oauth2->userinfo->get();
			$this->storeUserInfo($user);
			//$calendario = $this->calendar_service->calendars->get('primary');
			//print "<h1>Mi calendario principal</h1><pre>" . print_r($calendario, true) . "</pre>";
			return true;
		}
		return false;
	}

	public function setToken ($token) 
	{
		$this->access_token = $token;

		$this->client->setAccessToken($token);
	}

	public function logout () 
	{
		unset($this->access_token);
	}
}