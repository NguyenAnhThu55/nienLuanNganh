@extends('layout')
@section('Content') 
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb mb-0">
              <li><a href="{{ url('/') }}">Trang Chủ</a></li>
              <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div><!--/breadcrums-->
       <div class="row">
        <div class="col-sm-7">
            <div class="review-payment">
                <h2 class="m-0 mb-1 title text-center mt-2">Xem lại giỏ hàng</h2>
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
                                    <input type="number" class="cart_quantity_input"  value="{{ $v_content->qty}}" min="1" name="cart_quantity">
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
           
        </div>
        <div class="col-sm-5">
            {{-- chọn tinht thành để tính ship phù hợp --}}
            <form>
                {{ csrf_field() }}
                <div class="form-group">
                    <b>Chọn Tỉnh/Thành Phố</b>
                    <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                        <option value="">--Chọn Tỉnh/Thành Phố--</option>
                        @foreach ($city as $key => $ci)
                            <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <b>Chọn Quận/Huyện</b>
                    <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                        <option value="">--chọn Quận/Huyện--</option>
                    </select>
                </div>

                <div class="form-group">
                    <b>Chọn Xã/Phường/Thị Trấn</b>
                    <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                        <option value="">--Chọn Xã/Phường/Thị Trấn--</option>
                    </select>
                </div>
                <input type="button" value="tính phí vận chuyển" name="send_order" class="btn bg-warning calculate_delivery">
            </form>
        </div>
       </div>
        

        <div class="register-req mt-0">
            <p>Vui lòng đăng ký hoặc đăng nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng!</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-6">
                    {{-- <div class="bill-to"> --}}
    
                            
                        <section id="do_action">
                            <div class="">
                                <div class="heading">
                                    <h2 class="title text-center mt-2">Thông Tin Chi Tiết</h2>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="total_area">
                                            <ul>
                                                <li>Tổng: 
                                                    <b> 
                                                        {{Cart::priceTotal(0,',','.').'₫'}}
                                                    </b>
                                                </li>
                                                <li>Thuế:  <b> {{Cart::tax(0,',','.').'₫'}}</b> (0%)</li>
                                                @if (Session::get('fee'))
                                                    <li>
                                                        <a class="delete" href="{{url('/del-fee')}}"><i class="fa fa-times"></i></a>
                                                        Phí vận chuyển: <b>{{number_format(Session::get('fee'),0,',','.').'₫'}}</b>
                                                    </li>
                                                @endif
                                            </ul>
                                                {{-- <a class="btn btn-default update" href="">Update</a>
                                                <a class="btn btn-default check_out" href="">Check Out</a> --}}
                                            
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="cart-confirm">
                                            <div class="cart-confirm--label">
                                                <div class="confirm--label_item">
                                                    <span>Tổng tiền thanh toán</span>
                                                    <p>
                                                        <?php
                                                          // CHƯA LẤY RA ĐƯỢC TỔNG TIỀN CẦN PHẢI TRẢ KHÔNG DỪNG PHÉP TÍNH VÔ ĐÂY ĐC 
                                                            
                                                            $total = Cart::total();
                                                            $feeship = Session::get('fee');
                                                            // $t = $total+$feeship;
                                                            $sub= (((int)$feeship/1000) + (int)$total);
                                                           
                                                        ?>
                                                        <b>{{number_format($sub ,0,',','.')}}.000 ₫</b>
                                                    </p>
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                           
                        </div>
                        
                        <div class="col-sm-6">
                            {{-- điền thông tin đơn hàng --}}
                            <b>Điền Thông Tin Nhận Hàng</b>
                            <div class="form-one w-100">
                                <form method="post" action="{{url('/save-checkout-customer')}}">
                                    {{ csrf_field() }}
                                    <input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và Tên">
                                    <input type="text" name="shipping_email" class="shipping_email" placeholder="Email*">
                                    <input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ">
                                    <input type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại">
                                    <textarea name="shipping_notes" class="shipping_notes w-100"  placeholder="Ghi chú đơn hàng của bạn khi nhận hàng..." rows="2"></textarea>
                                    {{-- nếu có phí --}}
                                    @if (Session::get('fee'))
                                        <input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
                                    
                                    @else
                                        <input type="hidden" name="order_fee" class="order_fee" value="30000">
                
                                    @endif
                                    {{-- nếu có mã giảm giá --}}
                                    @if (Session::get('coupon'))
                                        @foreach (Session::get('coupon') as $key => $cou)
                                        
                                            <input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
                                        @endforeach
                                    
                                    @else
                                        <input type="hidden" name="order_coupon" class="order_coupon" value="0">
                
                                    @endif 
                                    
                                    
                                    
                                    {{--payment option --}}
                                    <div class="form-group">
                                        <b>Chọn Hình thức thanh toán</b>
                                        <select  name="shipping_method" id="" class="form-control input-sm m-bot15 shipping_method">
                                            <option value="1">Thanh toán khi nhận hàng</option>
                                            <option value="0">Thanh toán qua ATM</option>
                                            
                                        </select>
                                    </div>
                                    
                                    <input type="submit" value="Xác nhận đơn hàng" name="send_order" class="btn bg-warning send_order">
                
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
       
        
    
    </div>
</section>
@endsection