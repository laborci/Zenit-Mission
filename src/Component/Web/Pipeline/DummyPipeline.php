<?php namespace Zenit\Bundle\Mission\Module\Web\Pipeline;

class DummyPipeline extends Pipeline {
	public function __invoke() { }
	public function run() { }
	public function pipe($responderClass, $arguments = []): Pipeline { return $this; }
	public function redirect($url, $statusCode = 302) { }
}