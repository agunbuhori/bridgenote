<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected function success($data, $status = 200, $message = "")
    {
        return response()->json(compact('data', 'status', 'message'), $status);
    }
    
    protected function failed($status = 404, $message = "")
    {
        return response()->json(compact('status', 'message'), $status);
    }

}
