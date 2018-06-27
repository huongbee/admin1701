@extends('layout') @section('content')
<div class="panel panel-default">
    <div class="panel-heading">
    <b>Cập nhật sản phẩm <i>{{$product->name}}</i></b>
    </div>
    <div class="panel-body">
        <form action="">
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
                        <select  class="form-control" name="name">
                            <option value="">----Chọn loại ----</option>
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
                        <textarea class="form-control"  rows="10" name="promotion">{{$product->promotion}}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Chi tiết:</label>
                        <textarea class="form-control" name="detail" rows="10">{{$product->detail}}</textarea>
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
                    <label><input type="checkbox" name="status" @if($product->status==1) checked @endif> Sản phẩm đặc biệt</label>
                    
                </div>
                <div class="col-md-3">
                        <label><input type="checkbox" name="new" @if($product->new==1) checked @endif> Sản phẩm mới</label>
                        
                    </div>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
</div>
@endsection