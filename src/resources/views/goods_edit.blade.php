@extends('layouts.app')
@section('content')
<div class="panel-body">
  <div class="col-sm-6">
    @include('common.errors')
    <form action="{{ route('goods.update',$goods->id) }}" method="POST"  class="form-horizontal">
      @method('PUT')
      @csrf
      <!-- 商品名 -->
      <div class="form-group">
        <label for="goods_name">商品名</label>
        <input type="text" id="goods_name" name="goods_name" class="form-control" value="{{$goods->goods_name}}">
      </div>
      <!-- 詳細 -->
      <div class="form-group">
        <label for="text">詳細</label>
        <input type="text" id="text" name="text" class="form-control" value="{{$goods->text}}">
      </div>
      <!-- 料金 -->
      <div class="form-group">
        <label for="price">料金</label>
        <input type="number" id="price" name="price" class="form-control" value="{{$goods->price}}">
      </div>
      <!-- Saveボタン/Backボタン -->
      <div class="well well-sm">
        <button type="submit" class="btn btn-primary">Save</button>
        <a class="btn btn-link pull-right" href="{{ route('goods.index') }}">Back</a>
      </div>
    </form>
  </div>
</div>
@endsection