<?php
namespace App\Traits;

Trait HttpResponses {
  protected function success($data, $message = null, int $code = 200) {
    return response()->json([
      'status' => 'Success',
      'message' => $message,
      'data' => $data
    ], $code);
  }

  protected function error($data, $message = null, int $code)
  {
    return response()->json([
      'status' => 'Error',
      'message' => $message,
      'data' => $data
    ], $code);
  }
}