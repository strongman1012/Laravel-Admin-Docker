<?php

namespace App\Models;

use App\Models\Line;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class LineProduct extends Model
{
    use HasFactory, SoftDeletes;

    public function scopeProducts($query, $param)
    {
        return $query->join('products', function($join) {
            return $join->on('products.id', '=', 'line_products.product_id');
        })
        ->where('line_id', $param)
        ->select([
            'products.id',
            'products.goal'
        ])
        ->selectRaw('concat(products.name1, "-", products.name2) as name');
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
