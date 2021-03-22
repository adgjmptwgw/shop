<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned(); //ユーザーid
            $table->integer('goods_id')->nullable(); // 商品のid
            $table->integer('favorite_switch')->nullable(); //お気に入りリストにその商品があるか
            $table->integer('quantity_goods_basket')->nullable(); //カート内にある商品の各個数
            $table->integer('checked_goods')->nullable(); //決済する商品のチェックの有無
            $table->timestamps();

            // user_idとfollow_idの組み合わせの重複を許さない
            // $table->unique(['user_id', 'favorite_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
