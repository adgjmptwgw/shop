<!-- これは共通であるlayouts.app.blade.phpのhead部分を呼び出している -->
.@extends('layouts.app')

<!-- ここは共通であるlayouts.app.blade.phpのmain部分の@yield('content')に挿入される -->
@section('content')
<div class="panel-body">

  <!-- バリデーションエラーの表示に使用するエラーファイル-->
  @include('common.errors')
 
   <!-- この下に登録済みタスクリストを表示 -->
  @if (count($histories) > 0)
  <div class="panel panel-default">
    <div class="panel-heading">商品リスト</div>
      <div class="panel-body">
        <table class="table table-striped task-table">
          <!-- テーブルヘッダ -->
          <thead>
            <th>商品名</th>
            <th>詳細</th>
            <th>価格</th>
            <th>購入日</th>
          </thead>
          <!-- テーブル本体 -->
          <tbody>
            @foreach ($histories as $goods_history)
            <tr>
              <td class="table-text">
                <div>{{ $goods_history->goods_name }}</div>
              </td>
              <td class="table-text">
                <div>{{ $goods_history->text }}</div>
              </td>
              <td class="table-text">
                <div>{{ $goods_history->price }}</div>
              </td>
              <td class="table-text">
                <!-- Goods.phpのgetCreatedAtFormatAttribute()で処理された単位で表示される。 -->
                <div>{{ $goods_history->CreatedAt_format }}</div>
              </td>
            </tr>
            @endforeach
          </tbody>
      </table>
    </div>
  </div>
  @endif
  </div>
  @endsection