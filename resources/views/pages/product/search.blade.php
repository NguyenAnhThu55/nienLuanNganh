@extends('layout')
@section('Content')  

    <div class="container titi-main">
              <div class="container-titi-main ">
                <h2 class="title text-center mt-3">Kết quả tìm kiếm</h2>
                <div class="features_items row">
                               
                    @foreach ($search_product as $key=>$product)
                        
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
                    </a>
                       @endforeach
                   </div>
              </div>
    </div>
@endsection     