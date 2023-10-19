<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';

use App\Application;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$app = new Application();
$app->run();
