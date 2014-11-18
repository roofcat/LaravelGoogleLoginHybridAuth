<?php

return array(
	"base_url" => "http://laravel.me/index.php/gauth/auth",
	"providers" => array(
		"Google" => array(
			"enabled" => true,
			"keys" => array( 
				"id" => "636441428984-hnjfcj6adm7s739mbjg0m8g3ntknq2ng.apps.googleusercontent.com", 
				"secret" => "W_1NTTI64idyMltqIaPlQbBb" ),
			"scope" => "https://www.googleapis.com/auth/userinfo.email ".
						"https://www.googleapis.com/auth/userinfo.profile ".
						"https://www.googleapis.com/auth/calendar "
	)));