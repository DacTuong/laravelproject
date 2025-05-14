<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Category;
use App\Models\BannerModel;
use Illuminate\Support\Facades\Redirect;
use App\Models\CateActicleModel;
use App\Models\RelationModel;

session_start();
class BrandController extends Controller
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

    public function add_brand()
    {
        $this->AuthLogin();
        $category = Category::all();
        return view('admin.brand.add_brand')->with('category', $category);
    }
    public function save_brand(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name = $data['brand_name'];
        $brand->brand_status = $data['brand_status'];
        $brand->category_pro_id = $data['category_pro_id'];
        $brand->save();

        Session::put('message_success', 'Thêm thành công!');
        return Redirect::to('add-brand');
    }

    public function list_brand()
    {
        $this->AuthLogin();
        $list_brand = Brand::all();
        $manager_brand = view('admin.brand.list_brand')->with('list_brand', $list_brand);
        return view('admin_layout')->with('admin.list_brand', $manager_brand);
    }
    public function inactive_brand($brand_id)
    {
        $this->AuthLogin();
        $brand = Brand::find($brand_id);
        $brand->brand_status = 1;
        $brand->save();
        Session::put('message_success', 'Hiển thị thành công!');
        return Redirect::to('list-brand');
    }
    public function active_brand($brand_id)
    {
        $this->AuthLogin();
        $brand = Brand::find($brand_id);
        $brand->brand_status = 0;
        $brand->save();
        Session::put('message_success', 'An thành công!');
        return Redirect::to('list-brand');
    }
    public function edit_brand($brand_id)
    {
        $this->AuthLogin();

        $edit_brand = Brand::find($brand_id);
        $category = Category::all();
        $manager_brand = view('admin.brand.edit_brand')->with('edit_brand', $edit_brand)->with('category', $category);
        return view('admin_layout')->with('admin.brand.edit_brand', $manager_brand);
    }

    public function update_brand(Request $request, $brand_id)
    {

        $this->AuthLogin();
        $brand = Brand::find($brand_id);
        $brand->brand_name = $request->brand_name;
        $brand->category_pro_id = $request->category_pro_id;
        $brand->save();
        Session::put('message_success', 'Cập nhật thành công!');
        return Redirect::to('list-brand');
    }
    public function delete_brand($brand_id)
    {
        $this->AuthLogin();
        $brand = Brand::find($brand_id);
        $brand->delete();
        Session::put('message_success', 'Xóa thành công!');
        return Redirect::to('list-brand');
    }



    public function select_brand(Request $request)
    {
        $this->AuthLogin();

        $id_cate = $request->id;
        $select_brand = RelationModel::with('brand', 'cate')->where('id_cate', $id_cate)->get();
        $output = '';

        foreach ($select_brand as $key => $val) {
            $output .= '<option value="' . $val->id_brand . '">' . $val->brand->brand_name . '</option>';
        }
        return response()->json($output);
    }
    // USER


    public function show_brand_user(Request $request, $brand_id)
    {
        $category = Category::get();
        $banners = BannerModel::all();

        $list_product = Product::with(['category'])->where('brand_product_id', $brand_id)
            ->where('product_status', 1);

        // Lọc theo giá
        if ($request->has('sort_by')) {
            if ($request->get('sort_by') == 'giam_dan') {
                $list_product->orderBy('sale_price', 'desc');
            } elseif ($request->get('sort_by') == 'tang_dan') {
                $list_product->orderBy('sale_price', 'asc');
            }
        }

        // Lọc theo RAM
        if ($request->has('filter_mobile_ram')) {
            // Chuyển giá trị thành mảng
            $ramFilters = explode(',', $request->get('filter_mobile_ram'));

            // Áp dụng các điều kiện lọc
            $list_product->where(function ($query) use ($ramFilters) {
                foreach ($ramFilters as $ramFilter) {
                    switch ($ramFilter) {
                        case '<4':
                            $query->orWhere('ram', '<', 4);
                            break;
                        case '4gb_8gb':
                            $query->orWhereBetween('ram', [4, 8]);
                            break;
                        case '8gb_12gb':
                            $query->orWhereBetween('ram', [8, 12]);
                            break;
                        case '>12gb':
                            $query->orWhere('ram', '>', 12);
                            break;
                    }
                }
            });
        }

        if ($request->has('filter_price')) {
            // Chuyển giá trị thành mảng
            $filterPrices = explode(',', $request->get('filter_price'));

            // Áp dụng các điều kiện lọc
            $list_product->where(function ($query) use ($filterPrices) {
                foreach ($filterPrices as $filterPrice) {
                    switch ($filterPrice) {
                        case '1000000-5000000':
                            $query->orWhereBetween('sale_price', [1000000, 5000000]);
                            break;
                        case '5000000-10000000':
                            $query->orWhereBetween('sale_price', [5000000, 10000000]);
                            break;
                        case '10000000-15000000':
                            $query->orWhereBetween('sale_price', [10000000, 15000000]);
                            break;
                        case '15000000-20000000':
                            $query->orWhereBetween('sale_price', [15000000, 20000000]);
                            break;
                        case '20000000-25000000':
                            $query->orWhereBetween('sale_price', [20000000, 25000000]);
                            break;
                        case '25000000-30000000':
                            $query->orWhereBetween('sale_price', [25000000, 30000000]);
                            break;
                        case '>30000000':
                            $query->orWhere('sale_price', '>', 30000000);
                            break;
                    }
                }
            });
        }


        // Lọc theo loại điện thoại
        if ($request->has('filter_mobile')) {
            $filterMobiles = explode(',', $request->get('filter_mobile'));
            $list_product->whereIn('categories_product_id', $filterMobiles);
        }

        if ($request->has('filter_refresh_rates')) {
            $filterRefresh = $request->get('filter_refresh_rates');
            if ($filterRefresh === '60-120hz') {
                $list_product->whereBetween('refresh_rate', [60, 120]);
            } else {
                $filterValues = explode(',', $filterRefresh);
                $list_product->whereIn('refresh_rate', $filterValues);
            }
        }


        // Lấy danh sách sản phẩm sau khi lọc
        $products = $list_product->get();


        // Lấy danh sách sản phẩm sau khi lọc
        $products = $list_product->get();

        $groupedCateProducts = $products->groupBy('categories_product_id');
        // Lấy danh sách thương hiệu để hiển thị trong bộ lọc
        $brands = Brand::all();

        return view('user.category.show_category')
            ->with('products_by_brand', $products)
            ->with('brands', $brands)
            ->with('banners', $banners)
            ->with('categorys', $category)
            ->with('groupedCateProducts', $groupedCateProducts)
            ->with('selected_sort', $request->get('sort_by', 'none'))
            ->with('selected_ram', $request->get('filter_mobile_ram', 'none'))

        ;
    }
}
