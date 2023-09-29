<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Line extends Model
{
    use HasFactory, SoftDeletes;

    public function scopeList($query)
    {
        return $query->get()->mapWithKeys(function ($list) {
            return [
                $list['id'] => $list['name'],
            ];
        });
    }
}
