<?php namespace Zenit\Bundle\Mission\Module\Web\ClientVersion;

class ClientVersion{

	static function get(){
		$file = env('web-responder.client-version');
		return file_exists($file) ? file_get_contents($file) : 0;
	}

}