<!-- これは共通であるlayouts.app.blade.phpのhead部分を呼び出している -->
.@extends('layouts.app')

<!-- ここは共通であるlayouts.app.blade.phpのmain部分の@yield('content')に挿入される -->
@section('content')
<div class="panel-body">

  <!-- バリデーションエラーの表示に使用するエラーファイル-->
  @include('common.errors')

  @if (count($orders) > 0)
  <div class="panel panel-default">
    <h1 class="panel-heading">決済画面</h1>
      <div class="panel-body">
        <table class="table table-striped task-table">
          <!-- テーブルヘッダ -->
          <thead>
            <th>商品名</th>
            <th>商品詳細</th>
            <th>料金</th>
            <th>個数</th>
            <th>カートから取り除く</th>
          </thead>
          <!-- テーブル本体 -->
          <tbody>
            @foreach ($orders as $each_orders)
            <tr>
              <!-- 商品名 -->
              <td class="table-text">
                <div>{{$each_orders->goods->goods_name}}</div>
              </td>
              <!-- 価格 -->
              <td class="table-text">
                <div>{{$each_orders->goods->price}}</div>
              </td>
              <!-- 商品詳細ボタン -->
              <td>
                <form action="/goods/{{$each_orders->goods_id}}" method="GET">
                  @csrf
                  <button type="submit" class="btn btn-primary">商品詳細</button>
                </form>
              </td>
              <!-- 個数表示ボタン -->
              <td>
                <form action="{{ route('order.update',$each_orders->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <input type="number" name="quantity_goods_basket" value="{{ $each_orders->quantity_goods_basket }}"> 
                  <button type="submit" class="btn btn-primary">個数更新</button>
                </form>
              </td>
              <!-- 削除ボタン -->
              <td>
                <form action="{{ route('order.destroy',$each_orders->id) }}" method="POST">
                  @method('delete')
                  @csrf
                  <button type="submit" class="btn btn-danger">削除</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
      </table>
      <!-- 購入確定ボタン -->
      <p>合計金額:{{$total_price}}</p>
      <div>
        <button type="submit" class="btn btn-warning">
          <a href="order_payment">購入を確定する</a>
        </button>
      </div>
    </div>
  </div>
  @else
  <h1>購入する商品にチェックを入れてください。</h1>
  @endif
  </div>
  @endsection