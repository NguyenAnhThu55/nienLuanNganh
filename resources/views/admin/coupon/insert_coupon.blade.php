@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h3>Thêm Mã Giảm Giá</h3>
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
                        <form role="form" action="{{URL::to('/insert-coupon-code')}}" method="post" enctype="multipart/form">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Mã Giảm Giá</label>
                                
                                <input type="text" class="form-control" name="coupon_name" id="" placeholder="Nhập tên mã...">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mã giảm giá</label>
                                <input style="resize: none" rows="5"  name="coupon_code" class="form-control" id="ckeditor3" placeholder="Nhập nội dung...">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Số Lượng mã</label>
                                <input style="resize: none" name="coupon_time" class="form-control" >
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Tính Năng Mã</label>
                                <select name="coupon_condition" id="">
                                    <option value="0">---chọn---</option>
                                    <option value="1">Giảm theo phần trăm</option>
                                    <option value="2">Giảm theo tiền</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Nhập % / tiền giảm</label>
                                <textarea style="resize: none" rows="5"  name="coupon_number" class="form-control" id="ckeditor3" placeholder="Nhập nội dung..."></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-info" name="add_category_product">THÊM MÃ</button>
                        </form>
                    </div>

                </div>
            </section>

    </div>
    
</div>
@endsection