<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\BannerModel;
use App\Models\ReviewModel;


use Illuminate\Support\Facades\Session;

use App\Models\Brand;
use App\Models\CateActicleModel;
use App\Models\Category;
use App\Models\FavoriteModel;
use App\Models\OrderProduct;
use App\Models\PhoneDetailsModel;
use App\Models\User;
use App\Models\Product;
use App\Models\RelationModel;


class handleFilterPhoneController extends Controller
{
    public function applyRefreshRateFilter($query, $filterRefresh)
    {
        if ($filterRefresh === '<1') {
            $query->whereHas('detail_phone', fn($q) => $q->where('refresh_rate', $filterRefresh));
        } else {
            $values = array_map('intval', explode(',', $filterRefresh));
            $query->whereHas('detail_phone', fn($q) => $q->whereIn('refresh_rate', $values));
        }

        return $query;
    }
    // Get nfc List 
    public function getNFCList(Request $request)
    {
        $query = PhoneDetailsModel::query();

        if ($request->filled('brand')) {
            $brandName = $request->input('brand');
            $brandID = Brand::where('brand_name', $brandName)->value('brand_id');
            $query->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID));
        }
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
            ->groupBy('NFC')
            ->get();
    }

    public function getStorage(Request $request)
    {
        $query = PhoneDetailsModel::query();
        if ($request->filled('brand')) {
            $brandName = $request->input('brand');
            $brandID = Brand::where('brand_name', $brandName)->value('brand_id');
            $query->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID));
        }

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
            ->orderByRaw('CAST(storage AS UNSIGNED) ASC')
            ->get();
    }

    public function getRefresh_rates(Request $request)
    {
        $query = PhoneDetailsModel::query();
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
            ->orderByRaw('CAST(storage AS UNSIGNED) ASC')
            ->get();
    }


    public function getRam(Request $request)
    {
        $query = PhoneDetailsModel::query();
        if ($request->filled('brand')) {
            $brandName = $request->input('brand');
            $brandID = Brand::where('brand_name', $brandName)->value('brand_id');

            $query->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID));
        }

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
            ->orderByRaw('CAST(storage AS UNSIGNED) ASC')
            ->get();
    }
}
