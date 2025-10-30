<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = App\Models\User::where('email','admin@test.local')->first();
if ($user) {
    echo json_encode(['email' => $user->email, 'password' => $user->password, 'nivel' => $user->nivel]) . PHP_EOL;
} else {
    echo json_encode(['error' => 'user not found']) . PHP_EOL;
}
