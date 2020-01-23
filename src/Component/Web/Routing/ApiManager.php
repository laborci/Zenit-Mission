<?php namespace Zenit\Bundle\Mission\Component\Web\Routing;

use CaseHelper\CaseHelperFactory;
use Zenit\Bundle\Mission\Component\Web\Pipeline\Segment;
use Zenit\Bundle\Mission\Component\Web\Routing\Router;

class ApiManager extends Segment{

	public static function setup(Router $router, $path, $namespace){
		$router->any(rtrim($path, '/') . '/{path}', ApiManager::class, ['namespace' => $namespace])();
	}

	public function __invoke($method = null){

		$namespace = $this->getArgumentsBag()->get('namespace');
		$method = strtolower($this->getRequest()->getMethod());
		$action = null;
		$uri = explode('/', $this->getPathBag()->get('path'));

		if (preg_match('/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/', end($uri)) === 0) $this->getPathBag()->set('id', array_pop($uri));

		$uri = array_map(function ($item){ return CaseHelperFactory::make(CaseHelperFactory::INPUT_TYPE_KEBAB_CASE)->toPascalCase($item); }, $uri);

		$class = $namespace . '\\' . join('\\', $uri);

		if (class_exists($class)){
			$this->next($class, ['method' => $method, 'action' => $action]);
		}else{
			$action = lcfirst(array_pop($uri));
			$class = $namespace . '\\' . join('\\', $uri);
			$this->next($class, ['method' => $method, 'action' => $action]);
		}
	}

}