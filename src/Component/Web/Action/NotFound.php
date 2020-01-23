<?php namespace Zenit\Bundle\Mission\Component\Web\Action;

use Zenit\Bundle\Mission\Component\Web\Responder\PageResponder;

class NotFound extends PageResponder {

	protected function respond() {
		$this->getResponse()->setStatusCode(404);
	}
	
}