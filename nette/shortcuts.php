<?php

require __DIR__ . '/SafeStream/SafeStream.php';

Nette\Utils\SafeStream::register();


/**
 * This file is part of the Tracy (https://tracy.nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

if (!function_exists('dump')) {
	/**
	 * Tracy\Debugger::dump() shortcut.
	 * @tracySkipLocation
	 */
	function dump($var)
	{
		array_map('Tracy\Debugger::dump', func_get_args());
		return $var;
	}
}


/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

if (!function_exists('dlog')) {
	/**
	 * Tracy\Debugger::log() shortcut.
	 */
	function dlog($var = NULL)
	{
		if (func_num_args() === 0) {
			Tracy\Debugger::log(new Exception, 'dlog');
		}
		foreach (func_get_args() as $arg) {
			Tracy\Debugger::log($arg, 'dlog');
		}
		return $var;
	}
}


if (!function_exists('callback')) {
	/**
	 * Nette\Callback factory.
	 * @param  mixed   class, object, callable
	 * @param  string  method
	 * @return Nette\Callback
	 */
	function callback($callback, $m = NULL)
	{
		return new Nette\Callback($callback, $m);
	}
}
