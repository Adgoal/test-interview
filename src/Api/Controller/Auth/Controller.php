<?php

class Controller
{
    public const HTTP_OK = 200;
    public const HTTP_UNAUTHORIZED = 401;


    /**
     * @param $data
     * @param int $code
     * @param array $headers
     * @return false|string
     */
    protected function response($data, $code = self::HTTP_OK, $headers = [])
    {
        return json_encode($data, $code, $headers);
    }

    /**
     * @param $message
     * @param $statusCode
     * @return  false|string
     */
    protected function responseError($message, $statusCode)
    {
        return $this->response([
            'errors' => [
                'message' => $message,
                'status_code' => $statusCode
            ]
        ], $statusCode);
    }
}