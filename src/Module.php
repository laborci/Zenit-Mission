<?php namespace Zenit\Bundle\Mission;

use Application\ServiceRegistry;
use Symfony\Component\HttpFoundation\Request;
use Zenit\Core\Event\Component\EventManager;
use Zenit\Core\Module\Interfaces\ModuleInterface;
use Zenit\Core\Module\Component\ModuleLoader;
use Zenit\Core\ServiceManager\Component\ServiceContainer;
use Zenit\Core\StartupSequence\Constant\StartupEvent;

class Module implements ModuleInterface{

	public function load($config){
		EventManager::listen(StartupEvent::MODULES_LOADED, function () use ($config){$this->findMission($config);});
	}

	protected function loadMission($mission){
		$moduleLoader = ModuleLoader::Service();
		if (array_key_exists('modules', $mission)) foreach ($mission['modules'] as $module => $config) $moduleLoader->loadModule($module, $config);
		$moduleLoader->loadModule($mission['mission'], array_key_exists('config', $mission) ? $mission['config'] : null)->run();
		die();
	}

	protected function findMission($config){
		$host = ServiceContainer::get(Request::class)->getHttpHost();
		foreach ($config as $mission){
			$patterns = is_array($mission['pattern']) ? $mission['pattern'] : [$mission['pattern']];
			foreach ($patterns as $pattern) if (fnmatch($pattern, $host)) $this->loadMission($mission);
		}
	}
}