<?php namespace Zenit\Bundle\Mission\Component\Web;

use Zenit\Bundle\Mission\Component\Mission;
use Zenit\Bundle\Mission\Component\Web\Routing\Router;
use Zenit\Bundle\Mission\Constant\RoutingEvent;
use Zenit\Core\Event\Component\EventManager;

abstract class WebMission extends Mission{

	/** @var Router */
	protected $router;

	public function __construct(Router $router){ $this->router = $router; }

	public function run(){
		EventManager::fire(RoutingEvent::BEFORE, $this->router);
		$this->route($this->router);
		EventManager::fire(RoutingEvent::FINISHED, $this->router);
		EventManager::fire(RoutingEvent::NOTFOUND, $this->router);
		die();
	}

	abstract public function route(Router $router);

}