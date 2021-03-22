<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use App\Models\Order;
use App\Models\User;
use Auth;

class OrdersApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        // 'goods_id' => 'required|max:1',
        // 'shop_basket_id' => 'required|max:1000',
        // 'quantity_goods_basket' => 'required|max:100',
        ]);

        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
            ->route('goods.index')
            ->withInput()
            ->withErrors($validator);
        }

        // Eloquentモデル
        // $order = new Order;
        // $order->user_id = $request->user_id;
        // $order->goods_id = $request->goods_id;  
        // $order->shop_basket_id = $request->shop_basket_id; 
        // $order->quantity_goods_basket = $request->quantity_goods_basket;
        // $order->save();

        $order = new Order;
        $order->user_id = $request->user_id; 
        if($request->goods_id != NULL){
            $order->goods_id = $request->goods_id; 
        }
        if($request->favorite_switch != NULL){
            $order->favorite_switch = $request->favorite_switch; 
        }
        if($request->quantity_goods_basket != NULL){
            $order->quantity_goods_basket = $request->quantity_goods_basket;
        }
        if($request->checked_goods != NULL){
            $order->checked_goods = "$request->checked_goods";
        }
        $order->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
        // 'goods_id' => 'required|max:1',
        // 'favorite_switch' => 'required|max:1000',
        // 'quantity_goods_basket' => 'required|max:100',
        ]);

        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
            ->route('goods.index')
            ->withInput()
            ->withErrors($validator);
        }

        // ddd($request->quantity_goods_basket);

        // Eloquentモデル
        $order = Order::find($id);
        $order->user_id = $request->user_id; 
        if($request->goods_id != NULL){
            $order->goods_id = $request->goods_id; 
        }
        if($request->favorite_switch != NULL){
            $order->favorite_switch = $request->favorite_switch; 
        }
        if($request->quantity_goods_basket != NULL){
            $order->quantity_goods_basket = $request->quantity_goods_basket;
        }
        if($request->checked_goods != NULL){
            $order->checked_goods = "$request->checked_goods";
        }
        $order->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $idにはユーザーidが入っている。
        // user_idとgoods_idが一致するidをOrderテーブルから取得する。
        // そのidを$order_idに代入して削除処理を実行する。

        // $order = Order::find($user_id);

        $order = Order::find($id);
        $order->delete();
    }
}
