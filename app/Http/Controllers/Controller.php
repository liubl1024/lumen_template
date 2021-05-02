<?php

namespace App\Http\Controllers;

use App\Constants\ResponseCode;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function responseError($errorCode)
    {
        $message = ResponseCode::getMessage($errorCode);

        $ret = [
            'code' => $errorCode,
            'message' => $message,
            'result' => [],
            'status' => 'error',
        ];

        return response()->json($ret);
    }

    public function responseSuccess($data = [], $code = 200)
    {
        $ret = [
            'code' => $code,
            'message' => "OK",
            'result' => $data,
            'status' => 'success',
        ];

        return response()->json($ret);
    }
}
