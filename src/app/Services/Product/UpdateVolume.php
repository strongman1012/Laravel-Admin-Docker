<?php

namespace App\Services\Product;

use App\Services\BaseService;
use App\Models\ProductVolume;
use Exception;
use InvalidArgumentException;
use Carbon\Carbon;

class UpdateVolume extends BaseService
{
    /**
     * デバイスを作成する、以下主なエラーケース
     * ・device_key が重複したデータが存在する
     *
     * @param array $result
     * @return Device
     * @throws Exception
     */
    public function execute($request)
    {
        foreach ($request['result'] as $result) {

            $work_start_at = Carbon::createFromTime($result['work_start'], 0, 0);
            $work_end_at = Carbon::createFromTime($result['work_start'], 59, 59);

            if ($result['count_worker'] == 0 && $result['count_volume'] > 0) {
                throw new InvalidArgumentException("作業者数が入力されていません。($work_start_at)");
            }

            ProductVolume::updateOrCreate([
                'line_id' => $result['line_id'],
                'product_id' => $result['product_id'],
                'work_start_at' => $work_start_at,
                'work_end_at' => $work_end_at,
            ],[
                'line_id' => $result['line_id'],
                'product_id' => $result['product_id'],
                'work_start_at' => $work_start_at,
                'work_end_at' => $work_end_at,
                'count_worker' => $result['count_worker'] ?? 0,
                'count_volume' => $result['count_volume'] ?? 0,
            ]);
        }

        session()->flash('flash_message', '更新しました');

        return;

    }
}