<?php defined('SYSPATH') OR die('No direct script access.');

Route::set('auth-login-as', 'auth/login_as/<id>', array('id' => '[0-9]+'))
	->defaults(array(
		'controller' => 'auth',
		'action' => 'login_as',
	));

Route::set('auth', 'auth/<action>', array(
		'action' => 'login|logout|signup|remind|confirm|comeback'
	))
	->defaults(array(
		'controller' => 'auth',
	));
