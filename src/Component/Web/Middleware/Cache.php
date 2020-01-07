<?php namespace Zenit\Bundle\Mission\Module\Web\Middleware;

use Zenit\Bundle\Cache\Component\FileCache;
use Zenit\Bundle\Mission\Module\Web\Pipeline\Middleware;
use Symfony\Component\HttpFoundation\Request;

class Cache extends Middleware {

	public function run(){
		if($this->getRequest()->getMethod() !== Request::METHOD_GET) $this->next();
		else{
			$cache = new FileCache(env('web-responder.output-cache'));
			$cacheKey = crc32($this->getRequest()->getRequestUri());
			if($cache->isValid($cacheKey)){
				$this->setResponse(unserialize($cache->get($cacheKey)));
				$this->getResponse()->headers->set('x-cached-until', $cache->getAge($cacheKey)*-1);
			}else {
				$this->next();
				if($this->getRequest()->attributes->getBoolean('cache', false)){
					$cacheInterval = $this->getRequest()->attributes->getInt('cache-interval', 60);
					$cache->set($cacheKey, serialize($this->getResponse()), $cacheInterval);
					$this->getResponse()->headers->set('x-cache-interval', $cacheInterval);
				}
			}
		}
	}

}