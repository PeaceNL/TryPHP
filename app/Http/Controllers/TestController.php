<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function api(Request $request)
    {
        Log::info('Visited: GET /api');
        $token = $request->session()->token();
 
        $token = csrf_token();
        return response()->json(['message' => 'API endpoint reached successfully']);
    }
}