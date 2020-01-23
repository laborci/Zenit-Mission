<?php namespace Zenit\Bundle\Mission\Component\Web\Action;

use Zenit\Bundle\Mission\Component\Web\Responder\PageResponder;

class NotAuthorized extends PageResponder {

	protected function respond() {
		$this->getResponse()->setStatusCode(401);
	}

}