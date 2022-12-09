@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h3>Thêm Vận chuyển</h3>
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
                        <form>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Chọn Tỉnh/Thành Phố</label>
                                <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                    <option value="">---Chọn Tỉnh/Thành Phố---</option>
                                    @foreach ($city as $key => $ci)
                                        <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Chọn Quận/Huyện</label>
                                <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                    <option value="">---chọn Quận/Huyện---</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Chọn Xã/Phường/Thị Trấn</label>
                                <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                    <option value="">---Chọn Xã/Phường/Thị Trấn---</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Phí Vận Chuyển</label>
                                
                                <input type="text" class="form-control fee_ship" name="fee_ship" id="fee_ship">
                            </div>
                            <button type="button" class="btn btn-info add_delivery" name="add_delivery">THÊM</button>
                        </form>
                    </div>

                </div>
                <div class="container">
                    <div id="load_delivery">
                    
                    </div>
                </div>
            </section>

        </div>
    
</div>
@endsection