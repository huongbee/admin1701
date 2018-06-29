@extends('layout') @section('content')
<script src="ckeditor/ckeditor.js"></script>
<style>
    .cke_chrome{
        border: 1px solid #d1d1d1 !important
    }
</style>
<div class="panel panel-default">
    
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="panel-heading">
    <b>Cập nhật sản phẩm <i>{{$product->name}}</i></b>
    </div>
    <div class="panel-body">
        <form action="/edit" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$product->id}}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Tên sản phẩm:</label>
                        <input type="text" class="form-control" name="name" value="{{$product->name}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Tên sản phẩm:</label>
                        <select  class="form-control" name="id_type">
                            <option value="">----Chọn loại ----</option>
                            @foreach($type as $t)
                            <option @if($t->id==$product->id_type) selected @endif value="{{$t->id}}">{{$t->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Đơn giá:</label>
                        <input type="text" class="form-control" name="price" value="{{$product->price}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Giá khuyến mãi:</label>
                        <input type="text" class="form-control" name="promotion_price" value="{{$product->promotion_price}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Thông tin khuyến mãi:</label>
                        <textarea class="form-control"  id="promotion"
                        name="promotion">{{$product->promotion}}</textarea>
                    </div>
                    <script>CKEDITOR.replace('promotion')</script>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Chi tiết:</label>
                        <textarea class="form-control" name="detail" id="detail">{{$product->detail}}</textarea>
                        <script>CKEDITOR.replace('detail')</script>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input type="file" name="image">
                    <br><br>
                    <img width="150px" src="admin-master/images/products/{{$product->image}}">
                </div>
                <div class="col-md-3">
                    <label><input type="checkbox" name="status" value="1" @if($product->status==1) checked @endif> Sản phẩm đặc biệt</label>
                    
                </div>
                <div class="col-md-3">
                        <label><input type="checkbox" name="new" value="1" @if($product->new==1) checked @endif> Sản phẩm mới</label>
                        
                    </div>
            </div><br><br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection