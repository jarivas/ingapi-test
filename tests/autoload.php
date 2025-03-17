<?php
define('ROOT_DIR', dirname(__DIR__));

require_once ROOT_DIR.'/vendor/autoload.php';

$_ENV = \PhpEnv\EnvManager::parse(ROOT_DIR.'/.env');
