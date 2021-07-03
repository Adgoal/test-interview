<?php declare(strict_types=1);

namespace App;

function env(string $key): ?string
{
    return $_ENV[$key] ?? null;
}

function envInt(string $key): ?int
{
    $val = $_ENV[$key] ?? null;

    if (empty($val)){
        return null;
    }

    return intval($val);
}

return [
    'user_login' => env('USER_LOGIN'),
    'user_password' => env('USER_PASSWORD'),
    'app_secret_key' => env('APP_SECRET_KEY'),
    'token_life_time' => envInt('TOKEN_LIFETIME'),

    'db_dsn' => env('DB_DSN'),
    'db_login' => env('DB_LOGIN'),
    'db_password' => env('DB_PASSWORD'),
];
