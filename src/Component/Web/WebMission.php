<?php namespace Zenit\Bundle\Mission\Component\Web;

use Zenit\Bundle\Mission\Component\Mission;
use Zenit\Bundle\Mission\Module\Web\Routing\Router;
use Zenit\Core\Event\Component\EventManager;

abstract class WebMission extends Mission{

	const EVENT_ROUTING_BEFORE = 'EVENT_ROUTING_BEFORE';
	const EVENT_ROUTING_FINISHED = 'EVENT_ROUTING_FINISHED';
	const EVENT_ROUTING_NOTFOUND = 'EVENT_ROUTING_NOTFOUND';

	/** @var Router */
	protected $router;

	public function __construct(Router $router){ $this->router = $router; }

	public function run(){
		EventManager::fire(self::EVENT_ROUTING_BEFORE, $this->router);
		$this->route($this->router);
		EventManager::fire(self::EVENT_ROUTING_FINISHED, $this->router);
		EventManager::fire(self::EVENT_ROUTING_NOTFOUND, $this->router);
		die();
	}

	abstract public function route(Router $router);

}