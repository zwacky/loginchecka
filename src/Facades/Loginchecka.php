<?php namespace Zwacky\Loginchecka\Facades;

use Illuminate\Support\Facades\Facade;

class Loginchecka extends Facade {
	
	protected static function getFacadeAccessor()
	{
		return 'loginchecka';
	}
	
}
