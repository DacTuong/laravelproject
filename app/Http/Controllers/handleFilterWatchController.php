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

        // if ($request->filled('filter_laptop_ram')) {
        //     $filterLaptopRam = explode(',', $request->input('filter_laptop_ram'));
        //     $query->whereIn('laptop_ram', $filterLaptopRam);
        // }

        // if ($request->filled('filter_laptop_storage')) {
        //     $filterLaptopStorage = explode(',', $request->input('filter_laptop_storage'));
        //     $query->whereIn('laptop_storage', $filterLaptopStorage);
        // }

        // if ($request->filled('filter_laptop_cpu')) {
        //     $filterLaptopCPU = explode(',', $request->input('filter_laptop_cpu'));
        //     $query->whereIn('laptop_cpu', $filterLaptopCPU);
        // }


        // if ($request->filled('filter_laptop_refresh_rates')) {
        //     $filterLaptopRefresh = explode(',', $request->input('filter_laptop_refresh_rates'));
        //     $query->whereIn('laptop_refresh_rate', $filterLaptopRefresh);
        // }

        return $query->select('watch_screen_type', DB::raw('COUNT(*) as total_nfc'))
            ->groupBy('watch_screen_type')
            ->get();
    }
}
