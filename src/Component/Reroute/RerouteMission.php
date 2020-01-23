<?php namespace Zenit\Bundle\Mission\Component\Reroute;

use Symfony\Component\HttpFoundation\Request;

class RerouteMission extends \Zenit\Bundle\Mission\Component\Mission{
	public function run(){
		die(header('location:' . Request::createFromGlobals()->getScheme() . '://' . $this->config['reroute']));
	}
}