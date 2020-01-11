<?php

use Dotenv\Dotenv;

require_once './vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
var_dump(getenv('DB_NAME'));
