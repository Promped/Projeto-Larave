<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Auth;

$result = Auth::attempt(['email' => 'admin@test.local', 'password' => 'senha123']);
var_dump($result);
if ($result) {
    var_dump(Auth::user()->email);
}
