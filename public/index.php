<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Correct path ✅
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Correct path ✅ (FIXED SLASH)
require __DIR__.'/../vendor/autoload.php';

// Correct path ✅ (FIXED SLASH)
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());