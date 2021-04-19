<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidBase64String;

class JsonRightRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|integer|unique:json_rights,code|exists:json_lefts,code',
            'json_base64' => [
                'required',
                'string',
                new ValidBase64String
            ]
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->id,
        ]);
    }

    public function messages()
    {
        return [
            'id.exists' => 'Json Left not found'
        ];
    }
}
