<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TabletModel;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class handleFilterTabletBrand extends Controller
{

    public function handleTabletByBrand(Request $request, $cate_slug,  $slug)
    {
        $brandID = Brand::where('brand_slug', $slug)->value('brand_id');
        $cate_id = Category::where('cate_Slug', $cate_slug)->value('category_id');


        $query =  Product::with(['category', 'brand', 'detail_phone'])
            ->where('categories_product_id', $cate_id)
            ->where('brand_product_id', $brandID)
            ->where('product_status', 1);
        // filter tablet by filter_tablet_storage
        if ($request->filled('filter_tablet_storage')) {
            $filter_tablet_storage = explode(',', $request->input('filter_tablet_storage'));
            $query->whereHas('tablet', fn($q) => $q->whereIN('tablet_storage', $filter_tablet_storage));
        }
        // filter tablet by filter_tablet_screen_size
        if ($request->filled('filter_tablet_screen_size')) {
            $filter_tablet_screen_size = explode(',', $request->input('filter_tablet_screen_size'));
            $query->whereHas('tablet', fn($q) => $q->whereIn('tablet_screen_size', $filter_tablet_screen_size));
        }
        // filter tablet by filter_tablet_refresh_rates
        if ($request->filled('filter_tablet_refresh_rates')) {
            $filter_tablet_refresh_rates = explode(',', $request->input('filter_tablet_refresh_rates'));
            $query->whreHas('tablet', fn($q) => $q->whereIn('tablet_refresh_rates', $filter_tablet_refresh_rates));
        }
        $products = $query->paginate(20)->appends($request->query());
        return $products;
    }

    public function filterStorageTabletBrand(Request $request, $slug)
    {
        $query = TabletModel::query();
        $brandID = Brand::where('brand_slug', $slug)->value('brand_id');


        if ($request->filled('filter_tablet_refresh_rates')) {
            $filter_tablet_refresh_rates = explode(',', $request->input('filter_tablet_refresh_rates'));
            $query->whereIn('tablet_refresh_rate', $filter_tablet_refresh_rates);
        }

        if ($request->filled('filter_tablet_screen_size')) {
            $filter_tablet_screen_size = explode(',', $request->input('filter_tablet_screen_size'));
            $query->whereIn('tablet_screen_size', $filter_tablet_screen_size);
        }


        return $query->select('tablet_storage', DB::raw('COUNT(*) as total_nfc'))
            ->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID))
            ->groupBy('tablet_storage')
            ->get();
    }
    public function filterScreenSizeTabletBrand(Request $request, $slug)
    {
        $query = TabletModel::query();
        $brandID = Brand::where('brand_slug', $slug)->value('brand_id');

        if ($request->filled('filter_tablet_refresh_rates')) {
            $filter_tablet_refresh_rates = explode(',', $request->input('filter_tablet_refresh_rates'));
            $query->whereIn('tablet_refresh_rate', $filter_tablet_refresh_rates);
        }

        if ($request->filled('filter_tablet_storage')) {
            $filter_tablet_storage = explode(',', $request->input('filter_tablet_storage'));
            $query->whereIn('tablet_storage', $filter_tablet_storage);
        }
        return $query->select('tablet_screen_size', DB::raw('COUNT(*) as total_nfc'))
            ->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID))
            ->groupBy('tablet_screen_size')
            ->get();
    }


    public function filterRefreshRateTabletBrand(Request $request, $slug)
    {
        $query = TabletModel::query();
        $brandID = Brand::where('brand_slug', $slug)->value('brand_id');
        // if ($request->filled('brand')) {
        //     $brandName = $request->input('brand');
        //     $brandID = Brand::where('brand_name', $brandName)->value('brand_id');
        //     $query->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID));
        // }


        if ($request->filled('filter_tablet_screen_size')) {
            $filter_tablet_screen_size = explode(',', $request->input('filter_tablet_screen_size'));
            $query->whereIn('tablet_screen_size', $filter_tablet_screen_size);
        }

        if ($request->filled('filter_tablet_storage')) {
            $filter_tablet_storage = explode(',', $request->input('filter_tablet_storage'));
            $query->whereIn('tablet_storage', $filter_tablet_storage);
        }
        return $query->select('tablet_refresh_rate', DB::raw('COUNT(*) as total_nfc'))
            ->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID))
            ->groupBy('tablet_refresh_rate')
            ->get();
    }
}
