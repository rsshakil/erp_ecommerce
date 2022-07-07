<?php

namespace App\Traits;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

trait ApiResponse
{
    protected function successResponse($message, $data = null, $code = Response::HTTP_OK)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'status' => $code,
        ], $code);
    }

    protected function errorResponse($message = '異常が発生しました', $errors = [], $code = 500, $e = null)
    {
        return response()->json(
            [
                'success' => false,
                'message' => $message,
                'errors' => $errors,
                'status' => $code
            ], $code);
    }

    protected function response($data, $message = null, $code = Response::HTTP_OK)
    {
        $isSuccess = false;

        if (is_array($data) && count($data) > 0) {
            $isSuccess = true;
        } elseif (!is_array($data) && $data) {
            $data = $data->toArray();
            $isSuccess = true;
        } else {
            $message = 'No records found!';
        }

        return response()->json([
            'success' => $isSuccess,
            'message' => $message,
            'data' => $data,
            'status' => $code
        ], $code);
    }

    protected function logError(\Exception $e)
    {
        $log = 'Error: ' . $e->getMessage();
        $log .= ' Line: ' . $e->getLine();
        $log .= ' File: ' . $e->getFile();

        \Log::info(print_r($log, true));
    }

    protected function exception(\Exception $e)
    {
        if (env('APP_DEBUG') == true) {
            $log = 'Error: ' . $e->getMessage();
            $log .= ' Line: ' . $e->getLine();
            $log .= ' File: ' . $e->getFile();
        } else {
            $log = [];
        }
        return $this->errorResponse('異常が発生しました', $log);
    }

    protected function validators($request, $rules)
    {
        $validator = Validator::make($request, $rules);
        if ($validator->fails()) {
            return $this->errorResponse('Please enter correct data', $validator->errors());
        }

        return response()->json([
            'success' => true,
        ]);
    }
}
