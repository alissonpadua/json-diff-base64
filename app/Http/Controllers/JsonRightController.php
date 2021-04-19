<?php

namespace App\Http\Controllers;

use App\Http\Requests\JsonRightRequest;
use App\Models\JsonLeft;

class JsonRightController extends Controller
{
    public function store(JsonRightRequest $request)
    {
        return $request->all();
        $jsonLeft = JsonLeft::findOrFail($request->id);
        return $jsonLeft;
        return $jsonLeft->jsonRight()->create([
            'code' => $request->id,
            'json_base64' => $request->json_base64
        ]);
    }
}
