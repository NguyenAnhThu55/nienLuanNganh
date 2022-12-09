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
use App\Models\Customer;
use App\Models\OrderDetails;
use App\Models\Product;
use Barryvdh\DomPDF\Facade;
use Barryvdh\DomPDF\PDF;


class CheckoutController extends Controller

{

    public function update_qty(Request $request){
		$data = $request->all();
		$order_details = OrderDetails::where('product_id',$data['order_product_id'])->where('order_id',$data['order_id'])->first();
		$order_details->product_sales_quantity = $data['order_qty'];
		$order_details->save();
	}
	public function update_order_qty(Request $request){
		//update order
		$data = $request->all();
		$order = Order::find($data['order_id']);
		$order->order_status = $data['order_status'];
		$order->save();
		if($order->order_status==2){
			foreach($data['order_product_id'] as $key => $product_id){
				
				$product = Product::find($product_id);
				$product_quantity = $product->product_quantity;
				$product_sold = $product->product_sold;
				foreach($data['quantity'] as $key2 => $qty){
						if($key==$key2){
								$pro_remain = $product_quantity - $qty;
								$product->product_quantity = $pro_remain;
								$product->product_sold = $product_sold + $qty;
								$product->save();
						}
				}
			}
		}
        // elseif($order->order_status!=2 && $order->order_status!=3){
		// 	foreach($data['order_product_id'] as $key => $product_id){
				
		// 		$product = Product::find($product_id);
		// 		$product_quantity = $product->product_quantity;
		// 		$product_sold = $product->product_sold;
		// 		foreach($data['quantity'] as $key2 => $qty){
		// 				if($key==$key2){
		// 						$pro_remain = $product_quantity + $qty;
		// 						$product->product_quantity = $pro_remain;
		// 						$product->product_sold = $product_sold - $qty;
		// 						$product->save();
		// 				}
		// 		}
		// 	}
		// }


	}

    public function print_order($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf -> loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code){
        $order_details = Order::where('order_id', $checkout_code)->get();
        $order = Order::where('order_id', $checkout_code)->get();

        foreach($order as$key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }

        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();
        $order_details_product = OrderDetails::with('product')->where('order_id', $checkout_code)->get();
        $output ='';
        $output = '<style>
                    body{
                        font-family:DejaVu Sans;
                    }
                    .TableData {
                        background:#ffffff;
                        font: 13px;
                        width:100%;
                        border-collapse:collapse;
                       
                        font-size:13px;
                        border:thin solid #d3d3d3;
                    }
                    .title {
                        text-align:center;
                        position:relative;
                        color:#0000FF;
                        font-size: 24px;
                        top:1px;
                    }
                    .footer-left {
                        text-align:center;
                        text-transform:uppercase;
                        padding-top:24px;
                        position:relative;
                        height: 150px;
                        width:50%;
                        color:#000;
                        float:left;
                        font-size: 12px;
                        bottom:1px;
                    }
                    .footer-right {
                        text-align:center;
                        text-transform:uppercase;
                        padding-top:24px;
                        position:relative;
                        height: 150px;
                        width:50%;
                        color:#000;
                        font-size: 12px;
                        float:right;
                        bottom:1px;
                    }
                    .TableData TH {
                        background: rgba(0,0,255,0.1);
                        text-align: center;
                        font-weight: bold;
                        color: #000;
                        border: solid 1px #ccc;
                        height: 24px;
                    }
                    .TableData TR {
                        height: 24px;
                        border:thin solid #d3d3d3;
                    }
                    .TableData TR TD {
                        padding-right: 2px;
                        padding-left: 2px;
                        border:thin solid #d3d3d3;
                        text-align: center;
                    }
                    .TableData TR:hover {
                        background: rgba(0,0,0,0.05);
                    }
                    .TableData .cotSTT {
                        text-align:center;
                        width: 10%;
                    }
                    .TableData .cotTenSanPham {
                        text-align:left;
                        width: 40%;
                    }
                    .TableData .cotHangSanXuat {
                        text-align:left;
                        width: 20%;
                    }
                    .TableData .cotGia {
                        text-align:right;
                        width: 120px;
                    }
                    .TableData .cotSoLuong {
                        text-align: center;
                        width: 50px;
                    }
                    .TableData .cotSo {
                        text-align: right;
                        width: 120px;
                    }
                    .TableData .tong {
                        text-align: right;
                        font-weight:bold;
                        text-transform:uppercase;
                        padding-right: 4px;
                    }
                    .TableData .cotSoLuong input {
                        text-align: center;
                    }
                    </style>
            <h1><center> Shop Mỹ Phẩm CoCoLux</center></h1>
            <br/>
            <div class="title">
                    HÓA ĐƠN THANH TOÁN
                    <br/>
                    -------oOo-------
            </div>
            <br/>
            <span>Thông tin người nhận</span>
            <table class="TableData">
                <thead>
                    <tr>
                        <th><center>Tên Khách Hàng</center></th>
                        <th>SDT</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Ghi chú</th>
                    </tr>
                </thead>
                <tbody>';
                $output.='
                        <tr>
                            <td>'.$shipping->shipping_name.'</td>
                            <td>'.$shipping->shipping_phone.'</td>
                            <td>'.$shipping->shipping_email.'</td>
                            <td>'.$shipping->shipping_address.'</td>
                            <td>'.$shipping->shipping_notes.'</td>
                        </tr>';
                $output.='
                </tbody>
            </table>
            <hr>
                <span>Thông tin đơn hàng</span>
            <table class="TableData">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <body>';
                foreach($order_details_product as $key=>$product){
                    $subtotal = $product->product_price*$product->product_sales_quantity;
                $output.='
                    <tr>
                        <td class="cotTenSanPham">'.$product->product_name.'</td>
                        <td class="cotSTT">'.number_format($product->product_price,0,',','.').'</td>
                        <td class="cotGia">'.$product->product_sales_quantity.'</td>
                        <td class="cotSo">'.number_format($product->product_price*$product->product_sales_quantity,0,',','.').'</td>
                    </tr>

                    <tr>
                        <td colspan="3" class="tong">Tổng cộng</td>
                        <td class="cotSo">'.number_format($subtotal,0,',','.').' ₫'.'</td>
                    </tr>';
                }
                $output.='
                </body>
            </table>
           
            <div class="footer-left"> Cần thơ, ngày 13 tháng 2 năm 2022<br/>
            Khách hàng </div>
          <div class="footer-right"> Cần thơ, ngày 13 tháng 2 năm 2022<br/>
            Nhân viên </div>
        ';
        return  $output;
        // return $checkout_code;
    }

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
        
        // $session_id =  substr(md5(microtime()),rand(0,26),5);
        // $cart = Session::get('cart');
        // $cart[]= array(
        //     'session_id' => $session_id,
        //     'product_name' => $data['product_name'],
        //     'product_id' => $data['product_id'],
        //     'product_price' => $data['product_price'],
        //     'product_image' => $data['product_image'],
        //     'product_qty' => $data['product_qty'],
        
        // );
        // Session::put('cart',$cart);
        

        if(Session::get('cart')){                                   
            foreach(Session::get('cart') as $key => $carts){
                
                $order_details = new OrderDetails();

                $order_details->order_code =  $checkout_code;
                $order_details->product_id = Session::get('product_id');
                $order_details->product_name = $data['product_name']; 
                $order_details->product_price = $data['product_price'];
                $order_details->cart_quantity= $data['cart_quantity'];
                $order_details->product_coupon = $data['order_coupon'];
                $order_details->product_feeship = $data['order_fee'];

                $order_details->save();
            }
        }

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

    public function select_shipping(){      

        $shipping = DB::table('tbl_shipping')->orderBy('shipping_id','desc')->limit(1)->get();
        
       
        return view('pages.checkout.payment')->with('shipping', $shipping);
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
    
        $order_detail = OrderDetails::with('product')->where('order_id',$orderId)->get();
        $order = Order::where('order_id',$orderId)->get();
        foreach ($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $order_status = $ord->order_status;
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();
        
        $order_detail = OrderDetails::with('product')->where('order_id', $orderId)->get(); 
        
        return view('admin.view_order')->with('order_detail',$order_detail)->with('customer',$customer)->with('shipping',$shipping)->with('order_detail',$order_detail)->with('order_status',$order_status);
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
        $data['shipping_method'] = $request->shipping_method;


        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id', $shipping_id);
        

        return Redirect('/payment');
    }



    public function payment(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        
        $shipping = DB::table('tbl_shipping')->orderBy('shipping_id','desc')->first();
        

        return view('pages.checkout.payment')->with('category', $cate_product)->with('brand', $brand_product)->with('shipping', $shipping);
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

        // insert order
        $order_data=array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] =  Session::get('shipping_id');
        $order_data['shipping_method'] = 0;
        $order_data['order_total'] =Cart::total(0,',','.');
        $order_data['order_status'] = "Đang chờ xử lý";
       
        
        $order_id = DB::table('tbl_order')->insertGetId( $order_data);

        // insert order_detail
        $content = Cart::content();
        // echo $content;
        foreach($content as $v_content){
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] =  $v_content->name;
            $order_d_data['product_price'] =$v_content->price;
            $order_d_data['product_sales_quantity'] =$v_content->qty;

            DB::table('tbl_order_details')->insert($order_d_data);
        }
       if( $order_data['shipping_method']==1){
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
        ->orderBy('tbl_order.order_id','desc')->paginate(5);
        
        $manager_order = view('admin.manager_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.all_order',$manager_order);
    }

    
}
