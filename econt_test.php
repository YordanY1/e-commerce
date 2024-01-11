<?php

use App\Services\EcontService;

require __DIR__.'/vendor/autoload.php';

// Load the application
$app = require_once __DIR__.'/bootstrap/app.php';

// Boot the application
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// Resolve the EcontService from the service container
$econtService = $app->make(EcontService::class);

try {
    $response = $econtService->getOffices();
    echo '<pre>';
    print_r($response);
    echo '</pre>';
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

// Terminate the application
$kernel->terminate($request, $response);
