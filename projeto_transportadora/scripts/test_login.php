<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Auth;

$credentials = ['email' => 'admin@test.local', 'password' => 'senha123'];
$ok = Auth::attempt($credentials);
if ($ok) {
    echo "LOGIN_OK\n";
    $user = Auth::user();
    echo json_encode($user->only(['id','email','nivel','name']), JSON_PRETTY_PRINT) . PHP_EOL;
} else {
    echo "LOGIN_FAIL\n";
}
