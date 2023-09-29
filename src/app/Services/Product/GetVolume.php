<?php

namespace App\Services\Product;

use App\Services\BaseService;
use App\Models\ProductVolume;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class GetVolume extends BaseService
{
    /**
     * Get the validation rules that apply to the service.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'line_id' => 'bail|required|integer|exists:lines,id',
            'work_date' => 'nullable|date|min:0|max:100',
        ];
    }

    /**
     * デバイスを作成する、以下主なエラーケース
     * ・device_key が重複したデータが存在する
     *
     * @param array $data
     * @return ProductVolume
     * @throws Exception
     */
    public function execute(array $data)
    {
        $validator = $this->validator($data);

        if ($validator->fails()) {
            throw new Exception($validator->errors()->first());
        }
        
        $volumes = [];

        $product_volumes = ProductVolume::where('line_id', $data['line_id'])
            ->where('work_start_at', '>', Arr::has($data, 'work_date')
                ? new Carbon($data['work_date'] . ' 0:0:0')
                : Carbon::now()->format('Y-m-d 0:0:0'))
            ->where('work_start_at', '<', Arr::has($data, 'work_date')
                ? new Carbon($data['work_date'] . ' 23:59:59')
                : Carbon::now()->format('Y-m-d 23:59:59'))
            ->select([
                'line_id',
                'product_id',
                DB::raw("date_format(work_start_at, '%k') as work_start"),
                'count_worker',
                'count_volume'
            ])
            ->get();

            foreach ($product_volumes as $product_volume) {
                $volumes[$product_volume->work_start] = [
                    'line_id' => $product_volume->line_id,
                    'product_id' => $product_volume->product_id,
                    'work_start' => $product_volume->work_start,
                    'count_worker' => $product_volume->count_worker,
                    'count_volume' => $product_volume->count_volume,
                ];
            };


        return $volumes;
    }
}