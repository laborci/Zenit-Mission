<?php namespace Zenit\Bundle\Mission\Component\Cli;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Zenit\Bundle\Mission\Constant\CliEvent;
use Zenit\Core\Event\Component\EventManager;
use Zenit\Core\Module\Interfaces\ModuleInterface;
use Zenit\Core\ServiceManager\Interfaces\SelfFactoryService;

abstract class CliModule extends Command implements ModuleInterface, SelfFactoryService{

	protected $config;

	public function load($config){
		$this->config = $config;
		EventManager::listen(CliEvent::APP_CREATED, function (Application $application){ $application->add($this); });
	}

	public static function factory(){return new static();}

}
