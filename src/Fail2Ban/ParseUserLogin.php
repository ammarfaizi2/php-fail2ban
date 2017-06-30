<?php

namespace Fail2Ban;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @version 0.0.1
 * @package Fail2Ban
 * @license MIT
 */

final class ParseUserLogin
{	
	/**
	 * @var string
	 */
	private $log_content;

	/**
	 * Constructor.
	 * @param string $log_content
	 */
	public function __construct($log_content)
	{
		$this->log_content = (string) $log_content;
	}

	/**
	 * @return array
	 */
	public function getLoginEvent()
	{
		$a = explode("\n", $this->log_content);
		for ($i=0; $i < count($a); $i++) { 
			$b = explode("sshd[", $a[$i], 2);
			if (isset($b[1])) {
				// get time
				$qq = explode(" ",$b[0],-1);
				$time = implode(" ", array($qq[0], $qq[1], $qq[2]));

				if (strpos($b[1], "Failed password for ")!==false) {
					$b = explode("Failed password for ", $b[1], 2);
					if (strpos($b[1], "invalid user")!==false) {
						$b = explode("invalid user", $b[1]);
						$b = explode(" ", $b[1], 3);$q = $a;
						$b[0] = $b[1];
						$b[2] = explode(" ", $b[2]);
						$b[4] = $b[2][3];
						$b[2] = $b[2][1];
					} else {
						$b = explode(" ", $b[1]);
					}
					$rt['login_failed'][$time] = array(
											"ip" 	=> trim($b[2]),
											"user"	=> trim($b[0]),
											"port" 	=> trim($b[4]),
										);
				}
			}
		}
		var_dump($rt);die;
		return $a;
	}
}