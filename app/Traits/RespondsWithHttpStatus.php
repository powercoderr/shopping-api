<?php 

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

trait RespondsWithHttpStatus
{
    
    protected function success($message, $data = [], $status = Response::HTTP_OK){   
        //data = null used to response DELETE Request
        if($data == null){
            return response([
                'success' => true,
                'message' => $message,
                'error' => null,
            ], $status);    
        }

        return response([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'error' => null,
        ], $status);
    }

    protected function failure($message, $error, $status = Response::HTTP_BAD_REQUEST){
        return response([
            'success' => false,
            'message' => $message,
            'error' => $error,
        ], $status);
    }
}
