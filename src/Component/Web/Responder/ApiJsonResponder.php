<?php namespace Zenit\Bundle\Mission\Component\Web\Responder;

use Minime\Annotations\Reader;
use Zenit\Core\ServiceManager\Component\ServiceContainer;

abstract class ApiJsonResponder extends JsonResponder{

	protected $method;

	final public function __invoke($action = 'respond'){
		$response = $this->getResponse();
		$response->headers->set('Content-Type', 'application/json');

		$method = $this->getArgumentsBag()->get('method');
		$action = $this->getArgumentsBag()->getAlpha('action') ?:( method_exists($this, $method) ? $method : $action);
		$this->method = $method;

		/** @var Reader $reader */
		$reader = ServiceContainer::get(Reader::class);
		$methods = $reader->getMethodAnnotations($this, $action)->getAsArray('method');

		if(!method_exists($this, $action) || ($methods && !in_array($method, $methods))){
			$this->getResponse()->setStatusCode(404);
		}else{
			$response->setContent(json_encode($this->$action(...$this->getArgumentsBag()->all()), JSON_UNESCAPED_UNICODE));
			$this->next();
		}
	}

}