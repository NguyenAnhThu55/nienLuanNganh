@extends('layout')
@section('Content')

<div class="main">
    <form action="{{URL::to('/login-customer')}}" method="POST" class="form" id="form-1">
       {{ csrf_field() }}
        <h3 class="heading">Thành viên đăng nhập</h3>
        <p class="desc">vui lòng nhập thông tin</p>

        <div class="spacer"></div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="text" id="email" class="form-control" name="email_account" placeholder ="vd: anhthu@gmail.com">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" id="password" class="form-control" name="password_account" placeholder ="vui lòng nhập mật khẩu">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <span>
                <input type="checkbox" class="checkbox"> Ghi nhớ đăng nhập
            </span>
        </div>
        <button class="form-submit bg-warning">Đăng Nhập</button>
        <a href="{{URL::to('/register-checkout')}}" style="color: #000">Đăng Ký</a>
    </form>
</div>
@endsection