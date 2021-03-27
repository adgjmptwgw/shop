<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;

    public function goods()
    {
        // OrderとGoodsテーブルのリレーション
        // belongsToを書く側は一対多で言うところの「多」
        return $this->belongsTo('App\Models\Goods');
    }
}
