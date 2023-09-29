<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public function getNameAttribute() {
        return "{$this->name1}-{$this->name2}";
    }

    public function scopeList($query)
    {
        return $query->get()->mapWithKeys(function ($list) {
            return [
                $list['id'] => "$list[name1]-$list[name2]",
            ];
        });
    }
}
