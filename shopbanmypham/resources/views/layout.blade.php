<?php
  // use Session;
  use Illuminate\Support\Facades\Session;
  use Illuminate\Support\Facades\DB;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TiTiLux Shop</title>
    <!-- link css -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/sweetalert.css')}}">
    <!-- link font  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Link bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="jquery-3.6.0.min.js"></script>
  </head>
<body>
 
    <div class="container-fluid" id="__next">
        <div class="titi-page-wrapper">
            <!-- Phần header -->

            <div class="titi-page-wrapper--header">
                <!-- Phần header TOP -->
                <div class="header-top">
                    <div class="header-top--phone">
                        <i class="fa-solid fa-phone"></i>
                        <span>039 524 5117</span>
                    </div>

                    <div class="header-top--title"></div>
                </div>
                <!-- Phần header CENTER -->
                <div class="header-center">
                    <div class="header-center--wrapper">
                        <div class="header-center--wrapper__logo">
                            <a href="{{URL::to('/trang-chu')}}" class="logo">
                                <img src="https://cocolux.com/media/images/logo_cocoshop.svg" alt="" srcset="">
                            </a>
                        </div>

                        <form class="header-center--wrapper__search" action="{{URL::to('/tim-kiem')}}" method="post">
                          {{ csrf_field() }}
                            <div class="categories-dropdown dropdown">
                                <div class="toggle"></div>
                                <div class="dropdown-focus show"></div>  
                            </div>
                            <input type="text" name="keywords_submit" placeholder="Tìm sản phẩm bạn muốn" autocomplete="off">
                            <a href="{{URL::to('/tim-kiem')}}" class="icon-search" name="search_item">
                                <img src="https://cocolux.com/media/images/ic-search.svg" alt="tim-kiem" srcset="" title="Tìm Kiếm">
                            </a>
                        </form>

                        <div class="ml-5 header-center--wrapper__item">
                            <div class="header-cart">
                                <a href="{{URL::to('/show-cart')}}">
                                    <img src="https://cocolux.com/media/images/ic-cart.svg" alt="cart" srcset="" title="Giỏ Hàng">
                                    <span class="header-cart-quantity">0</span>
                                </a>
                            </div>
                           
                        </div>

                        <div class="ml-5 header-center--wrapper__account dropdown">
                            <div class="user-avatar">
                                <img src="https://cocolux.com/media/images/ic-account.svg" alt="avatar" srcset="" title="avatar">
                            </div>
                            <div class="not-login">

                              <?php
                                $get_customer = DB::table('tbl_customers');
                                $customer_id = session::get('customer_id');
                                if($customer_id != NULL) {

                              ?>
                                <a href="{{URL::to('/logout-checkout')}}">Đăng Xuất</a>
                               
                                <?php
                                  }else {
                                   
                                ?>
                                 <a href="{{URL::to('/register-checkout')}}">Đăng Ký /</a>
                                 <a href="{{URL::to('/login-checkout')}}">Đăng nhập</a>
                                <?php
                                  }
                                ?>
                                
                            </div>
                        </div>

                        <div class="header-center--wrapper__item item-hotline">
                          <img src="https://cocolux.com/media/images/img_hotline.svg" alt="" srcset="">
                          <span>Hổ trợ
                            <br>
                            khách hàng
                          </span>
                        </div>
                    </div>
                </div>
                <!-- Phần header BOTTOM -->
                <div class="header-bottom">
                    <div class="titi-active-dropdown">
                        <div class="containers">
                            <!-- Phần BOTTOM left -->
                            <div class="header-bottom--left">
                                <div class="header-bottom--left__dropdown">
                                    <i class="fa-solid fa-bars hamburger"></i>
                                    <span>DANH MỤC SẢN PHẨM</span>
                                </div>
                                <div class="header-bottom--left__content">
                                  @foreach ($category as $key => $cate)
                                    
                                
                                    <div class="header-bottom--left__item">
                                        
                                        <a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a>
                                      
                                    </div>
                                    
                                  @endforeach
                                </div>
                            </div>
                            <!-- END Phần BOTTOM left -->

                            <!-- Phần BOTTOM RIGHT -->
                            <div class="header-bottom--right">
                                <div class="header-bottom--right__dropdown">
                                    <a href="{{URL::to('/trang-chu')}}">Trang chủ</a>
                                </div>
                                
                            </div>
                            <div class="header-bottom--right">
                                <div class="header-bottom--right__dropdown">
                                    <a href="/gioithieu">Tin Tức</a>
                                </div>
                                
                            </div>
                            <div class="header-bottom--right">
                                <div class="header-bottom--right__dropdown">
                                    <a href="/gioithieu">Liên Hệ</a>
                                </div>
                                
                            </div>
                            <!-- END Phần BOTTOM RIGHT -->
                        </div>
                    </div>
                </div>
            </div>

           <!-- Phần main -->
            @yield('Content')
            <!-- Phần footer -->
            <div class="footer">
                <footer class="bg-light text-center text-dark">
                    <div class="container p-4">
                      <!-- Section: Social media -->
                      <section class="mb-4">
                        <a class="btn btn-outline-light btn-floating m-1 text-dark" href="#!" role="button"
                          ><i class="fab fa-facebook-f"></i>
                        </a>
                  
                        <a class="btn btn-outline-light btn-floating m-1 text-dark" href="#!" role="button"
                          ><i class="fab fa-twitter"></i>
                        </a>
                  
                        <a class="btn btn-outline-light btn-floating m-1 text-dark" href="#!" role="button"
                          ><i class="fab fa-google"></i
                        ></a>
                  
                        <a class="btn btn-outline-light btn-floating m-1 text-dark" href="#!" role="button"
                          ><i class="fab fa-instagram"></i
                        ></a>
                  
                        <a class="btn btn-outline-light btn-floating m-1 text-dark" href="#!" role="button"
                          ><i class="fab fa-linkedin-in"></i
                        ></a>
                  
                        <a class="btn btn-outline-light btn-floating m-1 text-dark" href="#!" role="button"
                          ><i class="fab fa-github"></i
                        ></a>
                      </section>
                  
                      <!-- Section: Links  -->
                  <section class="">
                    <div class="text-center text-md-start mt-3">
                      <!-- Grid row -->
                      <div class="row">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                          <!-- Content -->
                          <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3"></i> CÔNG TY CỔ PHẦN NAT</h6>
                          <p>
                            Nhà phân phối độc quyền các thương hiệu mỹ phẩm nổi tiếng                 </p>
                        </div>
                
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                          <h6 class="text-uppercase fw-bold mb-4">
                            SẢN PHẨM
                          </h6>
                          <p>
                            <a href="#!" class="text-reset">Mỹ Phẩm</a>
                          </p>
                          <p>
                            <a href="#!" class="text-reset">Skincare</a>
                          </p>
                          <p>
                            <a href="#!" class="text-reset">Chăm sóc da</a>
                          </p>
                        </div>
                
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                
                          <h6 class="text-uppercase fw-bold mb-4">
                            DANH MỤC
                          </h6>
                          <p>
                            <a href="#!" class="text-reset">Hệ thống của hàng</a>
                          </p>
                          <p>
                            <a href="#!" class="text-reset">Tin tức</a>
                          </p>
                          <p>
                            <a href="#!" class="text-reset">Giới thiệu</a>
                          </p>
                        </div>
                
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                          <!-- Links -->
                          <h6 class="text-uppercase fw-bold mb-4">
                            LIÊN HỆ
                          </h6>
                          <p><i class="fas fa-home me-3"></i> Tam Bình, Vĩnh Long</p>
                          <p>
                            <i class="fas fa-envelope me-3"></i> anhthu55138@gmail.com</p>
                          <p><i class="fas fa-phone me-3"></i> + 84 395 245 117</p>
                          <div class="single-widget">
                                <form action="#" class="searchform">
                                    <input type="text" placeholder="Your email address" />
                                    <button type="submit" class="btn btn-default"><i class="fa-solid fa-circle-right"></i></button>
                                    <p>Get the most recent updates from <br />our site and be updated your self...</p>
                                </form>
						                </div>
                        </div>
                
                      </div>
                
                    </div>
                  </section>
                
                    </div>
                
                  
                
                    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                      © 2022 Copyright: thub1910584@student.ctu.edu.vn
                    </div>
                
                  </footer>
            </div>

            <!-- Phần liên hệ thông tin nhanh -->
            <div class="titi-floating-icon__wrapper"></div>

            <!-- phần chat  -->
            <div class="titi-chatbox__wrapper"></div>
            
        </div>

    </div>
    <a id="scrollUp" href="#top" style="position: fixed; z-index: 2147483647;"><i class="fa fa-angle-up"></i></a>
    <script src="{{asset('/public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('/public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('/public/frontend/js/main.js')}}"></script>
    <script src="{{asset('/public/frontend/js/sliderProduct.js')}}"></script>
    <script src="{{asset('/public/frontend/js/details.js')}}"></script>
    {{-- đoạn chạy cục bộ alert trong cart --}}
    <script src="{{asset('/public/frontend/js/sweetalert.js')}}"></script>
    {{-- đoạn dùng alert trong cart --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.js"></script>
    
    <script>
      $('.carousel').carousel({
      interval: 5000
    })
    </script>
<script type="text/javascript">
   $(document).ready(function() {
    $('.send_order').click(function() {
          var shipping_name=$('.shipping_name').val();
          var shipping_email=$('.shipping_email').val();
          var shipping_address=$('.shipping_address').val();
          var shipping_phone=$('.shipping_phone').val();
          var shipping_notes=$('.shipping_notes').val();
          var shipping_method=$('.payment_select').val();
          var order_fee=$('.order_fee').val();
          var order_coupon=$('.order_coupon').val();
          var _token = $('input[name="_token"]').val();
          $.ajax({
            url: "{{url('/confirm-order')}}",
            method: 'POST',
            data:{shipping_name:shipping_name,
              shipping_email:shipping_email, shipping_address: shipping_address,
              shipping_phone:shipping_phone,shipping_notes:shipping_notes,shipping_method:shipping_method,
              order_fee:order_fee,order_coupon:order_coupon,
              _token:_token},
            success: function(data){
               alert('Đặt hàng thành công')
            }
          });
         
        });
   })
</script>


<script type="text/javascript">
  $(document).ready(function() {
    $('.choose').on('change',function() {
        var action = $(this).attr('id');
        var ma_id = $(this).val();
        var _token = $('input[name="_token"]').val();
        var result =''; 

        if(action=='city'){
            result = 'province';

        }else{
            result = 'wards';
        }
        $.ajax({
            url: "{{url('/select-delivery-home')}}",
            method: 'POST',
            data:{action:action,ma_id:ma_id,_token:_token},
            success: function(data){
                $('#'+ result).html(data);
            }
        });
      });
  });

</script>

<script type="text/javascript">
     $(document).ready(function() {
        $('.calculate_delivery').click(function() {
          var matp=$('.city').val();
          var maqh=$('.province').val();
          var xaid=$('.wards').val();
          var _token = $('input[name="_token"]').val();
          if(matp==''&& maqh==''&& xaid==''){
            alert('Vui lòng nhập địa chỉ vận chuyển')
          }else{
            $.ajax({
              url: "{{url('/calculate-fee')}}",
              method: 'POST',
              data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
              success: function(){
                 location.reload();
              }
            });
          }
        });
     });

</script>

</body>
</html>