@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h3>Thêm Sản Phẩm</h3>
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
                        <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                           
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                                
                                <input type="text" class="form-control" name="product_name" id="" placeholder="Nhập tên sản phẩm...">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá Sản Phẩm</label>
                                
                                <input type="text" class="form-control" name="product_price" placeholder="Nhập giá sản phẩm..."data-validation="number" data-validation-error-msg="Vui lòng điền số tiền">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình Ảnh Sản Phẩm</label>
                                
                                <input type="file" class="form-control" name="product_image" >
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô Tả Sản Phẩm</label>
                                <textarea style="resize: none" rows="5"  name="product_desc" class="form-control" id="ckeditor1" placeholder="Nhập mô tả sản phẩm..."></textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Nội Dung Sản Phẩm</label>
                                <textarea style="resize: none" rows="5"  name="product_content" class="form-control" id="ckeditor2" placeholder="Nhập nội dung..."></textarea>
                            </div>

                            <div class="form-group">
                                <label>Danh Mục Sản Phẩm</label>
                                <select name="product_cate" class="form-control" id="product_categoryinput-sm m-bot15">
                                   @foreach ($cate_product as $key => $cate)
                                       
                                   <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                   @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Thương Hiệu</label>
                                <select name="product_brand" class="form-control input-sm m-bot15">
                                    @foreach ($brand_product as $key => $brand)
                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
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
                            
                            <button type="submit" class="btn btn-info" name="add_product">THÊM</button>
                        </form>
                      
                    </div>

                </div>
            </section>

    </div>
    
</div>
@endsection