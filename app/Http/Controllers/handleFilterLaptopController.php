<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaptopDetailsModel;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;

class handleFilterLaptopController extends Controller
{
    //


    public function handleFilterLaptopGPU(Request $request)
    {
        $query = LaptopDetailsModel::query();
        if ($request->filled('brand')) {
            $brandName = $request->input('brand');
            $brandID = Brand::where('brand_name', $brandName)->value('brand_id');
            $query->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID));
        }

        if ($request->filled('filter_laptop_ram')) {
            $filterLaptopRam = explode(',', $request->input('filter_laptop_ram'));
            $query->whereIn('laptop_ram', $filterLaptopRam);
        }

        if ($request->filled('filter_laptop_storage')) {
            $filterLaptopStorage = explode(',', $request->input('filter_laptop_storage'));
            $query->whereIn('laptop_storage', $filterLaptopStorage);
        }

        if ($request->filled('filter_laptop_cpu')) {
            $filterLaptopCPU = explode(',', $request->input('filter_laptop_cpu'));
            $query->whereIn('laptop_cpu', $filterLaptopCPU);
        }


        if ($request->filled('filter_laptop_refresh_rates')) {
            $filterLaptopRefresh = explode(',', $request->input('filter_laptop_refresh_rates'));
            $query->whereIn('laptop_refresh_rate', $filterLaptopRefresh);
        }

        return $query->select('laptop_gpu', DB::raw('COUNT(*) as total_nfc'))
            ->groupBy('laptop_gpu')
            ->get();
    }

    public function handleFilterLaptopRam(Request $request)
    {

        $query = LaptopDetailsModel::query();
        if ($request->filled('brand')) {
            $brandName = $request->input('brand');
            $brandID = Brand::where('brand_name', $brandName)->value('brand_id');
            $query->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID));
        }

        if ($request->filled('filter_laptop_gpu')) {
            $filterLaptopGPU = explode(',', $request->input('filter_laptop_gpu'));
            $query->whereIn('laptop_gpu', $filterLaptopGPU);
        }
        if ($request->filled('filter_laptop_storage')) {
            $filterLaptopStorage = explode(',', $request->input('filter_laptop_storage'));
            $query->whereIn('laptop_storage', $filterLaptopStorage);
        }

        if ($request->filled('filter_laptop_cpu')) {
            $filterLaptopCPU = explode(',', $request->input('filter_laptop_cpu'));
            $query->whereIn('laptop_cpu', $filterLaptopCPU);
        }


        if ($request->filled('filter_laptop_refresh_rates')) {
            $filterLaptopRefresh = explode(',', $request->input('filter_laptop_refresh_rates'));
            $query->whereIn('laptop_refresh_rate', $filterLaptopRefresh);
        }

        return $query->select('laptop_ram', DB::raw('COUNT(*) as total_nfc'))
            ->groupBy('laptop_ram')
            ->get();
    }
    public function handleFilterLaptopCPU(Request $request)
    {
        $query = LaptopDetailsModel::query();
        if ($request->filled('brand')) {
            $brandName = $request->input('brand');
            $brandID = Brand::where('brand_name', $brandName)->value('brand_id');
            $query->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID));
        }


        if ($request->filled('filter_laptop_gpu')) {
            $filterLaptopGPU = explode(',', $request->input('filter_laptop_gpu'));
            $query->whereIn('laptop_gpu', $filterLaptopGPU);
        }
        if ($request->filled('filter_laptop_storage')) {
            $filterLaptopStorage = explode(',', $request->input('filter_laptop_storage'));
            $query->whereIn('laptop_storage', $filterLaptopStorage);
        }


        if ($request->filled('filter_laptop_ram')) {
            $filterLaptopRam = explode(',', $request->input('filter_laptop_ram'));
            $query->whereIn('laptop_ram', $filterLaptopRam);
        }


        if ($request->filled('filter_laptop_refresh_rates')) {
            $filterLaptopRefresh = explode(',', $request->input('filter_laptop_refresh_rates'));
            $query->whereIn('laptop_refresh_rate', $filterLaptopRefresh);
        }
        return $query->select('laptop_cpu', DB::raw('COUNT(*) as total_nfc'))
            ->groupBy('laptop_cpu')
            ->get();
    }

    public function handleFilterLaptopStorage(Request $request)
    {
        $query = LaptopDetailsModel::query();
        if ($request->filled('brand')) {
            $brandName = $request->input('brand');
            $brandID = Brand::where('brand_name', $brandName)->value('brand_id');
            $query->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID));
        }


        if ($request->filled('filter_laptop_gpu')) {
            $filterLaptopGPU = explode(',', $request->input('filter_laptop_gpu'));
            $query->whereIn('laptop_gpu', $filterLaptopGPU);
        }

        if ($request->filled('filter_laptop_cpu')) {
            $filterLaptopCPU = explode(',', $request->input('filter_laptop_cpu'));
            $query->whereIn('laptop_cpu', $filterLaptopCPU);
        }

        if ($request->filled('filter_laptop_ram')) {
            $filterLaptopRam = explode(',', $request->input('filter_laptop_ram'));
            $query->whereIn('laptop_ram', $filterLaptopRam);
        }


        if ($request->filled('filter_laptop_refresh_rates')) {
            $filterLaptopRefresh = explode(',', $request->input('filter_laptop_refresh_rates'));
            $query->whereIn('laptop_refresh_rate', $filterLaptopRefresh);
        }
        return $query->select('laptop_storage', DB::raw('COUNT(*) as total_nfc'))
            ->groupBy('laptop_storage')
            ->get();
    }

    public function handleFilterLaptopRefresh(Request $request)
    {
        $query = LaptopDetailsModel::query();
        if ($request->filled('brand')) {
            $brandName = $request->input('brand');
            $brandID = Brand::where('brand_name', $brandName)->value('brand_id');
            $query->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID));
        }

        if ($request->filled('filter_laptop_gpu')) {
            $filterLaptopGPU = explode(',', $request->input('filter_laptop_gpu'));
            $query->whereIn('laptop_gpu', $filterLaptopGPU);
        }

        if ($request->filled('filter_laptop_cpu')) {
            $filterLaptopCPU = explode(',', $request->input('filter_laptop_cpu'));
            $query->whereIn('laptop_cpu', $filterLaptopCPU);
        }

        if ($request->filled('filter_laptop_ram')) {
            $filterLaptopRam = explode(',', $request->input('filter_laptop_ram'));
            $query->whereIn('laptop_ram', $filterLaptopRam);
        }

        if ($request->filled('filter_laptop_storage')) {
            $filterLaptopStorage = explode(',', $request->input('filter_laptop_storage'));
            $query->whereIn('laptop_storage', $filterLaptopStorage);
        }

        return $query->select('laptop_refresh_rate', DB::raw('COUNT(*) as total_nfc'))
            ->groupBy('laptop_refresh_rate')
            ->get();
    }
}
