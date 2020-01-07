<?php namespace Zenit\Bundle\Mission\Module\Web\Action;

use Zenit\Bundle\Mission\Module\Web\Responder\PageResponder;

class NotFound extends PageResponder {

	protected function respond() {
		$this->getResponse()->setStatusCode(404);
	}
	
}