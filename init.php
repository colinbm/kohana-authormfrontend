<?php

Route::set('authormfrontend_login', 'login(/<redirect_path>)')
	->defaults(array(
		'controller' => 'authormfrontend',
		'action'     => 'login',
		'redirect_path' => null,
));

Route::set('authormfrontend_logout', 'logout')
	->defaults(array(
		'controller' => 'authormfrontend',
		'action'     => 'logout',
));

Route::set('authormfrontend_profile', 'profile')
	->defaults(array(
		'controller' => 'authormfrontend',
		'action'     => 'profile',
));

Route::set('authormfrontend_register', 'register')
	->defaults(array(
		'controller' => 'authormfrontend',
		'action'     => 'register',
));
