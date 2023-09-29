<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexProductVolumeRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'line_id' => [
                'required',
                'exists:lines,id',
            ],
            'line_id' => [
                'nullable',
                'string',
            ],
        ];
    }
}
