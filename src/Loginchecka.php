<?php namespace Zwacky\Loginchecka;

use Config;
use Auth;
use Zwacky\Loginchecka\Models\User;
use Zwacky\Loginchecka\ConfigUserProvider;

class Loginchecka {

	public static $CONFIG_LOGINS = 'loginchecka::config_driver.valid_logins';
	public static $CONFIG_IDENTIFIER = 'loginchecka::config_driver.identifier';

	private static $extended = false;

	/**
	 * adds the config auth driver by using ConfigUserProvider.
	 */
	public static function extendConfigAuthDriver()
	{
		if (!Loginchecka::$extended) {
			Auth::extend('config', function($app) {
				$provider = new ConfigUserProvider;
				return new \Illuminate\Auth\Guard($provider, $app['session.store']);
			});
			Loginchecka::$extended = true;
		}
	}

}