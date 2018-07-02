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
                    <a class="delete-product" data-toggle="modal" data-target="#myModal" idsp="<?=$p->id?>" namesp="{{$p->name}}"><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i> </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{$products->links()}}
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Xoá sản phẩm</h4>
        </div>
        <div class="modal-body">
          <p style="font-size:18px">Bạn có chắc chắn xoá <b><i id="product-name">...</i></b> hay không?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnOK">OK</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
        </div>
      </div>
    </div>
</div>
<script src="admin-master/js/jquery.js"></script>
<script>
    $(document).ready(function(){
        $('.delete-product').click(function(){
            var idsp = $(this).attr('idsp')
            var namesp = $(this).attr('namesp')
            $('#product-name').html(namesp)
            $('#btnOK').click(function(){
                if(idsp!=null){
                    $.ajax({
                        url:"{{route('delete-product')}}",
                        type:"POST",
                        data:{
                            id:idsp,
                            _token:"{{csrf_token()}}"
                        },
                        success:function(res){
                            console.log(res)
                            idsp = null
                        },
                        error:function(){
                            alert('Vui lòng thử lại.')
                            idsp = null
                        }
                        
                    })
                }
            })
        })
    })
</script>
@endsection