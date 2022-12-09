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

use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
// use Gloudemans\Shoppingcart\Cart;
use Gloudemans\Shoppingcart\Contracts\Calculator;
// use Illuminate\Contracts\Facades\Cart;
class CartController extends Controller
{
    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                $coupon_session = Session::get('coupon');
                if($coupon_session == true){
                    $is_avaiable = 0;
                    if($is_avaiable==0){
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                        );
                        Session::put('coupon', $cou);
                    }
                }else{
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,
                    );
                    Session::put('coupon', $cou);
                }
                Session::save();
                return Redirect()->back()->with('message','Thêm mã giảm giá thành công');
            }
        }else{
            return Redirect()->back()->with('error','Thêm mã giảm giá không thành công');
        }
    }

    public function save_cart(Request $request){
        // $productId = $request->productid_hidden;
        $quantity = $request->qty;


        // XEM LẠI KHÚC NÀY CHƯA LẤY RA ĐƯỢC TỪNG ID CỦA PRODUCT
        $product_infor = DB::table('tbl_product')->where('product_id', $request->productid_hidden)->first();



        // Cart::destroy();
        $data ['id'] =$product_infor->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_infor->product_name;
        $data['price'] = $product_infor->product_price;
        $data['weight'] = '123';
        $data['options']['image'] = $product_infor->product_image;

        // Cart::add(['id' => '$product_infor->product_id', 
        // 'name' => '$product_infor->product_name',
        // 'qty' => $quantity, 
        // 'price' => '$product_infor->product_price', 
        // 'weight' => 550, 
        // 'image' => '$product_infor->product_image',
        // 'options' => ['size' => 'large']]);

        Cart::add($data);
        // PHẦN THUẾ
        Cart::setGlobalTax(0);

        return Redirect::to('/show-cart');
        // echo '<pre>';
        // print_r( $quantity);
        // echo '</pre>';

    }
    public function show_cart(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        
        return view('pages.cart.show_cart')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }

    public function update_cart_quantity(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }
}
