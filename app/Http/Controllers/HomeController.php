<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Http\Requests;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
// use Session;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class HomeController extends Controller
{
    public function send_mail(){
        //send mail
            $to_name = "Anh Thu";
            $to_email = "nguyenanhthu55138@gmail.com";

            $data = array("name"=>"Mail từ TK khách hàng", "body"=>"Vấn đề phát sinh"); 

            Mail::send("pages.send_mail",$data,function($message) use ($to_name, $to_email){
                $message->to($to_email)->subject("Test Email");
                $message->from($to_email,$to_name);//send from this mail
            });
            return redirect("")->with("message","");
            //--send mail
    }

    public function index(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        
        // $all_product =DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderBy('tbl_product.product_id','desc')->get();

        $all_product =DB::table('tbl_product')->where('product_status','1')->orderBy('product_id','desc')->limit(3)->get();
        $makeup_product =DB::table('tbl_product')->where('category_id','5')->orderBy('product_id','desc')->limit(8)->get();
        $skincare_product =DB::table('tbl_product')->where('category_id','6')->orderBy('product_id','desc')->limit(8)->get();
        $son_product =DB::table('tbl_product')->where('category_id','7')->orderBy('product_id','desc')->limit(8)->get();
        $nuochoa_product =DB::table('tbl_product')->where('category_id','9')->orderBy('product_id','desc')->limit(8)->get();
        $body_product =DB::table('tbl_product')->where('category_id','13')->orderBy('product_id','desc')->limit(8)->get();
        return view('pages.home')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product)->with('makeup_product', $makeup_product)
        ->with('skincare_product', $skincare_product)->with('son_product', $son_product)->with('nuochoa_product', $nuochoa_product)->with('body_product', $body_product);

    }

    public function search(Request $request){

        $keywords = $request->keywords_submit;

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        $search_product =DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();
        return view('pages.product.search')->with('category', $cate_product)->with('brand', $brand_product)->with('search_product', $search_product);
    }
}
