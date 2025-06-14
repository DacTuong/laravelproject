<?php

namespace App\Http\Controllers;

use App\Models\SmartwatchModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;

class handleFilterWatchController extends Controller
{
    // 

    public function handleFilterWatchScreenType(Request $request)
    {
        $query = SmartwatchModel::query();
        if ($request->filled('brand')) {
            $brandName = $request->input('brand');
            $brandID = Brand::where('brand_name', $brandName)->value('brand_id');
            $query->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID));
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
        // filter by wrist size range
        if ($request->filled('filter_wrist_size_range')) {
            $filter_wrist_size_range = explode(',', $request->input('filter_wrist_size_range'));
            $query->whereIn('wrist_size_range', $filter_wrist_size_range);
        }

        return $query->select('watch_screen_type', DB::raw('COUNT(*) as total_nfc'))
            ->groupBy('watch_screen_type')
            ->get();
    }


    public function handleFilterWatchFaceDesign(Request $request)
    {
        $query = SmartwatchModel::query();
        if ($request->filled('brand')) {
            $brandName = $request->input('brand');
            $brandID = Brand::where('brand_name', $brandName)->value('brand_id');
            $query->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID));
        }

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
            ->groupBy('watch_face_design')
            ->get();
    }

    public function handleFilterWristSize(Request $request)
    {
        $query = SmartwatchModel::query();
        if ($request->filled('brand')) {
            $brandName = $request->input('brand');
            $brandID = Brand::where('brand_name', $brandName)->value('brand_id');
            $query->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID));
        }


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
            ->groupBy('wrist_size_range')
            ->get();
    }

    public function handleFilterStrapMaterial(Request $request)
    {

        $query = SmartwatchModel::query();
        if ($request->filled('brand')) {
            $brandName = $request->input('brand');
            $brandID = Brand::where('brand_name', $brandName)->value('brand_id');
            $query->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID));
        }

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
            ->groupBy('watch_strap_material')
            ->get();
    }


    public function filterWatchByRequest(Request $request, $query)
    {
        //  Filter Watch by brand request 
        if ($request->filled('brand')) {
            $brandNameFilter = $request->input('brand');
            $getIDBrand = Brand::where('brand_name', $brandNameFilter)->value('brand_id');
            $query->where('brand_product_id', $getIDBrand);
        }


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
        return $query;
    }
}