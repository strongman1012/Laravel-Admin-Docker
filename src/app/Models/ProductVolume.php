<?php

namespace App\Models;

use App\Models\Line;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class ProductVolume extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'line_id',
        'product_id',
        'work_start_at',
        'work_end_at',
        'count_volume',
        'count_worker',
    ];

    public function getSimpleAtAttribute() {
        return $this->getYMDH($this->work_start_at);
    }

    public static function getYMDH($at){
        return (new Carbon($at))->format('Y-m-d H');
    }

    public function line()
    {
        return $this->hasOne(Line::class, 'id', 'line_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
