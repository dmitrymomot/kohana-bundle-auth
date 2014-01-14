<?php defined('SYSPATH') OR die('No direct access allowed.');

return array(

	'driver'       	=> 'ORM',
	'hash_method'  	=> 'sha256',
	'hash_key'     	=> 'b3154acf3a344170077d11bdb5f',
	'lifetime'     	=> 1209600,
	'session_type' 	=> Session::$default,
	'session_key'  	=> 'auth_user',

	'template'  	=> 'auth/index',
	'captcha'  		=> 'math', // captcha type or FALSE
);
