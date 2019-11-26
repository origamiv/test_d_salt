<?php

define('ROOT', __DIR__);
define('APP_PATH', ROOT . '/app');
define('VIEWS_PATH', ROOT . '/app/Http/Views');
define('CLASS_ENGINE', ROOT . '/engine');

if(!isset($_SESSION)) {
    ini_set('session.save_path', ROOT . '/storage/sessions/');
    session_start();
}

// Vendor
require ROOT . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

if(getenv('IS_PRODUCTION') === 'development') {
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

// Require config
require __DIR__ . '/config/app.php';

// Require route
require APP_PATH . '/routes/RouteWeb.php';
require APP_PATH . '/routes/RouteApi.php';
