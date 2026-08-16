<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

$projectPath = dirname(__DIR__);
$deployedProjectPath = $projectPath.'/repositories/ymiits';
$basePath = is_file($projectPath.'/vendor/autoload.php')
    ? $projectPath
    : $deployedProjectPath;

require $basePath.'/vendor/autoload.php';

$app = require_once $basePath.'/bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
