@extends('layout')
@section('Content') 
<section id="cart_items">
    <div class="container">
        <form action="{{URL::to('/order-place')}}" method="post">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{ url('/') }}">Trang Chủ</a></li>
              <li class="active">Thông tin đơn hàng của bạn</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="review-payment">
            <h2 class="title text-center">Xem giỏ hàng</h2>
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
                                <input type="number" class="cart_quantity_input" readonly value="{{ $v_content->qty}}" min="1" name="cart_quantity">
                                <input type="hidden" value="{{ $v_content->rowId}}" name="rowId_cart" class="form-control">
                               
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

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-7">
                    {{-- <div class="bill-to"> --}}
    
                            
                        <section id="do_action">
                            <div class="">
                                <div class="heading">
                                    <h2 class="title text-center mt-2">Thông Tin Chi Tiết</h2>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
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
                                                <li>
                                                    <div class="confirm--label_item">
                                                        Tổng tiền thanh toán
                                                        <p>
                                                            <?php
                                                              
                                                              $total = Cart::total();
                                                                $feeship = Session::get('fee');
                                                                // $t = $total+$feeship;
                                                                echo (((int)$feeship/1000) + (int)$total).'.'.'000'.'₫';
                                                               
                                                            ?>
                                                        </p>
                                                    </div>
                                                </li>
                                            </ul>
                                                {{-- <a class="btn btn-default update" href="">Update</a>
                                                <a class="btn btn-default check_out" href="">Check Out</a> --}}
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </section>
                           
                        </div>
                        
                        <div class="col-sm-5">
                            {{-- điền thông tin đơn hàng --}}
                            <b>Điền Thông Tin Nhận Hàng</b>
                            @php
                                $infor
                            @endphp
                            <div class="form-one w-100">
                                
                                    <hr>
                                    <div class=" mt-1">
                                        <span>Tên Khách Hàng:</span>
                                        <span><b>{{$shipping->shipping_name}}</b></span>
                                    </div>
                                    <hr>
                                    
                                    <div class=" mt-1">
                                        <span>Số điện thoại:</span>
                                        
                                        <span>{{$shipping->shipping_phone}}</span>
                                    </div>
                                
                                    <hr>
                                    <div class=" mt-1">
                                        <span>địa chỉ:</span>
                                        <span>{{$shipping->shipping_address}}</span>
                                    </div>
                                    
                                    <hr>
                                    <div class=" mt-1">
                                        <span>Phương Thức thanh toán:</span>
                                        <span><b>Thanh toán khi nhận hàng</b></span>
                                    </div>
                                    <hr>
                           
                               
                                {{-- <form >
                                    {{ csrf_field() }}
                                    <input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và Tên">
                                    <input type="text" name="shipping_email" class="shipping_email" placeholder="Email*">
                                    <input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ">
                                    <input type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại">
                                    <textarea name="shipping_notes" class="shipping_notes w-100"  placeholder="Ghi chú đơn hàng của bạn khi nhận hàng..." rows="2"></textarea> --}}
                                    
                                    {{--payment option --}}
                                    {{-- <div class="form-group">
                                        <b>Chọn Hình thức thanh toán</b>
                                        <select  name="shipping_method" id="" class="form-control input-sm m-bot15 shipping_method">
                                            <option value="1">Thanh toán khi nhận hàng</option>
                                            <option value="0">Thanh toán qua ATM</option>
                                            
                                        </select>
                                    </div>
                
                                </form> --}}
                                <input style="float: right" type="submit" value="ĐẶT HÀNG" name="send_order_place" class="btn btn-outline-warning">
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        </form>
    </div>
    </div>
</section>
@endsection

<script type="text/javascript">
    $(document).ready(function() {
        shipping_delivery();
         // lấy dữ liệu ra bằng ajax
        function shipping_delivery() {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/select-shipping')}}",
                method: 'POST',
                data:{_token:_token},
                success: function(data){
                    $('#shipping_delivery').html(data);
                }
            });

        }
    })
</script>