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

	public function __construct($log_content)
	{
		$this->log_content = $log_content;
	}
}