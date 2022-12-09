@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông tin khách hàng
      </div>
        <?php
          $message = Session::get('message');
          if($message){
              echo '<h3 class="alert text-success bg-dark">' . $message . '</h3>';
              session::put('message', null);
          }
        ?>
      
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
             
              <th>Tên khách hàng</th>
              <th>số điện thoại</th>
              <th>email</th>
            
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
           
            <tr>
             
              <td> {{$customer->customer_name}} </td>
              <td> {{$customer->customer_phone}} </td>
              <td> {{$customer->customer_email}} </td>
              
            </tr>
          </tbody>
        </table>
    
    </div>
</div>
<br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin vận chuyển
    </div>
      <?php
        $message = Session::get('message');
        if($message){
            echo '<h3 class="alert text-success bg-dark">' . $message . '</h3>';
            session::put('message', null);
        }
      ?>
    
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
           
            <th>Tên người vận chuyển</th>
            <th>Địa chỉ</th>
            <th>số điện thoại</th>
            <th>Ghi chú</th>
            <th>Phương thức thanh toán</th>
          
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
           
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_address}}</td>
            <td> {{$shipping->shipping_phone}} </td>
            <td> {{$shipping->shipping_notes}} </td>
            <td> 
              <?php
              if($shipping->shipping_method== 1){

              ?>
              <span>Thanh toán khi nhận hàng</span>
              <?php
              }else {
              ?>
              <span>Thanh toán qua thẻ ATM</span>
               <?php 
              }
              ?>
            </td> 
            
          </tr>
        </tbody>
      </table>
  
  </div>
</div>
<br>


  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê Chi tiết Đơn Hàng
    </div>
      <?php
        $message = Session::get('message');
        if($message){
            echo '<h3 class="alert text-success bg-dark">' . $message . '</h3>';
            session::put('message', null);
        }
      ?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              STT
            </th>
            <th>Tên sản phẩm</th>
            <th>số lượng kho còn</th>
            <th>số lượng</th>
            <th>giá</th>
            <th>Tổng tiền</th>
            <th>Thời gian</th>
          
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>  
          @php
            $i = 0;
            $total =0;
          @endphp  
          @foreach ($order_detail as $key => $details)
          @php
            $i++;
            $subtotal = $details->product_price*$details->product_sales_quantity;
            $total+=$subtotal;
          @endphp
          <tr class="color_qty_{{$details->product_id}}">
            <td>{{$i}}</td>
            <td>{{$details->product_name}} </td>
            <td>{{$details->product->product_quantity}}</td> 
            <td>
              <input 
                class="order_qty_{{$details->product_id}}" 
                type="number" min="1" {{$order_status==2 ? 'disabled' : ''}} style="width:40px;" 
                value="{{$details->product_sales_quantity}}" 
                name= "product_sales_quantity">

                <input class="order_qty_storage_{{$details->product_id}}" 
                type="hidden" value="{{$details->product->product_quantity}}" 
                name="order_qty_storage">

                <input class="btn-default" 
                class="order_product_id" 
                type="hidden" style="width:40px;" 
                value="{{$details->product_id}}" 
                name= "order_product_id">

              <input class="btn-default order_code" 
                type="hidden" value="{{$details->order_id}}" 
                name="order_id">
              
              
              @if ($order_status!=2)
              <button class="btn btn-default update_quantity_order" 
                data-product_id="{{$details->product_id}}" 
                name="update_quantity_order">
                <i class="fas fa-pencil-alt"></i>
              </button>
                
              @endif
            </td>
            <td>{{number_format($details->product_price)}}</td> 
            <td>{{number_format($details->product_price*$details->product_sales_quantity)}}</td>
            <td>{{$details->created_at}}</td> 
          </tr>
            
          @endforeach   
         
          <tr>
            <td></td>
            <td>
              <b>Tổng:
                
               <span>{{number_format($total ,0,',','.')}} ₫</span>
                </b>

                <div>phí ship:
                  <?php
               
                    
                  
                    $feeship = Session::get('fee');
                    // $t = $total+$feeship;
                    // echo ($feeship).'₫';
                   
                ?>
                   <span>{{number_format($feeship ,0,',','.')}} ₫</span>
                  </div>

              <div>
                <b>
                Thanh toán:
                  <?php
      
              $feeship = Session::get('fee');
              // $t = $total+$feeship;
              $sub= (((int)$feeship) + (int)$total);
             
          ?>
                </b>

                <b>{{number_format($sub ,0,',','.')}} ₫</b>

            </div>
          </td>
          </tr>
          <tr>
            <td colspan="5">
              @if ($details->order_status == 1)
                <form action="">
                  {{ csrf_field() }}
                  <select class="order_details">
                    <option value="">--tình trạng đơn hàng--</option>
                    <option id="{{$details->order_id}}" selected  value="1">Chưa xử lý</option>
                    <option id="{{$details->order_id}}" value="2" >Đã Xử Lý - Đã giao hàng</option>
                    <option id="{{$details->order_id}}" value="3">Hủy giao hàng - Tạm giữ</option>
                  </select>
                </form>

                @elseif ($details->order_status == 2)
                <form action="">
                  {{ csrf_field() }}
                  <select class="order_details">
                    
                    <option value="">--tình trạng đơn hàng--</option>
                    <option id="{{$details->order_id}}" value="1">Chưa xử lý</option>
                    <option id="{{$details->order_id}}" selected value="2" >Đã Xử Lý - Đã giao hàng</option>
                    <option id="{{$details->order_id}}" value="3">Hủy giao hàng - Tạm giữ</option>
                  </select>
                </form>
                @elseif ($details->order_status == 3)
                <form action="">
                  {{ csrf_field() }}
                  <select class="order_details">
                    <option value="">--tình trạng đơn hàng--</option>
                    <option id="{{$details->order_id}}" value="1">Chưa xử lý</option>
                    <option id="{{$details->order_id}}" value="2" >Đã Xử Lý - Đã giao hàng</option>
                    <option id="{{$details->order_id}}" selected value="3">Hủy giao hàng - Tạm giữ</option>
                  
                  </select>
                </form>
              @else
              <form action="">
                {{ csrf_field() }}
                <select class="order_details">
                  <option value="">--tình trạng đơn hàng--</option>
                  <option id="{{$details->order_id}}" value="1">Chưa xử lý</option>
                  <option id="{{$details->order_id}}" value="2" >Đã Xử Lý - Đã giao hàng</option>
                  <option id="{{$details->order_id}}" value="3">Hủy giao hàng - Tạm giữ</option>
                
                </select>
              </form>

            @endif
              
            </td>
          </tr>
      
        </tbody>
      </table>
    </div>
    
  </div>
  <a target="blank" href="{{url('/print-order/'.$details->order_id)}}">In đơn hàng</a>
@endsection