<?php

namespace App\Http\Controllers;

use App\Services\ApiService;

class ApiController extends Controller
{
    public function index(ApiService $api)
    {
        $data = $api->getData();

        return response()->json($data);
    }
}
