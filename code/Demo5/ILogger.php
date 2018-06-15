<?php
/**
 * Created by PhpStorm.
 * User: Benny
 * Date: 15/06/2018
 * Time: 13:47
 */

namespace Code\Demo5;


interface ILogger {
	public function log($request, $priority);

	const PRIORITY_ERROR = 1;
	const PRIORITY_INFO = 2;
	const PRIORITY_WARNING = 3;
}