<?php

use Zwacky\Loginchecka\Loginchecka;

class LogincheckaTest extends Orchestra\Testbench\TestCase {

	public function setUp()
	{
		parent::setUp();
	}

	public function tearDown()
	{
		parent::tearDown();
	}

	public function testCheckConfig()
	{
		$username = 'admin';
		$password = 'basicpassword';
		$auth = $this->app['auth'];
		$testLogins = array(
			array('username' => $username, 'password' => $password, 'shouldReturn' => true),
			array('username' => '', 'password' => '', 'shouldReturn' => false),
			array('username' => $username, 'password' => $password . 'noise', 'shouldReturn' => false),
		);

		Loginchecka::extendConfigAuthDriver();
		Config::set('auth.driver', 'config');
		Config::set(Loginchecka::$CONFIG_IDENTIFIER, 'username');
		Config::set(Loginchecka::$CONFIG_LOGINS, array(
			array('username' => $username, 'password' => $password)
		));
		
		foreach ($testLogins as $test) {
			$res = $auth->attempt(array('username' => $test['username'], 'password' => $test['password']));
			$this->assertEquals($res, $test['shouldReturn']);
		}
	}

}
