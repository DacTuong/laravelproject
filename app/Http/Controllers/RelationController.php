<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\RelationModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;

class RelationController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('admin.dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    //
    public function list_relation()
    {
        // $brands = RelationModel::all();
        $brands = RelationModel::with('brand', 'cate')->get();
        return view('admin.relation.relation_cate_brand.list_relation',  compact('brands'));
    }

    public function add_relation()
    {
        $categories = Category::all();
        return view(
            'admin.relation.relation_cate_brand.add_relation_cate_brand',
            compact('categories')
        );
    }

    public function get_brands()
    {
        $brands = Brand::all();
        $output = '';
        foreach ($brands as $key => $val) {
            $output .= '<option value="' . $val->brand_id . '">' . $val->brand_name . '</option>';
        }
        return response()->json($output);
        // echo $output;
    }

    public function save_relation(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $cate_relation = $data['cate_relation'];
        $brandIds = $request->input('brand_id');
        // echo $cate_relation;
        foreach ($brandIds as $brandId) {

            $save_relation = new RelationModel();
            $save_relation->id_cate =  $cate_relation;
            $save_relation->id_brand = $brandId;
            $save_relation->save();
            // echo 'Số id nhãn hàng là' . $brandId;
        }

        Session::put('message_success', 'Thêm thành công!');
        return Redirect::to('list-relation');
    }
}
