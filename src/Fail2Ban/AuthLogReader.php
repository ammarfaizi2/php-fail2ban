<?php

namespace Fail2Ban;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @version 0.0.1
 * @package Fail2Ban
 * @license MIT
 */

final class AuthLogReader
{
    /**
     * @var string
     */
    private $log;

    /**
     * Constructor
     * @param string $auth_log_file
     */
    public function __construct($auth_log_file = "/var/log/auth.log")
    {
        $this->log = file_exists($auth_log_file) ? file_get_contents($auth_log_file) : "";
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->log;
    }
}
