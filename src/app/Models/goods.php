<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Goods extends Model
{
    use HasFactory;

    public function order()
    {
        // OrderとGoodsテーブルのリレーション
        // hasManyを書く側は一対多で言うところの「一」
        return $this->hasMany('App\Models\Order');
    }
    // Builderがないと、Whereが使えない? ・・・しかし実際は使用できた。
    public function scopeHistory(Builder $query)
    {
        return $query->where('id',2);
    }

    public function scopePublicOrderHistory(Builder $query){
        // ddd($query);
        return $query
        // ->history()で上記のpublic function scopeHistory()からデータを取得する。
        ->history() 
        ->orderBy('created_at', 'asc')
        ->get();
    }

    public function getCreatedAtFormatAttribute()
    {
        // creat_atに年月日の単位を付ける。viewで表示される際は単位が付いた状態で表示される。
        return $this->created_at->format('Y年m月d日');
    }
}
