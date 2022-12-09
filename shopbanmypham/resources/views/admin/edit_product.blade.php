@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h3>Cập Nhật Sản Phẩm</h3>
                </header>
                <div class="panel-body">
                    <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<h3 class="alert text-success bg-dark">' . $message . '</h3>';
                            session::put('message', null);
                        }
                    ?>
                    <div class="position-center">
                        @foreach ($edit_product as $key => $pro)
                            
                       
                        <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                                
                                <input type="text" class="form-control" name="product_name" id=""value="{{$pro->product_name}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá Sản Phẩm</label>
                                
                                <input type="text" class="form-control" name="product_price" id="" value="{{$pro->product_price}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình Ảnh Sản Phẩm</label>
                                
                                <input type="file" class="form-control" name="product_image" >
                                <img src="{{ URL::to('public/image/'.$pro->product_image)}}" alt="" srcset="" height="100" width="100" />
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô Tả Sản Phẩm</label>
                                <textarea style="resize: none" rows="5"  name="product_desc" class="form-control" id="" >{{$pro->product_desc}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Nội Dung Sản Phẩm</label>
                                <textarea style="resize: none" rows="5"  name="product_content" class="form-control" id="" >{{$pro->product_content}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Danh Mục Sản Phẩm</label>
                                <select name="product_cate" class="form-control" id="product_categoryinput-sm m-bot15">
                                   @foreach ($cate_product as $key => $cate)
                                    @if ($cate->category_id == $pro->category_id)
                                        <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                    @else  
                                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>

                                    @endif   
                                   @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Thương Hiệu</label>
                                <select name="product_brand" class="form-control input-sm m-bot15">
                                    @foreach ($brand_product as $key => $brand)
                                    @if ($cate->category_id == $pro->category_id)
                                    <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @else  
                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>

                                @endif   
                                    
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tùy Chọn</label>
                                <select name="product_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển Thị</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-info" name="add_product">CẬP NHẬT</button>
                        </form>
                        @endforeach
                    </div>

                </div>
            </section>

    </div>
    
</div>
@endsection