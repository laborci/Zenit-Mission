<?php namespace Zenit\Bundle\Mission\Component\Cli;

use Symfony\Component\Console\Application;
use Zenit\Bundle\Mission\Constant\CliEvent;
use Zenit\Core\Event\Component\EventManager;
class CliMission extends \Zenit\Bundle\Mission\Component\Mission{


	/** @var \Symfony\Component\Console\Application */
	protected $application;

	public function run(){
		$this->application = new Application('plx', '3');

		EventManager::fire(CliEvent::APP_CREATED, $this->application);

		if(is_array($this->config) && array_key_exists('commands', $this->config)){
			$commands = $this->config['commands'];
			if (is_array($commands)) foreach ($commands as $command){
				$this->application->add(new $command());
			}
		}

		$this->application->run();
	}

}