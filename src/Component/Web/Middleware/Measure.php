<?php namespace Zenit\Bundle\Mission\Module\Web\Middleware;

use Zenit\Bundle\Mission\Module\Web\Pipeline\Middleware;

class Measure extends Middleware {

	public function run(){
		$time = microtime(1);
		$this->next();
		dump('runtime: '.(microtime(1)-$time));
	}

}