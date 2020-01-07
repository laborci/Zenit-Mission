<?php namespace Zenit\Bundle\Mission\Module\Web\Pipeline;

abstract class Responder extends Segment {
	abstract protected function respond();
}