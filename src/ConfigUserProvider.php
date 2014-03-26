<?php namespace Zwacky\Loginchecka;

use Config;
use Illuminate\Auth\GenericUser;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserProviderInterface;

class ConfigUserProvider implements UserProviderInterface {
	
	private $identifier;

	public function __construct()
	{
		$this->identifier = (Config::get(Loginchecka::$CONFIG_IDENTIFIER));
	}

	/**
	 * Retrieve a user by their unique identifier.
	 * 
	 * @param mixed $identifier
	 * @param \Illuminate\Auth\UserInterface|null
	 */
	public function retrieveByID($identifier)
	{
		foreach ($this->getLoginPool() as $login) {
			if ($login[$this->identifier] == $identifier) {
				return new GenericUser($login);
			}
		}
		return null;
	}

	/**
	 * Retrieve a user by the given credentials.
	 * 
	 * @param array $credentials
	 * @return \Illuminate\Auth\UserInterface|null
	 */
	public function retrieveByCredentials(array $credentials)
	{
		$login = $this->findLoginById($credentials[$this->identifier]);
		if ($login) {
			return new GenericUser($login);
		}
		return null;
	}

	/**
	 * Validate a user against the given credentials.
	 * 
	 * @param \Illuminate\Auth\UserInterface $user
	 * @param array $credentials
	 * @return bool
	 */
	public function validateCredentials(\Illuminate\Auth\UserInterface $user, array $credentials)
	{
		return ($user->{$this->identifier} == $credentials[$this->identifier] &&
			$user->password == $credentials['password']);

		dd($user);
		foreach ($this->getLoginPool() as $login) {
			
			foreach ($credentials as $credential) {
				if ($login[$this->identifier] == $credential[$this->identifier] && $login['password'] == $credentials['password']) {
					return true;
				}
			}
		}
		
		return false;
	}

	/**
	 * returns the login pool of provided accounts in the config.
	 *
	 * @return array
	 */
	private function getLoginPool()
	{
		return (Config::get(Loginchecka::$CONFIG_LOGINS)) ? Config::get(Loginchecka::$CONFIG_LOGINS) : array();
	}

	/**
	 * searches within the login pool for specific login according to the identifier.
	 *
	 * @param mixed $identifier
	 * @return array
	 */
	private function findLoginById($identifier)
	{
		foreach ($this->getLoginPool() as $key => $login) {
			if ($login[$this->identifier] == $identifier) {
				return array_add($login, 'id', $key);
			}
		}
		return array();
	}
}