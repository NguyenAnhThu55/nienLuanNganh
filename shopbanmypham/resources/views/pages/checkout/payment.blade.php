@extends('layout')
@section('Content') 
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{ url('/') }}">Trang Chủ</a></li>
              <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="register-req">
            <p>Vui lòng đăng ký hoặc đăng nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng!</p>
        </div><!--/register-req-->


        <div class="review-payment">
            <h2 class="title text-center mt-3">Xem giỏ hàng</h2>
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
                        <td>{{Cart::subtotal(0).'₫'}}</td>
                        <td class="justify-content-center"><a href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}" data-toggle="tooltip" data-placement="" title="Xóa"><i class="fa-solid fa-trash text-secondary"></i></a></td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <h2 class="title mt-3">Chọn hình thức thanh toán</h2>
        <form action="{{URL::to('/order-place')}}" method="post">
            {{ csrf_field() }}
            <div class="payment-options">
                <span>
                    <label><input type="checkbox" name="payment_option" value="1"> Trả bằng thẻ ATM</label>
                </span>
                <span>
                    <label><input type="checkbox" name="payment_option" value="2">Trả tiền khi nhận hàng</label>
                </span>
                {{-- <span>
                    <label><input type="checkbox"> Paypal</label>
                </span> --}}
                <input style="float: right" type="submit" value="ĐẶT HÀNG" name="send_order_place" class="btn btn-outline-warning">
            </div>
        </form>
    </div>
</section>
@endsection