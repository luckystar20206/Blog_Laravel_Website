<?php

namespace App\Http\Controllers\API;

trait ApiResponse
{
    public function apiResponse($data = null, $status = null, $msg = null)
    {
        // Check if $data is an Eloquent model
        if ($data instanceof \Illuminate\Database\Eloquent\Model) {
            $data = $data->toArray(); // Convert model to array
        }

        $array = [
            'Data' => $data,
            'Message' => $msg,
            'Status' => $status
        ];

        return response()->json($array, $status);
    }
}
