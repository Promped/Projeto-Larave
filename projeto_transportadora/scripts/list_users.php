<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$users = App\Models\User::all(['id','name','email','nivel']);
foreach ($users as $u) {
    echo "{$u->id}\t{$u->name}\t{$u->email}\t{$u->nivel}\n";
}
