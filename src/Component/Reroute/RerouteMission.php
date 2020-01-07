<?php namespace Zenit\Bundle\Mission\Module\Reroute;

use Symfony\Component\HttpFoundation\Request;

class RerouteMission extends \Zenit\Bundle\Mission\Component\Mission{
	public function run(){
		die(header('location:' . Request::createFromGlobals()->getScheme() . '://' . str_replace('{domain}', env('domain'), $this->config['reroute'])));
	}
}