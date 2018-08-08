<?php
/**
 * Created by borankux
 * User: mirzat
 * Date: 2018/8/9
 * Time: 3:54 AM
 * Github: https://github.com/borankux
 */

namespace App\Http\Responses;


class ResponseCodes
{
    const CODE_OK = 20000;
    const CODE_CREATED = 20100;
    const CODE_ACCEPTED = 20200;
    const CODE_NO_CONTENT = 20400;

    const CODE_BAD_REQUEST = 40000;
    const CODE_UNAUTHORIZED = 40100;
    const CODE_UNAUTHORIZED_CLIENT = 40101;
    const CODE_UNAUTHORIZED_USER = 40102;
    const CODE_FORBIDDEN = 40300;
    const CODE_NOT_FOUND = 40400;
    const CODE_METHOD_NOT_ALLOWED = 40500;
    const CODE_INTERNAL_SERVER_ERROR = 50000;
    const CODE_NOT_IMPLEMENTED = 50100;
    const CODE_SERVICE_UNAVAILABLE = 50300;


    private static $messages= array(
        20000 => 'OK',
        20100 => 'Accepted',
        20200 => 'Created',
        20400 => 'No Content',
        40000 => 'Bad Request',
        40100 => 'Unauthorized',
        40101 => 'Unauthorized Client',
        40102 => 'Unauthorized User',
        40300 => 'Forbidden',
        40400 => 'Not Found',
        40500 => 'Method Not Allowed',
        50000 => 'Internal Server Error. Please contact mirzatsoft@gmail.com',
        50100 => 'Not Implemented',
        50300 => 'Service Unavailable',
    );


    public static function getMessage(int $code)
    {
        if (array_key_exists($code, self::$messages)) {
            return self::$messages[$code];
        } else {
            return 'Unknown Error Code';
        }
    }

    public static function getStatusCode(int $code)
    {
        return intval(floor($code / 100));
    }

    public static function getErrorCode(int $statusCode)
    {
        return intval($statusCode * 100);
    }

}
