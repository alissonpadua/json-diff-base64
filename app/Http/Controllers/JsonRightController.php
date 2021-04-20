<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use App\Http\Requests\JsonRightRequest;
use App\Models\JsonLeft;

class JsonRightController extends Controller
{
    public function store(JsonRightRequest $request)
    {
        $jsonLeft = JsonLeft::where('code', $request->id)->first();

        return $jsonLeft->jsonRight()->create([
            'code' => $request->id,
            'json_base64' => $request->json_base64
        ]);
    }
}
