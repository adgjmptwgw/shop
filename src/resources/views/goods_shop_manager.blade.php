<!-- これは共通であるlayouts.app.blade.phpのhead部分を呼び出している -->
.@extends('layouts.app')

<!-- ここは共通であるlayouts.app.blade.phpのmain部分の@yield('content')に挿入される -->
@section('content')
<div class="panel-body">

  <!-- バリデーションエラーの表示に使用するエラーファイル-->
  @include('common.errors')
  
  <!-- タスク登録フォーム -->
  @can('shop_manager_higher')
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
  @if (count($goods_shop_manager) > 0)
  <div class="panel panel-default">
    <div class="panel-heading">出品中リスト</div>
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
            @foreach ($goods_shop_manager as $each_goods)
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
              <!-- 更新ボタン -->
              @can('shop_manager_higher')
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