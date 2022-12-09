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
    use Log;
    class AdminController extends Controller
    {
        public function index(){
            return view('admin_login');
        }
        public function show_dashboard(){
            return view('admin.dashboard');
        }
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
