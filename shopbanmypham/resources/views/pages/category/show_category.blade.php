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
                               

                            </div>
                        </div>
                        <div class="col-sm-9 padding-right">
                            <!--features_items-->
                            @foreach ($category_name as $key => $cate_name)
                                
                           
                            <h2 class="title text-center" style="margin-top: 20px">Danh Mục Sản Phẩm {{$cate_name->category_name}}</h2>
                            
                            @endforeach
                            <div class="features_items row">
                               

                             @foreach ($category_by_id as $key=>$product)
                                 
                             <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}" style="text-decoration: none" hover="text-decoration: none">
                                
                                    <div class="col-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <img src="{{URL::to('public/image/'. $product->product_image)}}" alt="">
                                                        <h4>{{number_format($product->product_price).'₫'}}</h4>
                                                        <p>{{$product->product_name}}</p>
                                                        
                                                    </div>
                                                    <div class="product-overlay">
                                                        <div class="overlay-content">
                                                        <h4>{{number_format($product->product_price).'₫'}}</h4>
                                                        <p>{{$product->product_name}}</p>
                                                        
                                                            <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Giỏ Hàng</a>
                                                        </div>
                                                    </div>
                                                    <img src="image/sale.png" class="new" alt="">
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