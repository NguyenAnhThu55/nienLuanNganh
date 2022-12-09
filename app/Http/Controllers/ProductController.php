<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Http\Requests;
use Illuminate\Contracts\View\View;
// use Session;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;
session_start();

use App\Models\Comment;
use App\Models\Rating;
use App\Models\Gallery;
use App\Models\Product;
use Livewire\WithFileUploads;

class ProductController extends Controller
{
    public function sent_comment(Request $request){
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment =  $comment_content;
        $comment->comment_name = $comment_name;
        $comment->comment_product_id = $product_id;
        $comment->save();
    }

    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id', $product_id)->get();
        $output = '';
        foreach($comment as $key => $comm){
            $output .= '
                <div class="task">
                    <div class="comment-box-avt">
                        <img src="'.url('/public/frontend/image/sale.png').'" alt="">
                    </div>
                    <div class="">
                        <p class="text-warning mb-1">@'.$comm->comment_name.'</p>
                        <span>'.$comm->comment_date.'</span>
                        <span id="taskname">
                        '.$comm->comment.'
                        </span>
                        <button class="btn btn-default btn-xs btn-reply-comment" style="width:100px; background-color: #ffff;"><i class="fas fa-reply"></i> trả lời</button>
                        <textarea  cols="30" rows="1" data-comment_id="'.$comm->comment_id.'" id="'.$comm->comment_product_id.'" class="form-control reply_comment" placeholder="Trả lời bình luận"></textarea>
                    </div>
                    <button class="delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            ';
        }
        return $output;
        
    }

    public function add_product(){
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
        return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }

    public function all_product(){
        
        $all_product =DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderBy('tbl_product.product_id','desc')->paginate(4);
        
       
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manager_product)
       ;
        
    }



    public function save_product(Request $request){
        
       $data = array();
       $data['product_name'] = $request->product_name;
       $data['product_price'] = $request->product_price;
       $data['product_quantity'] = $request->product_quantity;
       $data['product_desc'] = $request->product_desc;
       $data['product_content'] = $request->product_content;
       $data['category_id'] = $request->product_cate;
       $data['brand_id'] = $request->product_brand;
       $data['product_status'] = $request->product_status;

       
       $get_image = $request->file('product_image');
       if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
           
            $new_image = $get_name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move( public_path('image'),$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return redirect::to('add-product');
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        Session::put('message','Thêm sản phẩm thành công');
        return redirect::to('add-product');
        
    }
    public function unactive_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Kích hoạt thương hiệu sản phẩm thành công');
        return redirect::to('all-product');
    }

    public function active_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Ẩn thương hiệu sản phẩm thành công');
        return redirect::to('all-product');
    }
    
    public function edit_product($product_id){
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
        $edit_product =DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);
        return view('admin_layout')->with('admin.edit_product',$manager_product);
    }
    
    public function update_product(Request $request, $product_id){
        $data = array();
       $data['product_name'] = $request->product_name;
       $data['product_price'] = $request->product_price;
       $data['product_quantity'] = $request->product_quantity;
       $data['product_desc'] = $request->product_desc;
       $data['product_content'] = $request->product_content;
       $data['category_id'] = $request->product_cate;
       $data['brand_id'] = $request->product_brand;
       $data['product_status'] = $request->product_status;
       $get_image = $request->file('product_image');
       if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
        
            $new_image = $get_name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move( public_path('image'),$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhât sản phẩm thành công');
            return redirect::to('add-product');
        }
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập Nhật sản phẩm thành công');
        return redirect::to('all-product');
    }

    public function delete_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return redirect::to('all-product');
    }

    // END ADMIN
    public function detail_product($product_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();

       


        $detail_product =DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();
 
        foreach ($detail_product as $key => $value) {
            $category_id = $value->category_id;
            $product_id = $value->product_id;
        }
         // Gallery
         $gallery = Gallery::where('product_id',$product_id)->get();

        $related_product =DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->limit(4)->get();
         
        $rating = Rating::where('product_id',$product_id)->avg('rating');
        $rating = round(($rating));

        return view('pages.product.show_detail')->with('category', $cate_product)->with('brand', $brand_product)->with('detail_product',$detail_product)->with('related_product',$related_product)->with('rating',$rating)->with('gallery',$gallery);
    }

    public function insert_rating(Request $request){
        $data = $request->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();

        echo 'done';
    }

    
}
