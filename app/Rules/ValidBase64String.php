<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidBase64String implements Rule
{
    public function passes($attribute, $value)
    {
        if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $value)) return false;

        $decoded = base64_decode($value, true);
        if (false === $decoded) return false;

        if (base64_encode($decoded) != $value) return false;

        return true;
    }

    public function message()
    {
        return ':attribute is not a valid base64 string';
    }
}
