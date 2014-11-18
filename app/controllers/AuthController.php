<?php

class AuthController extends BaseController
{
	public function getIndex()
	{
		try {
			return View::make('auth.index');		
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function getGoogleLogin($auth=NULL)
	{
		if ($auth == 'auth')
		{
			try 
			{
				Hybrid_Endpoint::process();
			}
			catch (Exception $e) 
			{
				return $e->getMessage();
			}
			return;
		}
		try {
			$oauth = new Hybrid_Auth(app_path().'/config/google_oauth.php');
			$provider = $oauth->authenticate('Google');
			$profile = $provider->getUserProfile();
			return var_dump($profile).'<a href="logout">Logout</a>';
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function getLoggedOut()
	{
		$gauth = new Hybrid_Auth(app_path().'/config/google_oauth.php');
		$gauth->logoutAllProviders();
		return Redirect::to('');
	}
}