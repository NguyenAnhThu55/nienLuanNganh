@extends('layout')
@section('Content') 
@foreach ($detail_product as $key => $value)
<!-- Phần main details -->
<div class="container bootdey mb-5">
        <div class="spacer">
            <!-- DETAIL TOP -->
           <div class="container">
            <section class="panel" style="text-align: center">
              <div class="panel-body row">

                  <div class="col-md-4">
                        <span class="control prev">
                            <i class="fas fa-angle-left"></i>
                        </span>
                        <span class="control next">
                            <i class="fas fa-angle-right"></i>
                        </span>

                        <div class="pro-img-details">
                          <img class="img-details" src="{{URL::to('public/image/'.$value->product_image)}}" alt="">
                        </div>

                        <div class="pro-img-list">
                            <div class="active">
                                <img class="img-details" src="{{URL::to('public/image/'.$value->product_image)}}" alt="">
                            </div>
                            @foreach ($gallery as $key => $gall)
                            <div>
                                <img class="img-details" src="{{asset('public/uploads/gallery/'.$gall->gallery_image)}}" alt="">
                            </div>
                              
                            @endforeach
                           
                        </div>

                  </div>
                  <div class="col-md-8">
                      <h2 class="pro-d-title">
                            {{$value->product_name}}
                      </h2>

                       
                        <!-- Phần xuất sứ -->
                        
                        <div class="product_meta">
                          <div class="product-details-item__action">
                            <div class="product-details-item__quantity">
                                <span class="product-details-item__quantity-start">4.8</span>
                            </div>
                            <div class="product-details-item__rating">
                                <i class="product-details-item__start--gold fas fa-star"></i>
                                <i class="product-details-item__start--gold fas fa-star"></i>
                                <i class="product-details-item__start--gold fas fa-star"></i>
                                <i class="product-details-item__start--gold fas fa-star"></i>
                                <i class="fas fa-star"></i>

                            </div>
                            <div>
                                <span class="product-details-item__sold">1.4k đã bán</span>
                            </div>

                            <div>
                                <span class="product-details-item__reviews">618 Đánh Giá</span>
                            </div>

                        </div>
                          <span class="posted_in"> <strong>Thương Hiệu:</strong> <a rel="tag" href="#">{{$value->brand_name}}</a></span>
                          <span class="posted_in"> <strong>Danh Mục:</strong> <a rel="tag" href="#">{{$value->category_name}}</a></span>
                          <span class="posted_in"> <strong>Tình Trạng:</strong> <b class="text-danger">Còn Hàng</b></span>
                          <span class="tagged_as"><strong>Xuất xứ:</strong> <a rel="tag" href="#">{{$value->brand_desc}}</a>.</span>
                        </div>
                        <!-- phần giá -->
                        <form action="{{URL::to('/save-cart')}}" method="post">
                          {{ csrf_field() }}
                          <div class="product-price"> 
                              <strong>Giá : </strong> 
                              <span class="amount-old">3000</span>  
                              <span class="pro-price"> {{ number_format($value->product_price).'₫'}}</span>
                          </div>
                          <!-- PHẦN Dung tích sản phẩm -->
                          <div class="product-capacity mt-3">
                              <strong>Dung tích:</strong>
                              <button class="capacity-btn">100ml</button>
                              <button class="capacity-btn">200ml</button>
                              <button class="capacity-btn">300ml</button>
                          
                          </div>
                          <!-- phần số lượng -->
                          <div class="product-quantity mt-3">
                            <label>Số lượng:</label>
                            <input type="number" name="qty" value="1" min="1">
                            <input type="hidden" name="productid_hidden" value="{{$value->product_id}}"min="1">
                            <input type="hidden" name="productid_hidden_qty" value="{{$value->product_quantity}}" class="cart_product_qty_{{$value->product_id}}">
                          </div>
                          <p class="product-quantity--p">
                            <button class="btn btn-round btn-warning" id="cart_count" type="submit"><i class="fas fa-cart-plus"></i> Giỏ hàng</button>
                          </p>
                      </form>
                  </div>
              </div>
            </section>
           </div>

            <hr>


            <!-- PHẦN DÁNH GIÁ VÀ THÔNG TIN SẢN PHẨM -->
            <nav>
                <div class="nav nav-tabs text-uppercase font-weight-bold" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link " id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Thông tin Sản phẩm</a>
                  <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Đánh Giá</a>
                  <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Hướng Dẫn Sử Dụng</a>
                </div>
            </nav>
              <div class="tab-content" id="nav-tabContent">
                <ul>
                  <li><a href=""><i class="fa fa-user"></i>Nguyen Anh Thu</a></li>
                  <li><a href=""><i class="fa fa-clock"></i>12:41 PM</a></li>
                  <li><a href=""><i class="fa fa-calendar"></i>13 Feb 2022</a></li>
                  <li> Đánh Giá:
                  @for ($count = 1; $count <=5; $count++)
                    @php
                      if ($count<= $rating){
                        $color = 'color:#FE980F;';
                      }else {
                        $color = 'color:#cccc;';
                        
                      }
                    @endphp
                       <i class="fas fa-star rating" style="cursor: pointer;{{$color}}">
                      </i>
                      @endfor
                    </li>
                </ul>
                <!-- Phần thông tin Sản Phẩm -->
                <div class="tab-pane fade " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                 
                  <div class="tab-content">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <span class="text-justify d-block">{!!$value->product_content!!}</span>
                        </div>
                    </div>
                  </div>
                </div>
                <!-- Phần đánh giá sản phẩm -->
                <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="tab-content">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                 {{-- PHẦN NÀY KHI NHẤN ĐÁNH GIÁ SẼ HIỆN ĐÁNH GIÁ CỦA NGƯỜI DÙNG --}}
                              
                              <form action="">
                                {{csrf_field()}}
                                <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$value->product_id}}">
                                <div class="" id="comment_show">
                                    
                                </div>
                              </form>

                              
                              <style>
                                .task{
                                    background-color: #ffffff;
                                    padding: 5px 10px;
                                    margin-top: 6px;
                                    display: flex;
                                    align-items: center;
                                    max-width: max-content;
                                 
                                    border-bottom: 2px solid #d1d3d4;
                                    border-radius: 5px;
                                    cursor: pointer;
                                }
                                .task span{
                                    font-family: 'Poppins',sans-serif;
                                    font-size: 14px;
                                    font-weight: 400;
                                    text-align: start;
                                    display: block;
                                    padding: 4px;
                                    width: 80%;
                                }
                                .task button{
                                    background-color: #ccc;
                                    height: 70%;
                                    width: 30px;
                                    border-radius: 5px;
                                    border: none;
                                    cursor: pointer;
                                    outline: none;
                                    margin-right: 20px
                                }
                                .comment-box-avt img{
                                    width: 50px;
                                    margin: 0px 8px 0px 8px;
                                    border-radius: 50%;
                                }
                              </style>

                                <hr/>


                                <div class="row form-review">
                                 
                                  <!-- phần điền họ tên -->
                                  <div class="col-xs-24 col-sm-11 border border-right">

                                          <!-- Phần đánh giá sao -->
                                          <div class="form-group">
                                            <div class="rate-star">
                                                @for ($count = 1; $count <=5; $count++)
                                                  {{-- @php
                                                    if ($count<= $rating){
                                                      $color = 'color:#FE980F;';
                                                    }else {
                                                      $color = 'color:#cccc;';
                                                      
                                                    }
                                                  @endphp --}}

                                                 
                                                  <div>
                                                    <i id="{{$value->product_id}}-{{$count}}" data-index="{{$count}}" 
                                                      data-product_id="{{$value->product_id}}" 
                                                      data-rating="{{$rating}}" class="fas fa-star rating" style="cursor: pointer; color:#ccc">
                                                    </i>
                                                  </div>
                                                  
                                                @endfor
                                                
                                            </div>
                                        </div>


                                        <form action="">
                                          {{csrf_field()}}

                                          <div id="notify_comment"></div>
                                            <div class="form-group mt-2">
                                                <input type="text" class="form-control comment_name" name="sender" placeholder=" Họ tên">
                                            </div>
                                        
                                          <!-- Phần Nhận Xét -->
                                          
                                          <div class="form-group">
                                              <textarea name="comment" id="" cols="30" rows="3" class="form-control comment_content" placeholder="Nhận xét"></textarea>
                                          </div>
                                          <!-- Nút Đánh Giá -->
                                          <div class="form-group">
                                              <button type="button" class="btn btn-dark sent-comment" style="width: fit-content;">Gửi</button>
                                          </div>
                                        
                                        </form>

                                        
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Phần Bình Luận Sản Phẩm -->
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                  <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-body">
                          {{-- product_desc là phần hứng dẫn sử dụng --}}
                          <span>{!!$value->product_desc!!}</span>

                        </div>
                    </div>
                  </div>
                </div>
              </div>
@endforeach 
              <!-- Phần các sản phẩm gợi ý -->
              <div class="panel panel-default mt-5" >
                <h2 class="title text-center mt-2">SẢN PHẨM LIÊN QUAN</h2>
                <div class="panel-body mt-2" style="border: 1px solid #ccc;">
                  
                  
                         
                  <div class="col">
                    {{-- <a href="#" style="text-decoration: none" hover="text-decoration: none"> --}}
                      <div class="row">
                                @foreach ($related_product as $key => $related)
                                  <div class="col-sm-3 p-0 m-0">
                                    <div class="card card-noborder ml-1 mt-2">
                                      <img class="card-img-top" src="{{URL::to('public/image/'.$related->product_image)}}" alt="Card image cap">
                                      <div class="card-body">
                                        <p class="card-title">{{$related->product_name}}</p>
                                        <span class="card-price">{{ number_format($related->product_price).'₫'}}</span>
                                        <a href="#" class="btn btn-default add-to-cart mb-1"><i class="fa fa-shopping-cart"></i>Thêm</a>
                                      </div>
                                    </div>
                                  </div> 

                                  @endforeach
                              </div>
                            {{-- </a> --}}
                          </div>
                        </div>
                      
                    </div>
        </div>
    </div>
  @endsection