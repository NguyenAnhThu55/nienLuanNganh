@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <header class="panel-heading">
            <h3>Thêm Thư Viện Ảnh</h3>
        </header>
       
       <form action="{{url('/insert-gallery/'.$pro_id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row" style="margin-bottom: 15px">
                <div class="col-md-3" align="right"></div>
                <div class="col-md-6">
                    <input type="file" id="file" class="form-control"  name="file[]" accept="image/*" multiple>
                    <span id="error-gallery"></span>
                </div>
                <div class="col-md-3">
                    <input type="submit" name="upload" value="Tải ảnh" class="btn btn-success">
                </div>

            </div>
       </form>
       <?php
       $message = Session::get('message');
       if($message){
           echo '<h3 class="alert text-success bg-dark">' . $message . '</h3>';
           session::put('message', null);
       }
        ?>
        <section class="panel">
            <div class="panel-body">
                
                <input type="hidden" value="{{$pro_id}}" name="pro_id" class="pro_id">
                <form>
                    @csrf
                    <div id="gallery_load">
                      
                    </div>
                </form>
            </div>
        </section>

    </div>
    
</div>
@endsection