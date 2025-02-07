<?php

namespace App\Http\Controllers;

use App\Models\CommentModel;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\SantisticalModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;

session_start();
class AdminController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            Redirect::to('admin.dashboard');
        } else {
            return Redirect::to('admincp')->send();
        }
    }

    public function index()
    {
        return view('admin.admin_login');
    }

    public function show_dashboard()
    {
        $this->AuthLogin();

        $order_pedding = OrderProduct::where('order_status', 1)->count();
        $order_success = OrderProduct::where('order_status', 2)->count();
        $count_comment = CommentModel::where('repped', 1)->count();
        $total_order = OrderProduct::count();
        $product = Product::count();
        $santisticle = SantisticalModel::get();
        return view('admin.dashboard')
            ->with('order_pedding', $order_pedding)
            ->with('count_product', $product)
            ->with('total_order', $total_order)
            ->with('order_success', $order_success)
            ->with('new_comment', $count_comment)
            ->with('santisticle', $santisticle)
        ;
    }
    public function login(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();

        if ($result) {
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        } else {
            Session::put('message', 'Sai mật khẩu hoặc tài khoản,vui lòng nhập lại');
            return Redirect::to('/admincp');
        }
    }
    public function logout()
    {
        $this->AuthLogin();
        Session::forget('admin_name');
        Session::forget('admin_id');
        return Redirect::to('/admincp');
    }

    public function list_user(){
        $user = User::get();
        return view("admin.user.user_list")->with("users",$user);
    }
}
