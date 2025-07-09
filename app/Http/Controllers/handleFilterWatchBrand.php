<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SmartwatchModel;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use App\Models\Product;

use App\Models\Category;

class handleFilterWatchBrand extends Controller
{
    public function handleFilterWatchScreenTypeBrand(Request $request, $slug)
    {
        $query = SmartwatchModel::query();
        $brandID = Brand::where('brand_slug', $slug)->value('brand_id');


        // filter by watch strap material
        if ($request->filled('filter_watch_strap_material')) {
            $filter_watch_strap_material = explode(',', $request->input('filter_watch_strap_material'));
            $query->whereIn('watch_strap_material', $filter_watch_strap_material);
        }
        // filter by watch face design
        if ($request->filled('filter_watch_face_design')) {
            $filter_watch_face_design = explode(',', $request->input('filter_watch_face_design'));
            $query->whereIn('watch_face_design', $filter_watch_face_design);
        }
        // filter by wrist size range
        if ($request->filled('filter_wrist_size_range')) {
            $filter_wrist_size_range = explode(',', $request->input('filter_wrist_size_range'));
            $query->whereIn('wrist_size_range', $filter_wrist_size_range);
        }

        return $query->select('watch_screen_type', DB::raw('COUNT(*) as total_nfc'))
            ->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID))
            ->groupBy('watch_screen_type')
            ->get();
    }


    public function handleFilterWatchFaceDesignBrand(Request $request, $slug)
    {
        $query = SmartwatchModel::query();
        $brandID = Brand::where('brand_slug', $slug)->value('brand_id');



        // filter by watch screen type
        if ($request->filled('filter_watch_screen_type')) {
            $filter_watch_screen_type = explode(',', $request->input('filter_watch_screen_type'));
            $query->whereIn('watch_screen_type', $filter_watch_screen_type);
        }
        // filter by watch strap material
        if ($request->filled('filter_watch_strap_material')) {
            $filter_watch_strap_material = explode(',', $request->input('filter_watch_strap_material'));
            $query->whereIn('watch_strap_material', $filter_watch_strap_material);
        }

        // filter by wrist size range
        if ($request->filled('filter_wrist_size_range')) {
            $filter_wrist_size_range = explode(',', $request->input('filter_wrist_size_range'));
            $query->whereIn('wrist_size_range', $filter_wrist_size_range);
        }


        return $query->select('watch_face_design')
            ->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID))
            ->groupBy('watch_face_design')
            ->get();
    }

    public function handleFilterWristSizeBrand(Request $request, $slug)
    {
        $query = SmartwatchModel::query();

        $brandID = Brand::where('brand_slug', $slug)->value('brand_id');




        // filter by watch screen type
        if ($request->filled('filter_watch_screen_type')) {
            $filter_watch_screen_type = explode(',', $request->input('filter_watch_screen_type'));
            $query->whereIn('watch_screen_type', $filter_watch_screen_type);
        }
        // filter by watch strap material
        if ($request->filled('filter_watch_strap_material')) {
            $filter_watch_strap_material = explode(',', $request->input('filter_watch_strap_material'));
            $query->whereIn('watch_strap_material', $filter_watch_strap_material);
        }
        // filter by watch face design
        if ($request->filled('filter_watch_face_design')) {
            $filter_watch_face_design = explode(',', $request->input('filter_watch_face_design'));
            $query->whereIn('watch_face_design', $filter_watch_face_design);
        }



        return $query->select('wrist_size_range')
            ->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID))
            ->groupBy('wrist_size_range')
            ->get();
    }

    public function handleFilterStrapMaterialBrand(Request $request, $slug)
    {

        $query = SmartwatchModel::query();
        $brandID = Brand::where('brand_slug', $slug)->value('brand_id');



        // filter by watch screen type
        if ($request->filled('filter_watch_screen_type')) {
            $filter_watch_screen_type = explode(',', $request->input('filter_watch_screen_type'));
            $query->whereIn('watch_screen_type', $filter_watch_screen_type);
        }

        // filter by watch face design
        if ($request->filled('filter_watch_face_design')) {
            $filter_watch_face_design = explode(',', $request->input('filter_watch_face_design'));
            $query->whereIn('watch_face_design', $filter_watch_face_design);
        }
        // filter by wrist size range
        if ($request->filled('filter_wrist_size_range')) {
            $filter_wrist_size_range = explode(',', $request->input('filter_wrist_size_range'));
            $query->whereIn('wrist_size_range', $filter_wrist_size_range);
        }


        return $query->select('watch_strap_material')
            ->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID))
            ->groupBy('watch_strap_material')
            ->get();
    }


    public function filterWatchByRequestBrand(Request $request, $cate_slug,  $slug)
    {
        $brandID = Brand::where('brand_slug', $slug)->value('brand_id');
        $cate_id = Category::where('cate_Slug', $cate_slug)->value('category_id');

        $query =  Product::with(['category', 'brand', 'smartwatch'])
            ->where('categories_product_id', $cate_id)
            ->where('brand_product_id', $brandID)
            ->where('product_status', 1);
        //  Filter Watch by brand request 


        // filter by watch screen type
        if ($request->filled('filter_watch_screen_type')) {
            $filter_watch_screen_type = explode(',', $request->input('filter_watch_screen_type'));
            $query->whereHas('smartwatch', fn($q) => $q->whereIN('watch_screen_type', $filter_watch_screen_type));
        }
        // filter by watch strap material
        if ($request->filled('filter_watch_strap_material')) {
            $filter_watch_strap_material = explode(',', $request->input('filter_watch_strap_material'));
            $query->whereHas('smartwatch', fn($q) => $q->whereIn('watch_strap_material', $filter_watch_strap_material));
        }
        // filter by watch face design
        if ($request->filled('filter_watch_face_design')) {
            $filter_watch_face_design = explode(',', $request->input('filter_watch_face_design'));
            $query->whreHas('smartwatch', fn($q) => $q->whereIn('watch_face_design', $filter_watch_face_design));
        }
        // filter by wrist size range
        if ($request->filled('filter_wrist_size_range')) {
            $filter_wrist_size_range = explode(',', $request->input('filter_wrist_size_range'));
            $query->whereHas('smartwatch', fn($q) => $q->whereIn('wrist_size_range', $filter_wrist_size_range));
        }
        $products = $query->paginate(20)->appends($request->query());
        return $products;
    }
}
