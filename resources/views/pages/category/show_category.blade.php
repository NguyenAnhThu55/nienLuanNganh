@extends('layout')
@section('Content')  
            <!-- Phần main -->
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="left-sidebar">
                                <!--/category-products-->
                                <h2>Danh Mục Sản Phẩm</h2>
                                <div class=" panel-group category-products" id="accordian">
                                 
                                    @foreach ($category as $key => $cate)
                                    <div class="panel panel-default">
                                        <div class=" panel-heading">
                                            <h4 class="panel-title">
                                                      
                                                <a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a>
                                                
                                            </h4>
                                            
                                        </div>
                                    </div>
                                    @endforeach
                                   
                                </div>
                                <!--END/category-products-->

                                <!--/brands_products-->
                                <div class="brands_products">
                                    <h2>Thương Hiệu Sản Phẩm</h2>
                                    <div class="brands-name">
                                        
                                        
                                        @foreach ($brand as $key => $brand_pro)
                                        <ul class="nav nav-pills nav-stacked">
                                          
                                            <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand_pro->brand_id)}}">{{$brand_pro->brand_name}}</a></li>
                                                
                                           
                                        </ul>
                                        @endforeach
                                    </div>
                                </div>
                               
                                 <!--Sản Phẩm yêu thích-->
                                 {{-- <div class="brands_products">
                                    <h2>Sản Phẩm Yêu Thích</h2>
                                    <div id="row_wishlist" class="brands-name">
                                        
                                       
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-sm-9 padding-right">
                            <!--features_items-->
                            @foreach ($category_name as $key => $cate_name)
                                
                           
                            <h2 class="title text-center" style="margin-top: 20px">Danh Mục Sản Phẩm {{$cate_name->category_name}}</h2>
                            
                            @endforeach

                            {{-- Phần sắp xếp theo --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="amount"><b>Sắp sếp theo</b></label>
                                    <form action="">
                                        @csrf
                                        <select name="sort" class="form-control mb-3" id="sort">
                                            <option value="{{Request::url()}}?sort_by=none">--Lọc--</option>
                                            <option value="{{Request::url()}}?sort_by=tang_dan">--Giá tăng dần--</option>
                                            <option value="{{Request::url()}}?sort_by=giam_dan">--Giá Giảm dần--</option>
                                            <option value="{{Request::url()}}?sort_by=kytu_az">--A đến Z--</option>
                                            <option value="{{Request::url()}}?sort_by=kytu_za">--Z đến A--</option>
                                        </select>
                                    </form>
                                </div>
                            </div>


                            <div class="features_items row">
                               

                             @foreach ($category_by_id as $key=>$product)
                                 
                             <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}" style="text-decoration: none" hover="text-decoration: none">
                                
                                    <div class="col-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                    <form action="">
                                                        @csrf
                                                   
                                                        <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                                                        <input type="hidden" id="wishlist_productname{{$product->product_id}}" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                                                        <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
                                                        <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                                                        <input type="hidden" value="{{number_format($product->product_price).'₫'}}" 
                                                                id="wishlist_productprice{{$product->product_id}}" 
                                                                class="cart_product_price_{{$product->product_id}}">
                                                        <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
                                                        <div class="productinfo text-center">
                                                            <img id="wishlist_productimage{{$product->product_id}}" src="{{URL::to('public/image/'. $product->product_image)}}" alt="">
                                                            <h4>{{number_format($product->product_price).'₫'}}</h4>
                                                            <p>{{$product->product_name}}</p>
                                                            
                                                        </div>
                                                        <div class="product-overlay">
                                                            <div class="overlay-content">
                                                            <h4>{{number_format($product->product_price).'₫'}}</h4>
                                                            <p>{{$product->product_name}}</p>
                                                                {{-- <div class="choose" style="display: flex;"> --}}
                                                                    
                                                                    <a  href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}" class="btn btn-default add-to-cart mr-2 ml-3"><i class="fa fa-shopping-cart"></i>Giỏ Hàng</a>

                                                                        {{-- <a href="{{URL::to('/chi-tiet/'.$product->product_id)}}" id="wishlist_producturl{{$product->product_id}}" ></a>
                                                                        <button style="max-width:120px" 
                                                                            class="btn btn-default add-to-cart button_wishlist" id="{{$product->product_id}}"
                                                                            onclick="add_wistlist(this.id);">
                                                                            <i class="far fa-heart"></i>Yêu thích
                                                                        </button> --}}
                                                                
                                                                {{-- </div> --}}
                                                            </div>
                                                            
                                                        </div>
                                                    
                                                        <img src="image/sale.png" class="new" alt="">
                                                    </form>
                                            </div>

                                            
                                            
                                        </div>

                                        
                                    </div>
                                </form>
                             </a>
                                @endforeach
                            </div>
                            
                            
                           
                            
                        </div>
                    </div>
                </div>
            </section>
            <!-- end main -->
    
           
@endsection     