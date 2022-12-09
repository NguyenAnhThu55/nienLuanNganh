<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use App\Models\wards;
use App\Models\Feeship;

use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    //update giá tiền vận chuyển
    public function update_feeship(Request $request){
        $data =$request->all();
        $fee_ship = Feeship::find($data['feeship_id']);
        $fee_value = rtrim($data['fee_value'],'.');
        $fee_ship->fee_feeship = $fee_value;
        $fee_ship->save();
    }
    // lấy ra dữ liệu phí guiao hàng
    public function select_feeship(){
        $feeship = Feeship::orderBy('fee_id', 'desc')->get();
        $output='';
        $output .= '<div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tên thành phố</th>
                        <th>Tên quận/huyện</th>
                        <th>Tên xã phường</th>
                        <th>Phí Vận chuyển</th>
                    </tr>
                </thead>

                <tbody>
                ';
                foreach($feeship as $key=>$fee){
                    $output .= '
                    <tr>
                        <td>'.$fee->city->name_city.'</td>
                        <td>'.$fee->province->name_qh.'</td>
                        <td>'.$fee->wards->name.'</td>
                        <td contenteditable data-feeship_id="'.$fee->fee_id.'" class="fee_feeship_edit">'.number_format($fee->fee_feeship,0,',','.').'</td>
                    </tr>
                    ';

                }
                $output .= '
                   
                </tbody>
            </table>
        </div>
        ';
       echo $output;
    }

    // thêm giá vận chuyển theo địa chỉ đặt hàng
    public function insert_delivery(Request $request){
        $data =$request->all();
        $fee_ship = new Feeship();
        $fee_ship->fee_matp = $data['city'];
        $fee_ship->fee_maqh = $data['province'];
        $fee_ship->fee_xaid = $data['wards'];
        $fee_ship->fee_feeship = $data['fee_ship'];
        $fee_ship->save();
    }


    public function delivery(Request $request){
        $city = City::orderBy('matp','ASC')->get();
        return view('admin.delivery.add_delivery')->with(compact('city'));
    } 
// lấy dữ liệu xã phường theo tỉnh thành phố
    public function select_delivery(Request $request){
        $data =$request->all();
        if($data['action']){
            $output ='';
            if($data['action'] == "city"){
                $select_province = Province::where('matp',$data['ma_id'])->orderby('matp','ASC')->get();
                    $output .='<option>---chọn quận huyện---</option>';
                foreach ( $select_province as $key =>$province) {
                    $output .= '<option value=" '.$province->maqh.' ">' .$province->name_qh. '</option>';
                }
            }else{
                $select_wards = wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                    $output .= '<option>---chọn xã/phường/thị trấn---</option>';
                foreach ( $select_wards as $key =>$ward) {
                    $output .= '<option value="' .$ward->xaid.'">' .$ward->name. '</option>';
                }
            }
        }
        echo $output;
    }

}
