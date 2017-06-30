<?php

namespace Fail2Ban;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @version 0.0.1
 * @package Fail2Ban
 * @license MIT
 */

use Fail2Ban\AuthLogReader;
use Fail2Ban\ParseUserLogin;

defined("FAIL2BAN_DATA") or die("FAIL2BAN_DATA not defined !");

final class Core
{	
	/**
	 * Here we go.
	 */
	public static function run()
	{
		$a = new ParseUserLogin(new AuthLogReader(__DIR__ . "/../../a.tmp"));
		$login_event = $a->getLoginEvent();
		var_dump($login_event);
	}
}