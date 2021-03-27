<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Order;
use App\Models\Goods;
use Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'asc')->where('user_id',Auth::user()->id)->whereNotNull('quantity_goods_basket')
        ->get();

        $goods_price = []; // Orderテーブルから取得した、カート内の商品価格
        $counter = 0;   // foreach繰り返し回数カウント

        // カート内の各商品の価格を取得し、配列(goods_price)に挿入。
        foreach($orders as $value) {
            $goods_price[] = $orders[$counter]->goods->price * $orders[$counter]['quantity_goods_basket'];
            $counter++;
        };

        // カートに入っている商品の合計額の計算
        $total_price = array_sum($goods_price);

        return view('order', [
            'orders' => $orders,
            'total_price' => $total_price,
        ]);
    }
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function payment()
    {
        $orders = Order::orderBy('created_at', 'asc')
        ->where('user_id',Auth::user()->id)
        ->where('checked_goods',1)
        ->whereNotNull('quantity_goods_basket')
        ->get();

        $goods_price = []; // Orderテーブルから取得した、カート内の商品価格
        $counter = 0;   // foreach繰り返し回数カウント

        // カート内の各商品の価格を取得し、配列(goods_price)に挿入。
        foreach($orders as $value) {
            $goods_price[] = $orders[$counter]->goods->price * $orders[$counter]['quantity_goods_basket'];
            $counter++;
        };

        // カートに入っている商品の合計額の計算
        $total_price = array_sum($goods_price);

        return view('order_payment', [
            'orders' => $orders,
            'total_price' => $total_price,
        ]);
    }

    public function history_index()
    {
        // order.phpのpublicOrderHistoryが処理される。
        // historiesの値はorder.phpにて処理されたものが帰ってくる
        // 同じ様な処理が複数存在する場合、この様にscope化して使用する。
        $histories = Goods::publicOrderHistory();
        // ddd($histories);
        return view('order_history',compact('histories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        // Eloquentモデル
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->goods_id = $request->goods_id;    
        $order->favorite_switch = $request->favorite_switch; 
        $order->quantity_goods_basket = $request->quantity_goods_basket;
        $order->checked_goods = 0;

        $order->save();
        return redirect('goods');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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

        // Eloquentモデル
        $order = Order::find($id);
        $order->user_id = Auth::user()->id;
        if($request->goods_id != NULL){
            $order->goods_id = $request->goods_id; 
        }
        if($request->favorite_switch != NULL){
            $order->favorite_switch = $request->favorite_switch; 
        }
        if($request->quantity_goods_basket != NULL){
            $order->quantity_goods_basket = $request->quantity_goods_basket;
        }
        

        $order->save();
        return redirect('goods');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $goods = Order::find($id);
        $goods->delete();
        return redirect('order');
    }
}
