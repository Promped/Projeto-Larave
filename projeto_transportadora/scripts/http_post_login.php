<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

use Illuminate\Http\Request;

$request = Request::create('/login', 'POST', [
    'email' => 'admin@test.local',
    'password' => 'senha123',
    '_token' => 'test-csrf-token'
]);
// Copy cookies and session? We'll bootstrap session by using array.

$response = $kernel->handle($request);

echo $response->getStatusCode() . "\n";
echo substr((string)$response->getContent(), 0, 1000) . PHP_EOL;

$kernel->terminate($request, $response);
