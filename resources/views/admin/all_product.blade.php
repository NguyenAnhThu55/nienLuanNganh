@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt Kê Thương Hiệu Sản Phẩm
      </div>
      <div class="row w3-res-tb">
        <?php
            $message = Session::get('message');
            if($message){
                echo '<h3 class="alert text-success bg-dark">' . $message . '</h3>';
                session::put('message', null);
            }
        ?>
      
        <div class="col-sm-8">
        </div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th style="width:20px;">
                STT
              </th>
              <th>Tên Sản Phẩm</th>
              <th>Thư viện ảnh</th>
              <th>Giá Sản Phẩm</th>
              <th>Số Lượng kho</th>
              {{-- <th>SLSP đã bán</th> --}}
              <th>Hình Sản Phẩm</th>
              <th>Danh Mục Sản Phẩm</th>
              <th>Thương Hiệu Phẩm</th>
              <th>Tùy Chọn</th>
              
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 0 ?>
            @foreach ( $all_product as $key => $pro)
              <?php $i++?>
           
            <tr>
              <td>{{$i}}</td>
              <td>{{$pro->product_name}} </td>
              <td><a href="{{url('add-gallery/'.$pro->product_id)}}">Thêm ảnh</a> </td>
              <td>{{$pro->product_price}} </td>
              <td>{{$pro->product_quantity}} </td>
              {{-- <td>{{$pro->product_sold}} </td> --}}
              <td><img src="{{('public/image/'.$pro->product_image)}}" altwidth="100" height="100"></td>
              <td>{{$pro->category_name}} </td>
              <td>{{$pro->brand_name}} </td>
              <td>
                <span class="text-ellipsis">
                  <?php
                    if($pro->product_status == 0) {
                  ?>

                    <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"><span>Ẩn</span></a>
                  
                  <?php
                     }else {
                   ?> 

                      <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><span>Hiển Thị</span></a>
                   
                   <?php
                      }
                  ?> 
                </span>
              </td>
             
              <td>
                <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active" style="font-size: 18px;" ui-toggle-class="">
                    <i class="fa-solid fa-square-pen text-success text-active"></i>
                </a>
                <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active" style="font-size: 18px;" ui-toggle-class="">
                  <i class="fa fa-times text-danger text"></i>
              </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            {{-- <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small> --}}
          </div>
          {{-- <nav aria-label="Page navigation"> --}}
            
            {!!$all_product->appends(request()->all())->links()!!}
          {{-- </nav> --}}
        </div>
      </footer>
    </div>
  </div>
@endsection