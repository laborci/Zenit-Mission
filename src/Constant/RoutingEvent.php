<?php

namespace Zenit\Bundle\Mission\Constant;

interface RoutingEvent{
	const BEFORE = __CLASS__ . 'BEFORE';
	const FINISHED = __CLASS__ . 'FINISHED';
	const NOTFOUND = __CLASS__ . 'NOTFOUND';
}