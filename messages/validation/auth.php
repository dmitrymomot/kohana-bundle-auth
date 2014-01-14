<?php defined('SYSPATH') OR die('No direct script access.');

return array(

	'username' => array(
		'unique' => 'This username is already taken',
	),

	'email' => array(
		'unique' => 'User with this email already exists.',
	),

	'csrf' => array(
		'Security::check' => 'Security error',
	),

	'captcha' => array(
		'Captcha::valid' => 'You entered incorrect answer',
	),
);
