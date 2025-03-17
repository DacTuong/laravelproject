<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupons;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CouponsController extends Controller
{
    public function add_discount()
    {
        return view('admin.coupon.discount_code');
    }

    public function save_coupons(Request $request)
    {
        $data_coupon = $request->all();
        $coupon = new Coupons();
        $coupon->name_coupon = $data_coupon['name_code'];
        $coupon->coupon_code = $data_coupon['discountCode'];
        $coupon->coupon_qty = $data_coupon['qty_code'];
        $coupon->coupon_type = $data_coupon['type_code'];
        $coupon->discount_amount = $data_coupon['discount_amount'];
        $coupon->start_date = $data_coupon['start_date'];
        $coupon->end_date = $data_coupon['end_date'];
        $coupon->coupon_status = 1;
        $coupon->save();
        return Redirect::to('/add-discount-code');
    }

    public function list_coupons()
    {
        $coupons = Coupons::get();
        return view('admin.coupon.list_coupons')->with('list_coupon',  $coupons);
    }

    public function delete_coupon($id_coupon)
    {
        $coupon = Coupons::find($id_coupon);
        $coupon->delete();
        return Redirect::to('/list-coupons');
    }
    public function update_coupon($id_coupon)
    {
        $coupon = Coupons::find($id_coupon);
        return view('admin.coupon.update_coupon')->with('coupon_update',  $coupon);
    }



    // USER
    public function check_coupon(Request $request)
    {
        $data = $request->all();
        $id_user = Session::get('id_customer');

        $coupon = Coupons::where('coupon_code', $data['code_coupon'])->where('coupon_status', 1)->first();

        if ($coupon) {
            $cou[] = array(
                'coupon_id' => $coupon->id_coupon,
                'coupon_code' => $coupon->coupon_code,
                'coupon_type' => $coupon->coupon_type,
                'discount' => $coupon->discount_amount,
            );
            Session::put('coupon', $cou);



            Session::save();

            $extist_id = explode(',', $coupon->customer_id);
            if (in_array($id_user, $extist_id)) {
                echo 'Bạn đã sử dụng mã giảm giá này rồi';
            } else {
                if ($coupon->customer_id) {
                    $coupon->customer_id .= ',' . $id_user;
                } else {
                    $coupon->customer_id = $id_user;
                }
                $coupon->coupon_qty = $coupon->coupon_qty - 1;
                // Session::forget('final_total');
                $coupon->save();
                echo 'Dùng mã giảm giá thành công';
            }
        }
        return Redirect::to('checkout');
    }

    public function delete_coupon_checkout()
    {
        // Lấy thông tin mã giảm giá từ session
        $coupon_session = Session::get('coupon');
        $id_customer = Session::get('id_customer');

        if ($coupon_session && $id_customer) {
            foreach ($coupon_session as $coupon) {
                // Truy vấn mã giảm giá từ cơ sở dữ liệu theo coupon_code
                $coupon_data = Coupons::where('coupon_code', $coupon['coupon_code'])->first();

                if ($coupon_data) {
                    // Lấy danh sách ID khách hàng hiện tại
                    $exist_ids = explode(',', $coupon_data->customer_id);

                    // Xóa id_customer khỏi danh sách
                    $updated_ids = array_diff($exist_ids, [$id_customer]);
                    $coupon_data->customer_id = implode(',', $updated_ids);
                    $coupon_data->coupon_qty = $coupon_data->coupon_qty + 1;
                    // Lưu lại thay đổi vào cơ sở dữ liệu
                    $coupon_data->save();
                }
            }
            // Xóa toàn bộ session coupon
            Session::forget('coupon');
        }

        // Chuyển hướng lại giỏ hàng
        return Redirect::to('checkout');
    }
}
