<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use App\Models\JsonLeft;
use App\Services\CompareService;

class JsonCompareController extends Controller
{
    public function compare($id)
    {

        $jsonLeft = JsonLeft::with('jsonRight')
            ->where('code', $id)
            ->first();

        if (!$jsonLeft) {
            throw ValidationException::withMessages([
                'json_left' => 'Json Left not found'
            ]);
        } else if (!$jsonLeft->jsonRight) {
            throw ValidationException::withMessages([
                'json_right' => 'Json Right not found'
            ]);
        }

        $compareService = new CompareService($jsonLeft, $jsonLeft->jsonRight);
        return $compareService->compare();
    }
}
