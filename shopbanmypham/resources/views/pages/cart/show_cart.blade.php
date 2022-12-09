@extends('layout')
@section('Content') 
<?php
     use Illuminate\Support\Facades\Session;

?>
<!-- Phần Main -->
<div class="container">
    <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="{{ url('/') }}">Trang Chủ</a></li>
          <li class="active">Giỏ hàng</li>
        </ol>
    </div>
    <div class="cart-wrap">
        <div class="cart-title">
            <h2 class="title text-center mt-3">Giỏ hàng (0 sản phẩm)</h2>
        </div>

        <div class="table-responsive">
            <?php
            $content = Cart::content();
            ?>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Sản Phẩm</th>
                    <th scope="col">Giá Sản Phẩm</th>
                    <th scope="col">số lượng</th>
                    <th scope="col">thành tiền</th>
                    <th scope="col">tùy chọn</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($content as $key => $v_content)
                        
                    
                  <tr>
                    
                    <td>
                        <div class="cart-product">
                            <div class="cart-product--thumb">
                                <img src="{{URL::to('public/image/'. $v_content->options->image)}}" alt="">
                            </div>
                            <div class="cart-product--body">
                                <div class="cart-product--body__subtitle">
                                    {{ $v_content->name}}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>{{ number_format($v_content->price).'₫'}}</td>
                    <td class="cart-product--quantity">
                        <form action="{{URL::to('/update-cart-quantity/')}}" method="post">
                            {{ csrf_field() }}
                            <input type="number" class="cart_quantity_input" value="{{ $v_content->qty}}" min="1" name="cart_quantity">
                            <input type="hidden" value="{{ $v_content->rowId}}" name="rowId_cart" class="form-control">
                            <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-outline-secondary">
                        </form>
                    </td>
                    <td>
                        <?php
                            $subtotal = $v_content->price*$v_content->qty;
                            echo number_format($subtotal).'₫';
                        ?>
                    </td>
                    <td class="justify-content-center"><a onclick="return confirm(' Bạn có chắc chắn muốn xóa !');" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}" data-toggle="tooltip" data-placement="" title="Xóa"><i class="fa-solid fa-trash text-secondary"></i></a></td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
        {{-- NÚT ĐẶT HÀNG --}}
        
        {{-- Đang text --}}
     
        <section id="do_action">
            <div class="container">
                <div class="heading">
                    <h2 class="title text-center mt-2">Thông Tin Chi Tiết</h2>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="total_area">
                            <ul>
                                <li>Tổng: 
                                    <b> 
                                        {{Cart::priceTotal(0,',','.').'₫'}}
                                    </b>
                                </li>
                                <li>Thuế:  <b> {{Cart::tax(0,',','.').'₫'}}</b> (0%)</li>
                                <li>Phí vận chuyển: <b> FREE</b></li>
                            </ul>
                                {{-- <a class="btn btn-default update" href="">Update</a>
                                <a class="btn btn-default check_out" href="">Check Out</a> --}}
                            
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="cart-confirm">
                            <div class="cart-confirm--label">
                                <div class="confirm--label_item">
                                    <span>Tổng tiền hàng bạn cần thanh toán</span>
                                    <p>{{Cart::total(0,',','.').'₫'}}</p>
                                </div>
                              

                               <?php
                              
                               $customer_id = session::get('customer_id');
                               if($customer_id != NULL) {

                             ?>
                               <a href="{{URL::to('/checkout')}}" class="btn bg-warning text-light">THANH TOÁN</a>
                              
                               <?php
                                 }else {
                                  
                               ?>
                                 <a href="{{URL::to('/login-checkout')}}" class="btn bg-warning text-light">THANH TOÁN</a>
                               <?php
                                 }
                               ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    </div>
</div>
@endsection