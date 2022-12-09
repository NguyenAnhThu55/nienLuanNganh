@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h3>Thêm Thương Hiệu Sản Phẩm</h3>
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
                        <form role="form" action="{{URL::to('/save-brand-product')}}" method="post" enctype="multipart/form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Thương Hiệu</label>
                                
                                <input type="text" class="form-control" name="brand_product_name" id="" placeholder="Nhập tên danh mục...">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô Tả Thương Hiệu</label>
                                <textarea style="resize: none" rows="5"  name="brand_product_desc" class="form-control" id="ckeditor3" placeholder="Nhập nội dung..."></textarea>
                            </div>
                            <div class="form-group">
                                <label>Tùy Chọn</label>
                                <select name="brand_product_status" class="form-control input-sm m-bot15">
                                    <option value="1">Hiển Thị</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-info" name="add_brand_product">THÊM</button>
                        </form>
                    </div>

                </div>
            </section>

    </div>
    
</div>
@endsection