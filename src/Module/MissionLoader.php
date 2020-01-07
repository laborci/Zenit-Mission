<?php namespace Zenit\Bundle\Mission\Module;

use Symfony\Component\HttpFoundation\Request;
use Zenit\Core\Module\Interfaces\ModuleInterface;
use Zenit\Core\Module\Component\ModuleLoader;

class MissionLoader implements ModuleInterface{

	public function load($config){

		$host = Request::createFromGlobals()->getHttpHost();

		foreach ($config as $mission){
			$patterns = is_array($mission['pattern']) ? $mission['pattern'] : [$mission['pattern']];
			foreach ($patterns as $pattern){
				$pattern = str_replace('{domain}', env('domain'), $pattern);
				if (fnmatch($pattern, $host)){

					$moduleLoader = ModuleLoader::Service();

					if (array_key_exists('modules', $mission)){
						foreach ($mission['modules'] as $module => $config){
							$moduleLoader->loadModule($module, $config);
						}
					}

					$moduleLoader->loadModule($mission['mission'], array_key_exists('config', $mission) ? $mission['config'] : null)->run();
					die();
				}
			}
		}
		die('No mission found');
	}
}