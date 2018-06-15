<?php
/**
 * Created by PhpStorm.
 * User: Benny
 * Date: 15/06/2018
 * Time: 13:52
 */

namespace Code\Demo5;


class FakeLogger implements ILogger {
	public function log($request, $priority) {
		return true;
	}
}