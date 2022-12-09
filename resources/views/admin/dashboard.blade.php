@extends('admin_layout')
@section('admin_content')

<div class="container">
    <style>
        .title_thongke{
            text-align: center;
            font-size: 20px;
        }
    </style>
    <div class="row">
        <b class="title_thongke center">Thống kê đơn hàng doanh số</b>
        <form action="" autocapitalize="off">
            @csrf
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-8">
                        <p style="margin-bottom: 10px">Từ ngày: <input type="text" id="datepicker" class="form-control "></p>
                        <input type="button" id="btn-dashboard-filter" class="btn btn-sm mt-1" value="Lọc kết quả">
                    </div>
                    <div class="col-md-4">

                        <p>Format:<br>
                            <select id="format">
                            <option value="mm/dd/yy">mm/dd/yy</option>
                            <option value="yy-mm-dd">yy-mm-dd</option>
                            </select>
                        </p>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-8">
                        <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
                       
                    </div>
                    <div class="col-md-4">

                        <p>Format:<br>
                            <select id="format2">
                            <option value="mm/dd/yy">mm/dd/yy</option>
                            <option value="yy-mm-dd">yy-mm-dd</option>
                            </select>
                        </p>

                    </div>
                </div>
               
                
            <div class="col-md-8">
                <p>
                    Lọc theo:
                    <select class="dashboard-filter form-control" >
                        <option value="">---chọn---</option>
                        <option value="7ngay">Tuần</option>
                        <option value="thangtruoc">Tháng trước</option>
                        <option value="thangnay"> Tháng này</option>
                        <option value="365ngay">365 Ngày qua</option>
                    </select>
                </p>
            
                
            </div>
        </form>

      
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="myfirstchart" style="height: 250px;"></div>
        </div>
    </div>

    {{-- PHẦN THỐNG KÊ TRUY CẬP --}}
    <div class="row">
        <style type="text/css">
            .table.table-bordered.table-dark{
                background-color: #32383e;
            }
            .table.table-bordered.table-dark td{
                color: #ffff;
            }
        </style>
        <b class="title_thongke center">Thống kê truy cập</b>
        <table class="table table-bordered table-dark">
            <thead>
                <tr>
                    <th scope="col">Đang online</th>
                    <th scope="col">Tổng tháng này</th>
                    <th scope="col">Tổng tháng trước</th>
                    <th scope="col">Tổng một năm</th>
                    <th scope="col">Tổng Cập Nhật</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$visitor_count}}</td>
                    <td>{{$visitor_this_month_count}}</td>
                    <td>{{$visitor_last_month_count}}</td>
                    <td>{{ $visitor_year_count}}</td>
                    <td>{{$visitors_total}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection