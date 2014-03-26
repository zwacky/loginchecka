<?php

return array(

	/**
	 * appears on top of the login view.
	 */
	'title' => 'Loginchecka',

	'urls' => array(

		/**
		 * route of loginchecka's use.
		 */
		'login' => '/login'

	),

	'config_driver' => array(
		
		/**
		 * pool of valid logins.
		 */
		'valid_logins' => array(
			array('username' => 'admin', 'password' => 'basicpassword')
		),

		/**
		 * what identifier field to take use for validation.
		 */
		'identifier' => 'username'

	),

);