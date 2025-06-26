<?php

namespace App\Http\Controllers;

use App\Models\ShippingAddress;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Brand;
use App\Models\BannerModel;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Province;
use App\Models\District;
use App\Models\FeeshipModel;
use App\Models\OrderDetail;
use App\Models\OrderProduct;
use App\Models\Ward;
use App\Models\CateActicleModel;



use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;

session_start();

class CheckoutController extends Controller
{
    public function login_index()
    {
        return view('user.account.login');
    }

    public function register_index()
    {
        return view('user.account.register');
    }

    public function logout()
    {
        Session::flush();
        Session::forget('cart');
        Session::forget('coupon');
        return Redirect::to('/');
    }

    public function add_customer(Request $request)
    {
        $data = $request->all();

        $checkEmail = User::where('email_user', $data['user_email'])->first();


        $checkPhone = User::where('phone_user', $data['user_phone'])->first();
        if ($checkEmail && $checkPhone) {
            return Redirect::back()->with('error', 'Email và số điện thoại đã được sử dụng!');
        } elseif ($checkEmail) {
            return Redirect::back()->with('error', 'Email đã được sử dụng!');
        } elseif ($checkPhone) {
            return Redirect::back()->with('error', 'Số điện thoại đã được sử dụng!');
        }


        $user_add = new User;
        $user_add->name_user = $data['user_name'];
        $user_add->email_user = $data['user_email'];
        $user_add->password_user = $data['user_password'];
        $user_add->status_user = 1;
        $user_add->phone_user = $data['user_phone'];
        $user_add->save();

        $id_user = $user_add->id_user;
        // echo $id_user;

        Session::put('id_customer', $id_user);
        Session::put('name_customer', $user_add->name_user);
        return Redirect::to('/');
    }


    public function login_customer(Request $request)
    {
        $email_customer = $request->user_email;
        $password_customer = $request->user_password;

        $result = User::where('email_user', $email_customer)->where('password_user', $password_customer)->first();

        if ($result) {
            Session::put('id_customer', $result->id_user);
            Session::put('name_customer', $result->name_user);
            return Redirect::to('/');
        } else {
            Session::put('message', 'Sai mật khẩu hoặc tài khoản,vui lòng nhập lại');
            return view('user.account.login');
        }
    }

    public function checkout()
    {
        $province = Province::all();
        $brand = Brand::get();
        $category = Category::get();
        $banners = BannerModel::all();



        return view('user.shopping.checkout')
            ->with('provinces', $province)
            ->with('brands', $brand)
            ->with('category', $category)
            ->with('banners', $banners)

        ;
    }


    public function select_district_shipping(Request $request)
    {
        $data = $request->all();
        $id_city = $data['id_city'];
        $districts = District::where('matp', $id_city)->get();
        $output = '<option value="">Chọn Quận/Huyện</option>';
        foreach ($districts as $district) {
            $output .= '<option value="' . $district->maqh . '">' . $district->name . '</option>';
        }
        echo $output;
    }

    public function select_wards_shipping(Request $request)
    {
        $data = $request->all();
        $districtID = $data['id_district'];
        $wards = Ward::where('maqh', $districtID)->get();
        $output = '<option value="">Chọn Xã/Phường</option>';
        foreach ($wards as $ward) {
            $output .= '<option value="' . $ward->xaid . '">' . $ward->name . '</option>';
        }
        echo $output;
    }




    public function order_product(Request $request)
    {

        $data = $request->all();
        $variable_Cart = Session::get('cart');
        $id_user = Session::get('id_customer');
        $nameorder = $data['fullname'];
        $phonenumber = $data['phonenumber'];
        $city = $data['city'];
        $district = $data['district'];
        $wards = $data['wards'];
        $address = $data['address'];

        $shipping_address = new ShippingAddress();
        $shipping_address->fullname = $nameorder;
        $shipping_address->order_phone = $phonenumber;
        $shipping_address->matp = $city;
        $shipping_address->maqh = $district;
        $shipping_address->xaid = $wards;
        $shipping_address->diachi = $address;
        $shipping_address->save();

        $id_shipping_address =  $shipping_address->id_shipping;
        $email = $data['email_order'];

        $shipping_fee = $data['feeship'];
        $order_total = $data['totalOrder'];
        $discount = $data['discount'];
        $note = $data['note'];

        $randomString = Str::random(5);
        $code_order = $randomString;


        $add_order = new OrderProduct();
        $add_order->order_code = $code_order;
        $add_order->order_email = $email;
        $add_order->id_customer = $id_user;
        $add_order->shipping_id = $id_shipping_address;
        $add_order->feeship = $shipping_fee;
        $add_order->discount_coupon_id = $discount;
        $add_order->order_total = $order_total;
        $add_order->order_status = 1;
        $add_order->order_note = $note;
        $add_order->save();
        $code_order_detail =  $add_order->order_code;

        if ($variable_Cart) {
            foreach ($variable_Cart as $item) {
                $add_detail_order = new OrderDetail();
                $add_detail_order->order_code = $code_order_detail;
                $add_detail_order->order_phone_id = $item['masp'];
                $add_detail_order->product_price = $item['gia'];
                $add_detail_order->product_sale_quantity = $item['soluong'];
                $add_detail_order->save();
            }
            Session::forget('cart');
            Session::forget('total_price');
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Đơn hàng đã được gửi thành công!',
        ]);
    }
}