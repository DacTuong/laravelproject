<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Brand;
use App\Models\PhoneDetailsModel;
use App\Models\Product;
use App\Models\Category;

class handleFilterPhoneBrand extends Controller
{
    public function filterProductByBrand(Request $request, $cate_slug,  $slug)
    {
        $brandID = Brand::where('brand_slug', $slug)->value('brand_id');
        $cate_id = Category::where('cate_Slug', $cate_slug)->value('category_id');


        $list_phone =  Product::with(['category', 'brand', 'detail_phone'])
            ->where('categories_product_id', $cate_id)
            ->where('brand_product_id', $brandID)
            ->where('product_status', 1);


        //  Filter Phone by brand request 
        if ($request->filled('brand')) {
            $brandNameFilter = $request->input('brand');
            $getIDBrand = Brand::where('brand_name', $brandNameFilter)->value('brand_id');
            $list_phone->where('brand_product_id', $getIDBrand);
        }

        //  Filter Phone by storage request 
        if ($request->filled('filter_mobile_storage')) {
            $storageFilters = explode(',', $request->input('filter_mobile_storage'));
            $list_phone->whereHas('detail_phone', fn($q) => $q->whereIn('storage', $storageFilters));
        }
        //  Filter Phone by refresh rates request 
        if ($request->filled('filter_refresh_rates')) {
            $filterRefresh = $request->input('filter_refresh_rates');
            $list_phone->whereHas('refresh_rate', $filterRefresh);
        }

        //  Filter Phone by ram request 
        if ($request->filled('filter_ram')) {
            $filterByRam = explode(',', $request->input('filter_ram'));
            $list_phone->whereHas('detail_phone', fn($q) => $q->whereIn('ram', $filterByRam));
        }

        //  Filter Phone by storage request 
        if ($request->filled('ket-noi-nfc')) {
            $filterByNFC = explode(',', $request->input('ket-noi-nfc'));
            $list_phone->whereHas('detail_phone', fn($q) => $q->whereIn('NFC', $filterByNFC));
        }
        $products = $list_phone->paginate(20)->appends($request->query());
        return $products;
    }
    // Get nfc List 
    public function getNFCListBrand(Request $request, $slug)
    {
        $query = PhoneDetailsModel::query();
        $brandID = Brand::where('brand_name', $slug)->value('brand_id');

        //  Filter NFC by storage request 
        if ($request->filled('filter_mobile_storage')) {
            $filterStorages = explode(',', $request->input('filter_mobile_storage'));
            $query->whereIn('storage', $filterStorages);
        }

        //  Filter NFC by refresh rates request 
        if ($request->filled('filter_refresh_rates')) {
            $filterRefreshRates =  explode(',', $request->input('filter_refresh_rates'));
            $query->whereIn('refresh_rate', $filterRefreshRates);
        }

        //  Filter NFC by ram request 
        if ($request->filled('filter_ram')) {
            $filterRams = explode(',', $request->input('filter_ram'));
            $query->whereIn('ram', $filterRams);
        }
        return $query->select('NFC', DB::raw('COUNT(*) as total_nfc'))
            ->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID))
            ->groupBy('NFC')
            ->get();
    }

    public function getStorageBrand(Request $request, $slug)
    {
        $query = PhoneDetailsModel::query();
        $brandID = Brand::where('brand_name', $slug)->value('brand_id');

        //  Filter Storage by NFC request 
        if ($request->filled('ket-noi-nfc')) {
            $filterNFCs = explode(',', $request->input('ket-noi-nfc'));
            $query->whereIn('NFC', $filterNFCs);
        }

        //  Filter Storage by Ram request 
        if ($request->filled('filter_ram')) {
            $filterRams = explode(',', $request->input('filter_ram'));
            $query->whereIn('ram', $filterRams);
        }

        //  Filter Storage by refresh rate request 
        if ($request->filled('filter_refresh_rates')) {
            $filterRefreshRates = explode(',', $request->input('filter_refresh_rates'));
            $query->whereIn('refresh_rate', $filterRefreshRates);
        }

        return $query->select('storage', DB::raw('COUNT(*) as total'))
            ->groupBy('storage')
            ->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID))
            ->orderByRaw('CAST(storage AS UNSIGNED) ASC')
            ->get();
    }

    public function getRefreshratesBrand(Request $request, $slug)
    {
        $query = PhoneDetailsModel::query();
        $brandID = Brand::where('brand_name', $slug)->value('brand_id');
        if ($request->filled('brand')) {
            $brandName = $request->input('brand');
            $brandID = Brand::where('brand_name', $brandName)->value('brand_id');
            $query->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID));
        }
        // filter NFC get List Refresh rate
        if ($request->filled('ket-noi-nfc')) {
            $filterNFCs = explode(',', $request->input('ket-noi-nfc'));
            $query->whereIn('NFC', $filterNFCs);
        }
        // filter ram get List Refresh rate
        if ($request->filled('filter_ram')) {
            $filterRams = explode(',', $request->input('filter_ram'));
            $query->whereIn('ram', $filterRams);
        }

        // filter storage get List Refresh rate
        if ($request->filled('filter_mobile_storage')) {
            $filterStorages = explode(',', $request->input('filter_mobile_storage'));
            $query->whereIn('storage', $filterStorages);
        }

        return $query->select('refresh_rate', DB::raw('COUNT(*) as total_refresh_rate'))
            ->groupBy('refresh_rate')
            ->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID))
            ->orderByRaw('CAST(storage AS UNSIGNED) ASC')
            ->get();
    }


    public function getRamBrand(Request $request, $slug)
    {
        $query = PhoneDetailsModel::query();
        $brandID = Brand::where('brand_name', $slug)->value('brand_id');


        //  Filter Ram by refresh NFC request 
        if ($request->filled('ket-noi-nfc')) {
            $filterNFCs = explode(',', $request->input('ket-noi-nfc'));
            $query->whereIn('NFC', $filterNFCs);
        }

        //  Filter Ram by refresh rate request 
        if ($request->filled('filter_mobile_storage')) {
            $filterStorages = explode(',', $request->input('filter_mobile_storage'));
            $query->whereIn('storage', $filterStorages);
        }
        //  Filter Ram by storage request 
        if ($request->filled('filter_refresh_rates')) {
            $filterRefreshRates = explode(',', $request->input('filter_refresh_rates'));
            $query->whereIn('refresh_rate', $filterRefreshRates);
        }

        return $query->select('ram', DB::raw('COUNT(*) as total_ram'))
            ->groupBy('ram')
            ->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID))
            ->orderByRaw('CAST(storage AS UNSIGNED) ASC')
            ->get();
    }
}
