<?php

namespace App\Http\Controllers;

use App\Models\TabletModel;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class handleFilterTabletController extends Controller
{

    public function handleFilterTabletByRequest(Request $request, $query)
    {
        //  Filter tablet by brand request 
        if ($request->filled('brand')) {
            $brandNameFilter = $request->input('brand');
            $getIDBrand = Brand::where('brand_name', $brandNameFilter)->value('brand_id');
            $query->where('brand_product_id', $getIDBrand);
        }


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

        return $query;
    }
    public function filterStorageTablet(Request $request)
    {
        $query = TabletModel::query();
        if ($request->filled('brand')) {
            $brandName = $request->input('brand');
            $brandID = Brand::where('brand_name', $brandName)->value('brand_id');
            $query->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID));
        }

        if ($request->filled('filter_tablet_refresh_rates')) {
            $filter_tablet_refresh_rates = explode(',', $request->input('filter_tablet_refresh_rates'));
            $query->whereIn('tablet_refresh_rate', $filter_tablet_refresh_rates);
        }

        if ($request->filled('filter_tablet_screen_size')) {
            $filter_tablet_screen_size = explode(',', $request->input('filter_tablet_screen_size'));
            $query->whereIn('tablet_screen_size', $filter_tablet_screen_size);
        }


        return $query->select('tablet_storage', DB::raw('COUNT(*) as total_nfc'))
            ->groupBy('tablet_storage')
            ->get();
    }
    public function filterScreenSizeTablet(Request $request)
    {
        $query = TabletModel::query();
        if ($request->filled('brand')) {
            $brandName = $request->input('brand');
            $brandID = Brand::where('brand_name', $brandName)->value('brand_id');
            $query->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID));
        }

        if ($request->filled('filter_tablet_refresh_rates')) {
            $filter_tablet_refresh_rates = explode(',', $request->input('filter_tablet_refresh_rates'));
            $query->whereIn('tablet_refresh_rate', $filter_tablet_refresh_rates);
        }

        if ($request->filled('filter_tablet_storage')) {
            $filter_tablet_storage = explode(',', $request->input('filter_tablet_storage'));
            $query->whereIn('tablet_storage', $filter_tablet_storage);
        }
        return $query->select('tablet_screen_size', DB::raw('COUNT(*) as total_nfc'))
            ->groupBy('tablet_screen_size')
            ->get();
    }


    public function filterRefreshRateTablet(Request $request)
    {
        $query = TabletModel::query();
        if ($request->filled('brand')) {
            $brandName = $request->input('brand');
            $brandID = Brand::where('brand_name', $brandName)->value('brand_id');
            $query->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID));
        }


        if ($request->filled('filter_tablet_screen_size')) {
            $filter_tablet_screen_size = explode(',', $request->input('filter_tablet_screen_size'));
            $query->whereIn('tablet_screen_size', $filter_tablet_screen_size);
        }

        if ($request->filled('filter_tablet_storage')) {
            $filter_tablet_storage = explode(',', $request->input('filter_tablet_storage'));
            $query->whereIn('tablet_storage', $filter_tablet_storage);
        }
        return $query->select('tablet_refresh_rate', DB::raw('COUNT(*) as total_nfc'))
            ->groupBy('tablet_refresh_rate')
            ->get();
    }
}
