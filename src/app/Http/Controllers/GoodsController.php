<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Goods;
use App\Models\Order;
use App\Models\User;
use Auth;


class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // --------- 検索機能 ---------------------------------------------
        $goods = Goods::orderBy('updated_at', 'asc')->where(function ($query) {
            // 検索機能
            if ($search = request('search')) {
                $query->where('goods_name', 'LIKE', "%{$search}%")->orWhere('text','LIKE',"%{$search}%");
            } 
         
        // 10投稿毎にページ移動(ページネーション)
        })->paginate(10);

        // --------- お気に入り用ユーザーid ---------------------------------------------
        
        $favorite_user = Auth::user()->id;
        $order_id = Order::get('id');
        // ddd($order_id);
        // Orderテーブルからデータを引っ張ってくる。
        // もし、商品id(gooodsテーブル)とユーザーid(Userテーブル)が商品id,ユーザーid(Orderテーブル)と
        // 同じであればOrderテーブルのidを取り出す。
        
        // --------- 商品データ・お気に入り状態データをViewへ ---------------------------------------------
        return view('goods')->with(
            [
            'goods' => $goods,
            'favorite_user' => $favorite_user,
            'order_id' => $order_id,
            ]);

        // --------- 通常の商品一覧表示 -----------------------------------
        // $goods = Goods::orderBy('updated_at', 'asc')->get();
        // return view('goods', [
        //  'goods' => $goods
        // ]);

    }

    public function shop_manager_index()
    {
        $goods_shop_manager = Goods::where('user_id',Auth::user()->id)
          ->orderBy('updated_at', 'asc')
          ->get();

        return view('goods_shop_manager', [
         'goods_shop_manager' => $goods_shop_manager
        ]);

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
        'goods_name' => 'required|max:30',
        'text' => 'required|max:100',
        'price' => 'required|max:8',
         ]);

        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect('goods_shop_manager')
            ->withInput()
            ->withErrors($validator);
        }
        
        // Eloquentモデル
        $goods = new goods;
        $goods->user_id = Auth::user()->id;

        $goods->goods_name = $request->goods_name;
        $goods->img = 'img';
        $goods->text = $request->text;
        $goods->price = $request->price;
        $goods->review = '4.2';
        $goods->save();

        // ルーティング「goodss.index」にリクエスト送信（一覧ページに移動）
        return redirect('goods_shop_manager');
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
        $goods = Goods::find($id);
        return view('goods_edit',['goods' => $goods]);
    }

    public function details($id)
    {
        $goods = Goods::find($id);
        return view('goods_details',['goods' => $goods]);
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
        'goods_name' => 'required|max:30',
        'text' => 'required|max:100',
        'price' => 'required|max:8',
        ]);

        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
            ->route('goods.edit',$id)
            ->withInput()
            ->withErrors($validator);
        }

        // Eloquentモデル
        $goods = Goods::find($id);
        $goods->goods_name = $request->goods_name;
        $goods->img = 'img';
        $goods->text = $request->text;
        $goods->price = $request->price;
        $goods->review = '4.2';
        $goods->save();
        return redirect('goods_shop_manager');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $goods = Goods::find($id);
        $goods->delete();
        return redirect('goods_shop_manager');
    }
}
