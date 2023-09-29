<?php

namespace App\Http\Requests;

use \App\Enums\WorkType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductVolumeRequest extends FormRequest
{
    private $count_worker;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'result' => 'array',
            'result.*.line_id' => [
                'required',
                'integer',
                'exists:lines,id',
            ],
            'result.*.product_id' => [
                'required',
                'integer',
                'exists:products,id',
            ],
            'result.*.work_start' => [
                'required',
                'integer',
                'min:' . WorkType::WORK_START,
                'max:' . WorkType::WORK_END,
            ],
            'result.*.work_end' => [
                'required',
                'integer',
                'min:' . WorkType::WORK_START,
                'max:' . WorkType::WORK_END,
            ],
            'result.*.count_worker' => [
                'nullable',
                'integer',
                'min:' . WorkType::WORKER_MIN,
                'max:' . WorkType::WORKER_MAX,
            ],
            'result.*.count_volume' => [
                'nullable',
                'integer',
                'min:' . WorkType::VOLUME_MIN,
                'max:' . WorkType::VOLUME_MAX,
            ],
        ];
    }
}
