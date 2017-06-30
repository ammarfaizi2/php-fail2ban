#!/usr/bin/env php
<?php
require __DIR__ . "/vendor/autoload.php";
define("FAIL2BAN_DATA", __DIR__ . "/fail2ban");
Fail2Ban\Core::run();