<?php namespace Zenit\Bundle\Mission\Component;

use Zenit\Core\Module\Interfaces\ModuleInterface;

abstract class Mission implements ModuleInterface{
	protected $config;
	abstract public function run();
	public function load($config){ $this->config = $config; }
}