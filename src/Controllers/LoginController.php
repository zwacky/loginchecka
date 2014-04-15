<?php namespace Zwacky\Loginchecka\Controllers;

use Controller;
use View;
use Config;
use Input;
use Redirect;
use Auth;

class LoginController extends Controller {
	
	private $loginUrl = '';

	public function __construct()
	{
		$this->loginUrl = Config::get('loginchecka::urls.login');
	}

	public function getLogin()
	{
		$title = Config::get('loginchecka::title');
        return View::make('loginchecka::login')
        	->with(array('title' => $title));
	}

	public function postLogin()
	{
		$errors = array();
		$user = Input::get('user');
		$pass = Input::get('password');
		$identifier = Config::get('loginchecka::config_driver.identifier');

		$checks = array(
			'empty_check' => array(
				'check' => empty($user) || empty($pass),
				'error' => 'User and password can\'t be empty.'
			),
			'login_check' => array(
				'check' => !Auth::attempt(array($identifier => $user, 'password' => $pass), true),
				'error' => 'User and password don\'t match'
			),
		);

		foreach ($checks as $checkKey => $checkVal) {
			if ($checkVal['check']) {
				$errors[] = array($checkKey => $checkVal['error']);
				break;
			}
		}

		if (count($errors) == 0) {
			return Redirect::intended($this->loginUrl);
		}

		return Redirect::to($this->loginUrl)
			->withErrors($errors)
			->withInput(Input::except('password'));
	}

	public function getLogout()
	{
		Auth::logout();
		
		// TODO change to config
		return Redirect::to('/login');
	}
}