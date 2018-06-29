@extends('layout') @section('content')
<div class="panel panel-default">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="panel-heading">
        <b>Danh sách sản phẩm thuộc loại
            <i>{{$pageUrl->categories->name}}</i>
        </b>
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Hình</th>
                    <th>Sản phẩm đặc biệt</th>
                    <th>Tuỳ chọn</th>
                </tr>
            </thead>
            <tbody>
                <?php $stt=1;?>
                
                @foreach($products as $p)
                <tr>
                    <td>{{$stt++}}</td>
                    <td>{{$p->name}}</td>
                    <td>{{number_format($p->price)}}</td>
                    <td>
                    <img width="150px" src="admin-master/images/products/{{$p->image}}">
                    </td>
                    <td>
                        <input type="checkbox" @if($p->status==1) checked @endif>
                    </td>
                    <td>
                    <a href="edit/{{$p->id}}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                        </a> |
                        <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i> 
        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{$products->links()}}
    </div>

</div>
@endsection