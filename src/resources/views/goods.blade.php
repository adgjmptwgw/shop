<!-- これは共通であるlayouts.app.blade.phpのhead部分を呼び出している -->
.@extends('layouts.app')

<!-- ここは共通であるlayouts.app.blade.phpのmain部分の@yield('content')に挿入される -->
@section('content')
<div class="panel-body">

  <!-- バリデーションエラーの表示に使用するエラーファイル-->
  @include('common.errors')
  
  <!-- 検索窓(bootstrapバージョン) -->
  <form class="form-inline my-2 my-lg-0 ml-2">
      <div class="form-group">
      <input type="search" class="form-control mr-sm-2" name="search" value="{{request('search')}}" placeholder="キーワードを入力" aria-label="検索...">
      </div>
      <input type="submit" value="検索" class="btn btn-info">
  </form> 

  <!-- 検索結果表示 -->
  <div class="d-flex justify-content-center">
        {{ $goods->links() }}
  </div>
  
  <!-- タスク登録フォーム -->
  @can('admin_higher')
  <!-- <form action="/add_goods" method="POST" class="form-horizontal"> -->
  <form action="{{ route('goods.store') }}" method="POST" class="form-horizontal">
    @csrf
    <div class="form-group">
      <!-- 商品名 -->
      <div class="col-sm-6">
        <label for="goods_name" class="col-sm-3 control-label">グッズ名</label>
        <input type="text" name="goods_name" id="goods_name" class="form-control">
      </div>
    <!-- 詳細 -->
      <div class="col-sm-6">
        <label for="text" class="col-sm-3 control-label">詳細</label>
        <input type="text" name="text" id="text" class="form-control">
      </div>
      <!-- 価格 -->
      <div class="col-sm-6">
        <label for="price" class="col-sm-3 control-label">料金</label>
        <input type="number" name="price" id="price" class="form-control">
      </div>
    </div>
    <!-- タスク登録ボタン -->
    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-6">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
    @endcan
  </form>

  <!-- この下に登録済みタスクリストを表示 -->
  @if (count($goods) > 0)
  <div class="panel panel-default">
    <div class="panel-heading">商品リスト</div>
      <div class="panel-body">
        <table class="table table-striped task-table">
          <!-- テーブルヘッダ -->
          <thead>
            <th>商品名</th>
            <th>詳細</th>
            <th>価格</th>
          </thead>
          <!-- テーブル本体 -->
          <tbody>
            @foreach ($goods as $each_goods)
            <tr>
              <td class="table-text">
                <div>{{ $each_goods->goods_name }}</div>
              </td>
              <td class="table-text">
                <div>{{ $each_goods->text }}</div>
              </td>
              <td class="table-text">
                <div>{{ $each_goods->price }}</div>
              </td>
              <!-- 商品詳細ボタン -->
              <td>
                <form action="/goods/{{$each_goods->id}}" method="GET">
                  @csrf
                  <button type="submit" class="btn btn-primary">商品詳細</button>
                </form>
              </td>
              <!-- お気に入りボタン -->
              <td>
                  <favorite-component 
                   :order-id ="{{ $each_goods->order }}"
                   :favorite-id="{{ ($each_goods->id) }}"
                   :favorite-user="{{ ($favorite_user) }}"
                   >
                   </favorite-component>

              </td>
            
              <!-- カートに入れるボタン -->
              <td>
                <form action="{{ route('order.store') }}" method="POST" class="form-horizontal">
                  @csrf
                  <label for="quantity_goods_basket">【個数】</label>
                  <p><input type="number" name="quantity_goods_basket" id="quantity_goods_basket" class="btn btn-primary" value="1"></p>
                  
                  <p><input type="number" name="goods_id" id="goods_id" class="btn btn-primary" value="{{$each_goods->id}}" hidden></p>

                  <button type="submit" class="btn btn-primary">カートに入れる</button>
                </form>
              </td>
            
              <td>
              </td>
              <!-- 更新ボタン -->
              @can('admin_higher')
              <td>
                <form action="{{ route('goods.edit',$each_goods->id) }}" method="GET">
                  @csrf
                  <button type="submit" class="btn btn-primary">更新</button>
                </form>
              </td>
              <td>
              <!-- 削除ボタン -->
                <!-- <form action="goods_delete/{id}" method="POST"> -->
                <form action="{{ route('goods.destroy',$each_goods->id) }}" method="POST">
                  @method('delete')
                  @csrf
                  <button type="submit" class="btn btn-danger">削除</button>
                </form>
              </td>
              @endcan
            </tr>
            @endforeach
          </tbody>
      </table>
    </div>
  </div>
  @endif
  </div>
  @endsection