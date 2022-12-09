<?php

    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use App\User;
    use App\Http\Requests;
    use App\Models\Statistic;
    use App\Models\Vistor;
    use App\Models\Product;
    use App\Models\Order;
    use App\Models\Customer;
    

    use Carbon\Carbon;
    use Carbon\Exceptions\BadComparisonUnitException;
    use Carbon\Exceptions\ImmutableException;
    use Carbon\Exceptions\InvalidDateException;
    use Carbon\Exceptions\InvalidFormatException;
    use Carbon\Exceptions\UnknownGetterException;
    use Carbon\Exceptions\UnknownMethodException;
    use Carbon\Exceptions\UnknownSetterException;
    use Illuminate\Contracts\View\View;
    // use Session;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Redirect;
    session_start();
    use Log;
    class AdminController extends Controller
    {
        public function index(){
            return view('admin_login');
        }
        // thể hiện truy cập
        public function show_dashboard(Request $request){
            $user_ip_address = $request->ip();
            $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
            $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
            $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
            $oneyears = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
            $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

            // total last month
            $visitor_of_lastmonth = Vistor::whereBetween('date_visitor',[$early_last_month,$end_of_last_month])->get();
            $visitor_last_month_count = $visitor_of_lastmonth->count();
            // total this month
            $visitor_of_thismonth = Vistor::whereBetween('date_visitor',[$early_this_month,$now])->get();
            $visitor_this_month_count = $visitor_of_thismonth->count();
            // total in one years
            $visitor_of_year= Vistor::whereBetween('date_visitor',[$oneyears,$now])->get();
            $visitor_year_count = $visitor_of_year->count();
            // current online
            $visitor_current = Vistor::where('ip_address',$user_ip_address)->get();
            $visitor_count = $visitor_current->count();

            if($visitor_count<1){
                $visitor = new Vistor();
                $visitor->ip_address = $user_ip_address;
                $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                $visitor->save();

            }
            // total visitors
            $visitors = Vistor::all();
            $visitors_total = $visitors->count();
            // total
            $product = Product::all()->count();
            // $product_views = Product::orderBy('product_views','DESC')->take(20)->get();
            // $post = Post::all()->count();
            // $post_views = Post::orderBy('post_views','DESC')->take(20)->get();
            $order = Order::all()->count();
            $customer = Customer::all()->count();

            return view('admin.dashboard')->with(compact('visitors_total','visitor_count','visitor_last_month_count','visitor_this_month_count','visitor_year_count',
            'product','order','customer'));



        }
        // lộc 30 ngày
        public function days_order(Request $request){
            $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
            $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $get = Statistic::whereBetween('order_date',[$sub30days,$now])->orderBy('order_date','ASC')->get();
            foreach($get as $key => $val){
                $chart_data[]= array(
                    'period' => $val->order_date,
                    'order' => $val->order_order,
                    'sales' => $val->sales,
                    'profit' => $val->profit,
                    'quantity' => $val->quantity
                );
            }
            echo $data = json_encode($chart_data);
        }

        // lộc doanh số theo tuần tháng năm 
        public function dashboard_filter(Request $request){
            $data =$request->all();
            $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
            $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
            $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

            $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
            $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
            $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

            if($data['dashboard_value']==='7ngay'){
                $get = Statistic::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
                
            }elseif($data['dashboard_value']==='thangtruoc'){
                $get = Statistic::whereBetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date','ASC')->get();

            }elseif($data['dashboard_value']==='thangnay'){
                $get = Statistic::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();
                
            }else{
                
                $get = Statistic::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->get();
            }

            foreach($get as $key => $val){
                $chart_data[]= array(
                    'period' => $val->order_date,
                    'order' => $val->order_order,
                    'sales' => $val->sales,
                    'profit' => $val->profit,
                    'quantity' => $val->quantity
                );
            }
            echo $data = json_encode($chart_data);
        }   

        // phần lộc doanh số
        public function filter_by_date(Request $request){
            $data =$request->all();
            $from_date = $data['from_date'];
            $to_date = $data['to_date'];

            $get = Statistic::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();

            foreach($get as $key => $val){
                $chart_data[]= array(
                    'period' => $val->order_date,
                    'order' => $val->order_order,
                    'sales' => $val->sales,
                    'profit' => $val->profit,
                    'quantity' => $val->quantity
                );
            }
            echo $data = json_encode($chart_data);
        }

        // public function show_dashboard(){
        //     return view('admin.dashboard');
        // }
        // PHẦN ANYF CÒN CHƯA LẤY RA ĐƯỢC DỮ LIỆU
        public function dashboard(Request $request){
            $admin_email = $request->admin_email;
            $admin_password = md5($request->admin_password);
            $result = DB::table('tbl_admin')
            ->where(['admin_email' => $admin_email,'admin_password' => $admin_password])
            ->first();
            // return View('admin.dashboard');
            // Log::info('result is '.$result);    // just for checking result (storage/logs)    
            if (($result)){
                Session::put('admin_name',$result->admin_name);
                Session::put('admin_id',$result->admin_id);
                return redirect::to('/dashboard');
            }else{
                Session::put('message', 'Email hoặc Mật khẩu đã sai! Vui lòng nhập lại.');
                return redirect::to('/admin');
            }
            
        }

        public function logout(){
            Session::put('admin_name',null);
            Session::put('admin_id',null);
            return redirect::to('/admin');
        }

    }
// ?>
