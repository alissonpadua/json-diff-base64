<?php

namespace App\Http\Controllers;

use App\Http\Requests\JsonLeftRequest;
use App\Models\JsonLeft;

class JsonLeftController extends Controller
{
    public function store(JsonLeftRequest $request)
    {
        return JsonLeft::create([
            'code' => $request->id,
            'json_base64' => $request->json_base64
        ]);
    }
}
