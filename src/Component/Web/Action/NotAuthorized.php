<?php namespace Zenit\Bundle\Mission\Module\Web\Action;

use Zenit\Bundle\Mission\Module\Web\Responder\PageResponder;

class NotAuthorized extends PageResponder {

	protected function respond() {
		$this->getResponse()->setStatusCode(401);
	}

}