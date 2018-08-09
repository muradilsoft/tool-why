<?php
/**
 * Created by borankux
 * User: mirzat
 * Date: 2018/8/9
 * Time: 4:10 AM
 * Github: https://github.com/borankux
 */

namespace App\Exceptions;

use App\Http\Responses\ResponseCodes;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiException extends HttpException
{

    public function __construct(int $errorCode, string $message = null, \Exception $previous = null, array $headers = array())
    {
        parent::__construct(
            ResponseCodes::getStatusCode($errorCode),
            $message ? $message : ResponseCodes::getMessage($errorCode),
            $previous,
            $headers,
            $errorCode
        );
    }
}
