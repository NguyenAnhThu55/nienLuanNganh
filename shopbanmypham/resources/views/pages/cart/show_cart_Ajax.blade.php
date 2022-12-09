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
                   <?php 
                        print_r(Session::get('cart'));
                    ?> 
                  <tr>
                    
                    <td>
                        <div class="cart-product">
                            {{-- <div class="cart-product--thumb">
                                <img src="" alt="">
                            </div>
                            <div class="cart-product--body">
                                <div class="cart-product--body__subtitle">
                                   
                                </div>
                            </div> --}}
                        </div>
                    </td>
                    <td></td>
                    <td class="cart-product--quantity">
                        {{-- <form action="" method="post">
                          
                            <input type="number" class="cart_quantity_input" value="" min="1" name="cart_quantity">
                            <input type="hidden" value="" name="rowId_cart" class="form-control">
                            <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-outline-secondary">
                        </form> --}}
                    </td>
                    <td>
                      
                    </td>
                    <td class="justify-content-center"><a onclick="return confirm(' Bạn có chắc chắn muốn xóa !');" href="" data-toggle="tooltip" data-placement="" title="Xóa"><i class="fa-solid fa-trash text-secondary"></i></a></td>
                  </tr>
             
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
                                        
                                    </b>
                                </li>
                                <li>Thuế:  <b> </b> (0%)</li>
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
                                    <p></p>
                                </div>
                              

                              

                             
                               <a href="" class="btn bg-warning text-light">THANH TOÁN</a>
                              
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
    </div>
</div>
@endsection