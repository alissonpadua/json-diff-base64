<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use App\Models\JsonLeft;
use App\Services\CompareService;

class JsonCompareController extends Controller
{
    public function compare($id)
    {
        /*
            All json left (input) should have a json right (compare).
            There is a relashionship in JsonLeft::class->jsonRigh() that provide it
            The same happens with the inverse
        */
        $jsonLeft = JsonLeft::with('jsonRight')
            ->where('code', $id)
            ->first();

        /*
            Algorithm to check if this relationship exists
        */
        if (!$jsonLeft) {
            throw ValidationException::withMessages([
                'json_left' => 'Json Left not found'
            ]);
        } else if (!$jsonLeft->jsonRight) {
            throw ValidationException::withMessages([
                'json_right' => 'Json Right not found'
            ]);
        }

        /*
            All ok it's time to call the service to compare the things 
        */
        $compareService = new CompareService($jsonLeft, $jsonLeft->jsonRight);
        return $compareService->compare();
    }
}
