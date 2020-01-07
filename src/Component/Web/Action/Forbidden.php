<?php namespace Zenit\Bundle\Mission\Module\Web\Action;

use Zenit\Bundle\Mission\Module\Web\Responder\PageResponder;

class Forbidden extends PageResponder {

	protected function respond() {
		$this->getResponse()->setStatusCode(403);
	}
	
}