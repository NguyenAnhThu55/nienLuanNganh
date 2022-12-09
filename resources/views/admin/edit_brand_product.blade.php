@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h3>Cập Nhật Thương Hiệu Sản Phẩm</h3>
                </header>
                    <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<h3 class="alert text-success bg-dark">' . $message . '</h3>';
                            session::put('message', null);
                        }
                    ?>
                <div class="panel-body">
                    @foreach ($edit_brand_product as $key => $edit_value)
                        
                    
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-brand-product/'.$edit_value->brand_id)}}" method="post" enctype="multipart/form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Thương Hiệu</label>
                                
                                <input type="text" value="{{$edit_value->brand_name}}" class="form-control" name="brand_product_name" id="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô Tả Thương Hiệu</label>
                                <textarea style="resize: none" rows="5"  name="brand_product_desc" class="form-control"  id="ckeditor3" value="">{{$edit_value->brand_desc}}</textarea>
                            </div>
                          
                            
                            <button type="submit" class="btn btn-info" name="add_brand_product">CẬP NHẬT</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </section>

    </div>
    
</div>
@endsection