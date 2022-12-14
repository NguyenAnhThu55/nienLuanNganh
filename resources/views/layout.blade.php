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
    <title>COCO</title>
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
            <!-- Ph???n header -->

            <div class="titi-page-wrapper--header">
                <!-- Ph???n header TOP -->
                <div class="header-top">
                    <div class="header-top--phone">
                      {{-- <div class=""> --}}
                        <i class="fa-solid fa-phone header-top__phonei"></i>
                        <span class="header-top__phone--span">039 524 5117</span>
                      {{-- </div> --}}
                        {{-- ph???n ?????i ti???ng --}}
                        {{-- <div class="btn-group" style="float: left">
                          <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                            <i class="fas fa-globe-europe" style="font-size:18px"></i>
                            
                            Lang
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu">
                            <li style="margin-left: 10px;"><a href="{{url('lang/vi')}}">VietNamese</a></li>
                            <li style="margin-left: 10px;"><a href="{{url('lang/en')}}">Engligh</a></li>
                          </ul>
                        </div> --}}
                    </div>

                    <div class="header-top--title"></div>
                </div>
                <!-- Ph???n header CENTER -->
                <div class="header-center">
                    <div class="header-center--wrapper">
                        <div class="header-center--wrapper__logo">
                            <a href="{{URL::to('/trang-chu')}}" class="logo">
                                <img style="width:100px" src="{{asset('/public/frontend/image/logo_cocoshop.jpg')}}" alt="" srcset="">
                            </a>
                        </div>

                        <form class="header-center--wrapper__search" action="{{URL::to('/tim-kiem')}}" method="post">
                          {{ csrf_field() }}
                            <div class="categories-dropdown dropdown">
                                <div class="toggle"></div>
                                <div class="dropdown-focus show"></div>  
                            </div>
                            <input type="text" name="keywords_submit" placeholder="T??m s???n ph???m b???n mu???n" autocomplete="off">
                            <a href="{{URL::to('/tim-kiem')}}" class="icon-search" name="search_item">
                                <img src="{{asset('/public/frontend/image/ic-search.svg')}}" alt="tim-kiem" srcset="" title="T??m Ki???m">
                            </a>
                        </form>

                        <div class="ml-5 header-center--wrapper__item">
                            <div id="show_cart_quantity" class="mt-1"></div>
                           
                        </div>

                        <div class="ml-5 header-center--wrapper__account dropdown">
                            <div class="user-avatar">
                                <img src="{{asset('/public/frontend/image/ic-account.svg')}}" alt="avatar" srcset="" title="avatar">
                            </div>
                            <div class="not-login">

                              <?php
                                $get_customer = DB::table('tbl_customers');
                                $customer_id = session::get('customer_id');
                                if($customer_id != NULL) {

                              ?>
                                <a href="{{URL::to('/logout-checkout')}}">????ng Xu???t</a>
                               
                                <?php
                                  }else {
                                   
                                ?>
                                 <a href="{{URL::to('/register-checkout')}}">????ng K?? /</a>
                                 <a href="{{URL::to('/login-checkout')}}">????ng nh???p</a>
                                <?php
                                  }
                                ?>
                                
                            </div>
                        </div>

                        <div class="header-center--wrapper__item item-hotline">
                          <img src="{{asset('/public/frontend/image/img_hotline.svg')}}" alt="" srcset="">
                          <span>H??? tr???
                            <br>
                            kh??ch h??ng
                          </span>
                        </div>


                    </div>
                </div>
                <!-- Ph???n header BOTTOM -->
                <div class="header-bottom">
                    <div class="titi-active-dropdown">
                        <div class="containers">
                            <!-- Ph???n BOTTOM left -->
                            <div class="header-bottom--left">
                                <div class="header-bottom--left__dropdown">
                                    <i class="fa-solid fa-bars hamburger"></i>
                                    <span>DANH M???C S???N PH???M</span>
                                </div>
                                <div class="header-bottom--left__content">
                                  @foreach ($category as $key => $cate)
                                    
                                
                                    <div class="header-bottom--left__item">
                                        
                                        <a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a>
                                      
                                    </div>
                                    
                                  @endforeach
                                </div>
                            </div>
                            <!-- END Ph???n BOTTOM left -->

                            <!-- Ph???n BOTTOM RIGHT -->
                            <div class="header-bottom--right">
                                <div class="header-bottom--right__dropdown">
                                    <a href="{{URL::to('/trang-chu')}}">Trang ch???</a>
                                </div>
                                
                            </div>
                            <div class="header-bottom--right">
                                <div class="header-bottom--right__dropdown">
                                    <a href="/gioithieu">Tin T???c</a>
                                </div>
                                
                            </div>
                            <div class="header-bottom--right">
                                <div class="header-bottom--right__dropdown">
                                    <a href="{{URL::to('/lien-he')}}">Li??n H???</a>
                                </div>
                                
                            </div>
                            <!-- END Ph???n BOTTOM RIGHT -->
                        </div>
                    </div>
                </div>
            </div>

           <!-- Ph???n main -->
            @yield('Content')
            <!-- Ph???n footer -->
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
                            <i class="fas fa-gem me-3"></i> C??NG TY C??? PH???N NAT</h6>
                          <p>
                            Nh?? ph??n ph???i ?????c quy???n c??c th????ng hi???u m??? ph???m n???i ti???ng                 </p>
                        </div>
                
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                          <h6 class="text-uppercase fw-bold mb-4">
                            S???N PH???M
                          </h6>
                          <p>
                            <a href="#!" class="text-reset">M??? Ph???m</a>
                          </p>
                          <p>
                            <a href="#!" class="text-reset">Skincare</a>
                          </p>
                          <p>
                            <a href="#!" class="text-reset">Ch??m s??c da</a>
                          </p>
                        </div>
                
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                
                          <h6 class="text-uppercase fw-bold mb-4">
                            DANH M???C
                          </h6>
                          <p>
                            <a href="#!" class="text-reset">H??? th???ng c???a h??ng</a>
                          </p>
                          <p>
                            <a href="#!" class="text-reset">Tin t???c</a>
                          </p>
                          <p>
                            <a href="#!" class="text-reset">Gi???i thi???u</a>
                          </p>
                        </div>
                
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                          <!-- Links -->
                          <h6 class="text-uppercase fw-bold mb-4">
                            LI??N H???
                          </h6>
                          <p><i class="fas fa-home me-3"></i> Tam B??nh, V??nh Long</p>
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
                      ?? 2022 Copyright: thub1910584@student.ctu.edu.vn
                    </div>
                
                  </footer>
            </div>

            <!-- Ph???n li??n h??? th??ng tin nhanh -->
            <div class="titi-floating-icon__wrapper"></div>

            <!-- ph???n chat  -->
            <div class="titi-chatbox__wrapper"></div>
            
        </div>

    </div>
    <a id="scrollUp" href="#top" style="position: fixed; z-index: 2147483647;"><i class="fa fa-angle-up"></i></a>
    <script src="{{asset('/public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('/public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('/public/frontend/js/main.js')}}"></script>
    <script src="{{asset('/public/frontend/js/sliderProduct.js')}}"></script>
    <script src="{{asset('/public/frontend/js/details.js')}}"></script>
    {{-- ??o???n ch???y c???c b??? alert trong cart --}}
    <script src="{{asset('/public/frontend/js/sweetalert.js')}}"></script>
    <script>
      $('.carousel').carousel({
      interval: 5000
    })
    </script>

{{-- Ph???n l???c s???n ph???m --}}
<script type="text/javascript">
  $(document).ready(function(){
    $('#sort').on('change', function(){
      var url = $(this).val();
      // alert (url)
      if (url){
        window.location = url;
      }
      return false;
    });
  });
</script>

{{-- Ph???n Th??m s???n ph???m y??u th??ch tr??n localhost --}}

<script type="text/javascript">

  // function view(){
  //     if(localStorage.getItem('data')!= null){
  //       var data = JSON.parse(localStorage.getItem('data'));
  //       data.reverse();
  //       document.getElementById('row_wishlist').style.overflow = 'scroll';
  //       document.getElementById('row_wishlist').style.height = '600px';

  //       for(i=0;i<data.length;i++){
  //         var name = data[i].name;
  //         var price = data[i].price;
  //         var image = data[i].image;
  //         var url = data[i].url;
  //         $("#row_wishlist").append('<div class="row" style="margin: 10px 0"><div class="col-md-4"><img src="'+image+'" width="100%" alt=""></div><div class="col-md-8 info_wishlist"><p>'+name+'</p><p style="color: #FE980F">'+price+'</p><p><a href="'+url+'">Xem chi ti???t</a></p></div></div>');
  //       }
  //     }
  // }
  // view();
    function add_wistlist(clicked_id){
      var id = clicked_id;
      var name = document.getElementById('wishlist_productname'+id).value;
      var price = document.getElementById('wishlist_productprice'+id).value;
      var image = document.getElementById('wishlist_productimage'+id).src;
      var url = document.getElementById('wishlist_producturl'+id).href;
      // alert(id);
      // alert(name);
      // alert(price);
      // alert(image);
      // alert(url);
      var newItem = {
        'url' : url,
        'id': id,
        'name' : name,
        'price' : price,
        'image' : image
      }

      if(localStorage.getItem('data')==null){
        localStorage.setItem('data','[]');
      }

      var old_data = JSON.parse(localStorage.getItem('data'));
      old_data.push(newItem);

     
      // var matches = $.grep(old_data, function(obj){
      //   return obj.id == id;
      // })

      // if(matches.length){
      //   alert("S???n Ph???m b???n ???? y??u th??ch");
      // }else{
      //   old_data.push(newItem);
      //   $("#row_wishlist").append('<div class="row" style="margin: 10px 0"><div class="col-md-4"><img src="'+image+'" width="100%" alt=""></div><div class="col-md-8 info_wishlist"><p>'+name+'</p><p style="color: #FE980F">'+price+'</p><p><a href="'+url+'">Xem chi ti???t</a></p></div></div>');
      // }

      localStorage.setItem('data', JSON.stringify(old_data));
    }
</script>


<script type="text/javascript">
  function remove_background(product_id){
    for(var count = 1; count <= 5; count++){
      $('#'+product_id+'-'+count).css('color','#ccc');
    }
  }
  // {{-- Hover chu???t ????? ????nh gi?? sao --}}
  $(document).on('mouseenter','.rating',function(){
    var index = $(this).data('index');
    var product_id = $(this).data('product_id');

    remove_background(product_id);

    for(var count = 1; count <= index; count++){
      $('#'+product_id+'-'+count).css('color','#FE980F');
    }
  });

  // NH?? chu???t ????? KHONG ????nh gi?? sao

  $(document).on('mouseleave','.rating',function(){
    var index = $(this).data('index');
    var product_id = $(this).data('product_id');
    var rating = $(this).data('rating');

    remove_background(product_id);

    for(var count = 1; count <= rating; count++){
      $('#'+product_id+'-'+count).css('color','#FE980F');
    }
  });

  // click chu???t ????? ????nh gi??

  $(document).on('click','.rating',function(){
    var index = $(this).data('index');
    var product_id = $(this).data('product_id');
    var _token = $('input[name="_token"]').val();
    $.ajax({
            url: "{{url('/insert-rating')}}",
            method: 'POST',
            data:{index:index,product_id:product_id,_token:_token},
            success: function(data){
                if(data == 'done'){
                  alert('B???n ???? ????nh gi?? '+index+' tr??n 5 ');
                }else{
                  alert('L???i ????nh gi??');
                }
              }
            });    
  });
</script>

{{-- Ph???n comment --}}
<script type="text/javascript">
   $(document).ready(function() {
      load_comment();
    // alert(product_id)
    function load_comment() {
      var product_id = $('.comment_product_id').val();
      var _token = $('input[name="_token"]').val();
      $.ajax({
            url: "{{url('/load-comment')}}",
            method: 'POST',
            data:{product_id:product_id,_token:_token},
            success: function(data){
                $('#comment_show').html(data);
            }
        });
    }
    $('.sent-comment').click(function(){
      var product_id = $('.comment_product_id').val();
      var comment_name = $('.comment_name').val();
      var comment_content = $('.comment_content').val();
      var _token = $('input[name="_token"]').val();

      $.ajax({
            url: "{{url('/sent-comment')}}",
            method: 'POST',
            data:{product_id:product_id,comment_name:comment_name,comment_content:comment_content,_token:_token},
            success: function(data){
              $('#notify_comment').html('<p class="text text-success">Th??m b??nh lu???n th??nh c??ng</p>');
              load_comment();
              $('#notify_comment').fadeOut(2000);
              $('.comment_name').val('');
              $('.comment_content').val('');
            }
      });

    });

    $('.btn-reply-comment').click(function(){
      var comment = $('.reply_comment').val();
      var comment_id = $(this).data('comment_id');
      var comment_product_id = $(this).attr('id');

      // var alert = "tr??? l???i b??nh lu???n th??nh c??ng";
      alert(comment );
      alert(comment_id);
      alert(comment_product_id);

    })

   
   });

</script>

{{-- Ph???n ?????m s??? l?????ng s???n ph???m trong gi??? h??ng --}}
<script type="text/javascript">
  $(document).ready(function() {
    // $('#cart_count').click(function(){
      $.ajax({
          url: "{{url('/show-cart-quantity')}}",
          method: 'GET',
          success: function(data){
              $('#show_cart_quantity').html(data);
          }
      });
    // })
  });

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
            alert('Vui l??ng nh???p ?????a ch??? v???n chuy???n')
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