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
		is_dir(FAIL2BAN_DATA) or mkdir(FAIL2BAN_DATA);
		$a = new ParseUserLogin(new AuthLogReader());
		$login_event = $a->getLoginEvent();
		if (isset($login_event['login_failed'])) {
			if (file_exists(FAIL2BAN_DATA."/login_failed.log")) {
				$data_suwe = json_decode(file_get_contents(FAIL2BAN_DATA."/login_failed.log"), true);
				$data_suwe = is_array($data_suwe) ? $data_suwe : array();
				file_put_contents(FAIL2BAN_DATA."/login_failed.log", json_encode($fail = array_merge($login_event['login_failed'], $data_suwe), 128));
			} else {
				file_put_contents(FAIL2BAN_DATA."/login_failed.log", json_encode($fail = $login_event['login_failed'], 128));
			}
			$tv = array();
			foreach ($fail as $val) {
				foreach ($val as $val) {
					isset($tv[$val['ip']]) or $tv[$val['ip']] = 0;
					$tv[$val['ip']]++;
				}
			}
			if (file_exists(FAIL2BAN_DATA."/banned_list")) {
				$banned_list = json_decode(file_get_contents(FAIL2BAN_DATA."/banned_list"), true);
				$banned_list = is_array($banned_list) ? $banned_list : array();
			} else {
				$banned_list = array();
			}
			$new_banned_list = array();
			foreach ($tv as $key => $val) {
				if ($val>=MAX_FAILED) {
					!in_array($key, $banned_list) and $banned_list[] = $key and $new_banned_list[] = $key;
				}
			}
			file_put_contents(FAIL2BAN_DATA."/banned_list", json_encode($banned_list, 128));
			$banned_string = "";
			if (count($new_banned_list)) {
				$banned_string = "\n\n# Banned at ".date("Y-m-d H:i:s")."\n";
				foreach ($new_banned_list as $val) {
					$banned_string.="ALL: ".$val."\n";
				}
				file_put_contents("/etc/hosts.deny", $banned_string, FILE_APPEND | LOCK_EX);
			}
		}
	}
}