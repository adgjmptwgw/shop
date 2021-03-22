@extends('layouts.app')
@section('content')
<div class="panel-body">
  <div class="col-sm-6">
    @include('common.errors')
    <!-- 商品名 -->
    <div class="form-group">
      <h1>{{$goods->goods_name}}</h1>
    </div>
    <!-- 詳細 -->
    <div class="form-group">
      <p>{{$goods->text}}</p>
    </div>
    <!-- 価格 -->
    <div class="form-group">
      <p>{{$goods->price}}円</p>
    </div>
    <!-- カートに入れるボタン -->
    <form action="{{ route('order.store') }}" method="POST" class="form-horizontal">
      @csrf
      <p><input type="number" name="quantity_goods_basket" id="quantity_goods_basket" class="btn btn-primary" value="1">個数</p>
      
      <p><input type="number" name="goods_id" id="goods_id" class="btn btn-primary" value="{{$goods->id}}" hidden></p>

      <button type="submit" class="btn btn-primary">カートに入れる</button>
    </form>
    <div class="well well-sm">
      <a class="btn btn-link pull-right" href="{{ url()->previous() }}">Back</a>
    </div>
</div>
@endsection