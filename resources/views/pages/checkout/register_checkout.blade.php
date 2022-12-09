@extends('layout')
@section('Content') 

    <div class="main">
        {{-- <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{ url('/') }}">Trang Chủ</a></li>
              <li class="active">Đăng Ký</li>
            </ol>
        </div> --}}
        <form action="{{URL::to('/add-customer')}}" method="POST" class="form" id="form-1">
            {{ @csrf_field()}}
            <h3 class="heading">Thành viên đăng ký</h3>
            <p class="desc">vui lòng nhập thông tin</p>

            <div class="spacer"></div>

            <div class="form-group">
                <label for="fullname" rules="required" class="form-label">Tên đầy đủ</label>
                <input type="text" id="fullname" class="form-control" name="fullname" placeholder ="vd: Anh Thư">
                <span class="form-message"></span>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="text" id="email" rules="required|email" class="form-control" name="email" placeholder ="vd: anhthu@gmail.com">
                <span class="form-message"></span>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Số Điện Thoại</label>
                <input type="text" id="phone" rules="required|email" class="form-control" name="phone_customer" placeholder="vd: 039 524 5117">
                <span class="form-message"></span>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" id="password" rules="required|min:6" class="form-control" name="password" placeholder ="vui lòng nhập mật khẩu">
                <span class="form-message"></span>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                <input type="password" id="password_confirmation" rules="required|confirmation" class="form-control" name="password_confirmation" placeholder ="Nhập lại mật khẩu">
                <span class="form-message"></span>
            </div>

            <button class="form-submit bg-warning" name="Submit">Đăng ký</button>
        </form>
    </div>

@endsection