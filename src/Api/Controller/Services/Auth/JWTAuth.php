<?php

namespace Api\Services\Auth;

use http\Env;

class JWTAuth
{
    const TYPE_REFRESH = 'refresh';

    /**
     * @return string
     */
    public static function createToken($user): string
    {
        $secretKey = Env::get('APP_SECRET_KEY');
        $dateTime = time();
        $expireAt = $dateTime + Env::get('TOKEN_LIFETIME');
        $token = [
            'iss' => 'localhost',
            'iat' => $dateTime,
            'nbf' => $dateTime,
            'exp' => $expireAt,
            'data' => [
                'id' => $user->getId()
            ]

        ];

        return JWTAuth::encode($token, $secretKey);
    }

    /**
     * @param string $refreshToken
     * @return mixed
     */
    public static function getUserFromRefreshToken(string $refreshToken)
    {
        $secretKey = Env::get('APP_SECRET_KEY');
        $payload = JWT::decode($refreshToken, $secretKey, ['HS256']);

        if ($payload->get('type') == self::TYPE_REFRESH) {
            return User::where('id', $payload->get('sub'))->first();
        }
        throw new AuthException(__('errors.auth.refresh_token_failed'));
    }

    /**
     * @param $token
     */
    public static function blacklist($token)
    {
        $tokenData = JWT::decode($token);
        $expiredAt = (new \DateTime())->setTimestamp($tokenData['exp']);
        $tokenBlackList = new TokenBlacklist(['token' => $token, 'expiredAt' => $expiredAt]);
        //save token in blacklist
    }
}