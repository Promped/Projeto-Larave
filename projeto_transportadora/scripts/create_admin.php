<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$email = 'admin@example.com';
$exists = User::where('email', $email)->first();
if ($exists) {
    echo "User already exists: {$exists->email}\n";
    exit(0);
}

$user = User::create([
    'name' => 'Admin',
    'email' => $email,
    'password' => Hash::make('secret'),
    'nivel' => 'ADM'
]);

echo "Created user: {$user->id} | {$user->email} | nivel={$user->nivel}\n";
