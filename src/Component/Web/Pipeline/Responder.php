<?php namespace Zenit\Bundle\Mission\Component\Web\Pipeline;

abstract class Responder extends Segment {
	abstract protected function respond();
}