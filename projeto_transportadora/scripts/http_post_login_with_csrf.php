<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
use Illuminate\Http\Request;

// Step 1: GET /login
$get = Request::create('/login', 'GET');
$getResponse = $kernel->handle($get);

// Extract the session cookie (laravel_session)
$setCookies = $getResponse->headers->get('Set-Cookie');
$sessionCookie = null;
if ($setCookies) {
    if (is_array($setCookies)) {
        foreach ($setCookies as $c) {
            if (strpos($c, 'laravel_session') !== false) {
                $sessionCookie = preg_replace('/;.*$/', '', $c);
                break;
            }
        }
    } else {
        if (strpos($setCookies, 'laravel_session') !== false) {
            $sessionCookie = preg_replace('/;.*$/', '', $setCookies);
        }
    }
}

$content = (string)$getResponse->getContent();
// extract csrf token value
$matches = [];
preg_match('/name="?_token"?\s+value="([^"]+)"/', $content, $matches);
$token = $matches[1] ?? null;

echo "sessionCookie: ".($sessionCookie ?? 'none')."\n";
echo "token: ".($token ?? 'none')."\n";

// Step 2: POST /login with cookie and token
$post = Request::create('/login', 'POST', [
    '_token' => $token,
    'email' => 'admin@test.local',
    'password' => 'senha123',
]);

if ($sessionCookie) {
    // parse cookie string like "laravel_session=..."
    $parts = explode('=', $sessionCookie, 2);
    if (count($parts) == 2) {
        $post->headers->set('Cookie', $parts[0].'='.$parts[1]);
    }
}

$postResponse = $kernel->handle($post);

echo "POST status: " . $postResponse->getStatusCode() . "\n";

// print first 500 chars of content
echo substr((string)$postResponse->getContent(), 0, 500) . "\n";

$kernel->terminate($post, $postResponse);
