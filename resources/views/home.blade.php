@extends('layout') @section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
<style>
    body {
        font-size: 16px
    }

    .ui-state-active a,
    .ui-state-active a:link,
    .ui-state-active a:visited {
        color: #fff
    }

    .ui-state-default,
    .ui-widget-content .ui-state-default,
    .ui-widget-header .ui-state-default {
        border: 0px solid #22bacf !important;
    }

    .ui-state-default,
    .ui-widget-content .ui-state-default,
    .ui-widget-header .ui-state-default {
        border-radius: 0% !important
    }

    ui-state-active,
    .ui-widget-content .ui-state-active,
    .ui-widget-header .ui-state-active,
    a.ui-button:active,
    .ui-button:active,
    .ui-button.ui-state-active:hover {
        background: #003eff !important;
    }
</style>
<div class="panel panel-default">
    <div class="panel-heading">
        <b>Danh sách đơn hàng</b>
    </div>
    <div class="panel-body">
        <div id="tabs">
            <ul>
                <li>
                    <a href="#tabs-1">Đơn hàng đã xác nhận</a>
                </li>
                <li>
                    <a href="#tabs-2">Đơn hàng chưa xác nhận</a>
                </li>
                <li>
                    <a href="#tabs-3">Đơn hàng đã hoàn tất</a>
                </li>
            </ul>
            <div id="tabs-1">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền (vnd)</th>
                            <th>Ghi chú</th>
                            <th>Sản phẩm</th>
                            <th>Đã giao</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($daXacNhan as $bill)
                        <tr>
                            <td>DH000{{$bill->id}}</td>
                            <td>{{date('d-m-Y',strtotime($bill->date_order))}}</td>
                            <td>{{number_format($bill->promt_price)}}</td>
                            <td>{{$bill->note}}</td>
                            <td>
                                @foreach($bill->products as $p)
                                    <li>{{$p->name}}</li>
                                @endforeach

                            </td>
                            <td><input type="checkbox" class="update-status"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="tabs-2">
                    <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền (vnd)</th>
                                    <th>Ghi chú</th>
                                    <th>Sản phẩm</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($chuaXacNhan as $bill)
                                <tr>
                                    <td>DH000{{$bill->id}}</td>
                                    <td>{{date('d-m-Y',strtotime($bill->date_order))}}</td>
                                    <td>{{number_format($bill->promt_price)}}</td>
                                    <td>{{$bill->note}}</td>
                                    <td>
                                        @foreach($bill->products as $p)
                                            <li>{{$p->name}}</li>
                                        @endforeach
        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
            </div>
            <div id="tabs-3">
                    <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền (vnd)</th>
                                    <th>Ghi chú</th>
                                    <th>Sản phẩm</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($daHoantat as $bill)
                                <tr>
                                    <td>DH000{{$bill->id}}</td>
                                    <td>{{date('d-m-Y',strtotime($bill->date_order))}}</td>
                                    <td>{{number_format($bill->promt_price)}}</td>
                                    <td>{{$bill->note}}</td>
                                    <td>
                                        @foreach($bill->products as $p)
                                            <li>{{$p->name}}</li>
                                        @endforeach
        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
            </div>
        </div>

    </div>
</div>
@endsection @section('title','Home')