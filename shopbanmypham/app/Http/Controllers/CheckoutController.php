<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Http\Requests;
use Illuminate\Contracts\View\View;
// use Session;
use Illuminate\Support\Facades\Session;
session_start();
use Illuminate\Support\Facades\Redirect;

use Gloudemans\Shoppingcart\Facades\Cart;

use App\Models\City;
use App\Models\Province;
use App\Models\wards;
use App\Models\Feeship;

use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;

class CheckoutController extends Controller
{

    public function confirm_order(Request $request){
        $data =$request->all();
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();

        $shipping_id = $shipping->shipping_id;

        $checkout_code = substr(md5(microtime()),rand(0,26),5);

        $order = new Order();
        $order->customer_id = Session::get('customer_id');
        $order ->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code =  $checkout_code;
        $order->save();

    }

    public function del_fee(){
        Session::forget('fee');
        return redirect()->back();
    }


    public function calculate_fee(Request $request){
        $data =$request->all();
        if($data['matp']){
            $feeship = Feeship::where('fee_matp',$data['matp'])
            ->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship > 0){

                    foreach($feeship as $key => $fee){
                        Session::put('fee',$fee->fee_feeship);
                        Session::save();
                    }
                }else{
                    Session::put('fee',30000);
                    Session::save();
                }
            }
            
        }
    }

    public function select_delivery_home(Request $request){
        $data =$request->all();
        if($data['action']){
            $output ='';
            if($data['action'] == "city"){
                $select_province = Province::where('matp',$data['ma_id'])->orderby('matp','ASC')->get();
                    $output .='<option>--chọn quận huyện--</option>';
                foreach ( $select_province as $key =>$province) {
                    $output .= '<option value=" '.$province->maqh.' ">' .$province->name_qh. '</option>';
                }
            }else{
                $select_wards = wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                    $output .= '<option>--chọn xã/phường/thị trấn--</option>';
                foreach ( $select_wards as $key =>$ward) {
                    $output .= '<option value="' .$ward->xaid.'">' .$ward->name. '</option>';
                }
            }
            echo $output;
        }
    }


    public function AuthLogin(){
        $admin_id= Session::get('admin_id');
        if($admin_id){
            return redirect::to('dashboard');
        }else{
            return redirect::to('admin');
        }
    }


    public function view_order($orderId){
        $this->AuthLogin();
        $order_by_id =DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*')->first();
        
        $manager_order_by_id = view('admin.view_order')->with('order_by_id', $order_by_id);
        return view('admin_layout')->with('admin.view_order',$manager_order_by_id);
    }

    
    public function login_checkout(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        
        return view('pages.checkout.login_checkout')->with('category', $cate_product)->with('brand', $brand_product);
      
    }

    public function register_checkout(){

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();

        return view('pages.checkout.register_checkout')->with('category', $cate_product)->with('brand', $brand_product);
    }


    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->fullname;
        $data['customer_email'] = $request->email;
        $data['customer_password'] = MD5($request->password);
        $data['customer_phone'] = $request->phone_customer;


        $customer_id = DB::table('tbl_customers')->insertGetId($data);

        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->fullname);

        return Redirect('/checkout');
    }

    public function checkout(Request $request){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();

        $city = City::orderby('matp','ASC')->get();
        return view('pages.checkout.show_checkout')->with('category', $cate_product)->with('brand', $brand_product)
        ->with('city', $city);
    }

    public function save_checkout_customer(Request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_notes'] = $request->shipping_notes;


        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id', $shipping_id);
        

        return Redirect('/payment');
    }


    public function payment(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();

        return view('pages.checkout.payment')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function logout_checkout(){
        Session::flush();
        return Redirect('/login-checkout');
    }

    public function login_customer(Request $request){
       
        $email = $request->email_account;
        $password = md5($request->password_account);

        $result = DB::table('tbl_customers')->where('customer_email', $email)->where('customer_password', $password)->first();
        if($result){
            $get_customer = DB::table('tbl_customers')->where('customer_id', $result->customer_id)->get();
            Session::put('customer_id',  $get_customer);
            return Redirect::to('/checkout');
        }else{
            return Redirect::to('/login-checkout');
        }
    }


    public function order_place(Request $request){

        // insert payment
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = "Đang chờ xử lý";
      
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        // insert order
        $order_data=array();
        // LÀM SAO LẤY RA SESSION customer_id
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] =  $payment_id;
        $order_data['order_total'] = Cart::total(0,',','.');
        $order_data['order_status'] ="Đang chờ xử lý";
      
        $order_id = DB::table('tbl_order')->insertGetId( $order_data);

        // insert order_detail
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] =  $v_content->name;
            $order_d_data['product_price'] =$v_content->price;
            $order_d_data['product_sales_quantity'] =$v_content->qty;

            DB::table('tbl_order_details')->insert($order_d_data);
        }
       if( $data['payment_method']==1){
            echo 'Thanh Toán thẻ ATM ';
       }else{
            Cart::destroy();
            $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
    
            return view('pages.checkout.handcash')->with('category', $cate_product)->with('brand', $brand_product);
       }
      
       
    }


    public function manage_order(){

        $this->AuthLogin();
        $all_order =DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name')
        ->orderBy('tbl_order.order_id','desc')->get();
        
        $manager_order = view('admin.manager_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.all_order',$manager_order);
    }

    
}
