@extends('layout')
@section('Content')  

 <div class="titi-main">
              <div class="container-titi-main ">
                  <!-- Phần slider -->
                  <div class="titi-home-wrap container">
                      <div class="titi-home-content">
                          <div class="home-content--right">
                              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                  <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                  </ol>
                                  <div class="carousel-inner">
                                    <div class="carousel-item active">
                                      <img class="d-block w-100" src="https://cdn.cocolux.com/2022/06/images/banners/1654310236582-ganier-anh-bia.jpeg" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                      <img class="d-block w-100" src="https://cdn.cocolux.com/2022/06/images/banners/1655960103217-banner-nuoc-hoa-min.jpeg" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                      <img class="d-block w-100" src="https://cdn.cocolux.com/2022/06/images/banners/1654310236582-ganier-anh-bia.jpeg" alt="Third slide">
                                    </div>
                                  </div>
                                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                  </a>
                              </div>

                              <div class="ccs-banner-wrap--right">
                                  <div class="side-banner">

                                      <a href="/">
                                          <img src="https://cdn.cocolux.com/2022/06/images/banners/1655777896393-banner-coco-2.jpeg" alt="">
                                      </a>

                                      <a href="/">
                                          <img src="https://cdn.cocolux.com/2022/06/images/banners/1655777884866-banner-coco-1.jpeg" alt="">
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <section class="bg-white container">
                    <!-- Phần Sản phẩm Hot -->
                   
                    <section class=" section">
                      <div class="section--header">
                        <h2 class="section-title">
                          <a href="brandHot.html" class="color-secondary">Sản Phẩm Mới Nhất</a>
                        </h2>
                       
                      </div>
                      <div class="section-body">
                            <div class="row">
                              @foreach ($all_product as $key => $product)
                              <div class="col-sm-4">
                              <form action="">
                                {{csrf_field()}}
                                <input type="hidden" name="" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                                <input type="hidden" name="" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                                <input type="hidden" name="" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                                <input type="hidden" name="" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                                <input type="hidden" name="" value="1" class="cart_product_qty_{{$product->product_id}}">


                                
                                  <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="{{URL::to('public/image/'. $product->product_image)}}" alt="Card image cap">
                                    <div class="card-body mb-3">
                                      <p class="card-title product_name">{{$product->product_name}}</p>
                                      <span class="card-price product_price">{{number_format($product->product_price).' '.'VNĐ'}}</span>
                                      <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Giỏ Hàng</a>
                                    {{-- <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">Thêm Giỏ hàng</button> --}}
                                  
                                </div>
                                </div>
                              </form>
                            </div>
                                    @endforeach
                                </div>
                    </section>

                  <section class="container">
                    <!-- phần sản phẩm trang điểm -->
                    <hr>
                    <section class=" section">
                      <div class="section--header">
                        <h2 class="section-title">
                            <a href="productHot.html" class="color-secondary">TRANG ĐIỂM</a>
                        </h2>
                        <a href="productHot.html" class="show-more">Xem Tất Cả</a>
                      </div>
                      <div class="section-body">
                        <div class="row">
                          <div class="col-lg-2 p-0 poster--image">
                            <img src="{{URL::to('public/frontend/image/trang-điểm.jpeg')}}" alt="" srcset="">
                          </div>
                          <div class="col-lg-10">
                            <div class="row">
                                  @foreach ($makeup_product as $key => $makeup)
                                    <div class="col-3 p-0 m-0 link-undefind">
                                        <a class="" href="{{URL::to('/chi-tiet-san-pham/'.$makeup->product_id)}}">
                                        <div class="card card-noborder">
                                            <img class="card-img-top" src="{{URL::to('public/image/'. $makeup->product_image)}}" alt="Card image cap">
                                            <div class="card-body mb-1">
                                                <p class="card-title">{{$makeup->product_name}}</p>
                                                <span class="card-price">{{number_format($makeup->product_price).' '.'VNĐ'}}</span>
                                            </div>
                                        
                                        </div> 
                                    
                                        </a>
                                      </div>
                                    @endforeach
                                  </div>
                            
                            </div>
                        </div>
                    </section>

                    <hr>

                     <!-- phần sản phẩm chăm sóc da -->
                    <section class=" section">
                        <div class="section--header">
                            <a href="productHot.html" class="show-more">Xem Tất Cả</a>
                            <h2 class="section-title">
                                <a href="productHot.html" class="color-secondary">chăm sóc da</a>
                            </h2>
                       
                        </div>
                        <div class="section-body">
                            <div class="row">
                           
                                <div class="col-lg-10">
                                    <div class="row">
                                      @foreach ( $skincare_product as $key =>  $skincare)
                                      <div class="col-3 p-0 m-0 link-undefind">
                                          <a href="{{URL::to('/chi-tiet-san-pham/'.$skincare->product_id)}}">
                                          <div class="card card-noborder">
                                              <img class="card-img-top" src="{{URL::to('public/image/'.  $skincare->product_image)}}" alt="Card image cap">
                                              <div class="card-body mb-1">
                                                  <p class="card-title">{{ $skincare->product_name}}</p>
                                                  <span class="card-price">{{number_format( $skincare->product_price).' '.'VNĐ'}}</span>
                                              </div>
                                          
                                          </div> 
                                      
                                          </a>
                                        </div>
                                      @endforeach
                                    </div> 
                                    
                                </div>

                                <div class="col-lg-2 p-0 poster--image">
                                    <img src="{{URL::to('public/frontend/image/chăm-sóc-da.jpeg')}}" alt="" srcset="">
                                </div>
                            </div>
                        
                        </div>
                    </section>
                    <hr>
                    <!-- phần son -->
                    <section class=" section">
                    <div class="section--header">
                      <h2 class="section-title">
                          <a href="productHot.html" class="color-secondary">son</a>
                      </h2>
                      <a href="productHot.html" class="show-more">Xem Tất Cả</a>
                    </div>

                    <div class="section-body">
                            <div class="row">
                            <div class="col-lg-2 p-0 poster--image">
                                <img src="{{URL::to('public/frontend/image/son-môi.jpeg')}}" alt="" srcset="">
                            </div>
                                <div class="col-lg-10">
                                <div class="row">
                                  @foreach ($son_product as $key => $son)
                                  <div class="col-3 p-0 m-0 link-undefind">
                                      <a href="{{URL::to('/chi-tiet-san-pham/'.$son->product_id)}}">
                                      <div class="card card-noborder">
                                          <img class="card-img-top" src="{{URL::to('public/image/'. $son->product_image)}}" alt="Card image cap">
                                          <div class="card-body mb-1">
                                              <p class="card-title">{{$son->product_name}}</p>
                                              <span class="card-price">{{number_format($son->product_price).' '.'VNĐ'}}</span>
                                          </div>
                                      
                                      </div> 
                                  
                                      </a>
                                    </div>
                                  @endforeach
                                </div>
                            
                            </div>
                        </div>
                    </section>
                    <hr>

                    <!-- phần sản phẩm chăm sóc cơ thể -->
                    <section class=" section">
                      <div class="section--header">
                        <a href="productHot.html" class="show-more">Xem Tất Cả</a>
                        <h2 class="section-title">
                            <a href="productHot.html" class="color-secondary">chăm sóc cơ thể</a>
                        </h2>
                       
                      </div>
                      <div class="section-body">
                            <div class="row">
                           
                                <div class="col-lg-10">
                                    <div class="row">
                                      @foreach ($body_product as $key => $body)
                                      <div class="col-3 p-0 m-0 link-undefind">
                                          <a href="{{URL::to('/chi-tiet-san-pham/'.$body->product_id)}}">
                                          <div class="card card-noborder">
                                              <img class="card-img-top" src="{{URL::to('public/image/'. $body->product_image)}}" alt="Card image cap">
                                              <div class="card-body mb-1">
                                                  <p class="card-title">{{$body->product_name}}</p>
                                                  <span class="card-price">{{number_format($body->product_price).' '.'VNĐ'}}</span>
                                              </div>
                                          
                                          </div> 
                                      
                                          </a>
                                        </div>
                                      @endforeach
                                    </div> 
                                    
                                </div>

                                <div class="col-lg-2 p-0 poster--image">
                                    <img src="{{URL::to('public/frontend/image/chăm-sóc-cơ-thể.jpeg')}}" alt="" srcset="">
                                </div>
                            </div>
                        
                        </div>
                    </section>
                    <hr>
                     <!-- phần Nước hoa -->
                     <section class=" section">
                      <div class="section--header">
                        <h2 class="section-title">
                            <a href="productHot.html" class="color-secondary">Nước hoa</a>
                        </h2>
                        <a href="productHot.html" class="show-more">Xem Tất Cả</a>
                      </div>

                      <div class="section-body">
                            <div class="row">
                            <div class="col-lg-2 p-0 poster--image">
                                <img src="{{URL::to('public/frontend/image/Artboard-5.jpeg')}}" alt="" srcset="">
                            </div>
                                <div class="col-lg-10">
                                <div class="row">
                                  @foreach ($nuochoa_product as $key => $nuochoa)
                                  <div class="col-3 p-0 m-0 link-undefind">
                                      <a href="{{URL::to('/chi-tiet-san-pham/'.$nuochoa->product_id)}}">
                                      <div class="card card-noborder">
                                          <img class="card-img-top" src="{{URL::to('public/image/'. $nuochoa->product_image)}}" alt="Card image cap">
                                          <div class="card-body mb-3">
                                              <p class="card-title">{{$nuochoa->product_name}}</p>
                                              <span class="card-price">{{number_format($nuochoa->product_price).' '.'VNĐ'}}</span>
                                          </div>
                                      
                                      </div> 
                                  
                                      </a>
                                    </div>
                                  @endforeach
                                </div>
                            
                            </div>
                        </div>
                    </section>
                  
                  </section>
              </div>
            </div>
@endsection     