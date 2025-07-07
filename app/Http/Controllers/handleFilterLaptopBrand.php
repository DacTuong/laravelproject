<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaptopDetailsModel;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;

class handleFilterLaptopBrand extends Controller
{
    public function handleFilterLaptopGPUBrand(Request $request, $slug)
    {
        $query = LaptopDetailsModel::query();

        $brandID = Brand::where('brand_slug', $slug)->value('brand_id');


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
            $query->whereIn('laptop_display_refresh_rate', $filterLaptopRefresh);
        }

        return $query
            ->select('laptop_gpu_integrated', DB::raw('COUNT(*) as total_nfc'))
            ->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID))
            ->groupBy('laptop_gpu_integrated')
            ->get();
    }

    public function handleFilterLaptopRamBrand(Request $request, $slug)
    {

        $query = LaptopDetailsModel::query();
        $brandID = Brand::where('brand_slug', $slug)->value('brand_id');

        if ($request->filled('filter_laptop_gpu')) {
            $filterLaptopGPU = explode(',', $request->input('filter_laptop_gpu'));
            $query->whereIn('laptop_gpu_integrated', $filterLaptopGPU);
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
            $query->whereIn('laptop_display_refresh_rate', $filterLaptopRefresh);
        }

        return $query->select('laptop_ram', DB::raw('COUNT(*) as total_nfc'))
            ->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID))
            ->groupBy('laptop_ram')
            ->get();
    }
    public function handleFilterLaptopCPUBrand(Request $request, $slug)
    {
        $query = LaptopDetailsModel::query();
        $brandID = Brand::where('brand_slug', $slug)->value('brand_id');



        if ($request->filled('filter_laptop_gpu')) {
            $filterLaptopGPU = explode(',', $request->input('filter_laptop_gpu'));
            $query->whereIn('laptop_gpu_integrated', $filterLaptopGPU);
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
            $query->whereIn('laptop_display_refresh_rate', $filterLaptopRefresh);
        }
        return $query->select('laptop_cpu', DB::raw('COUNT(*) as total_nfc'))
            ->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID))
            ->groupBy('laptop_cpu')
            ->get();
    }

    public function handleFilterLaptopStorageBrand(Request $request, $slug)
    {
        $brandID = Brand::where('brand_slug', $slug)->value('brand_id');
        $query = LaptopDetailsModel::query();



        if ($request->filled('filter_laptop_gpu')) {
            $filterLaptopGPU = explode(',', $request->input('filter_laptop_gpu'));
            $query->whereIn('laptop_gpu_integrated', $filterLaptopGPU);
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
            $query->whereIn('laptop_display_refresh_rate', $filterLaptopRefresh);
        }
        return $query->select('laptop_storage', DB::raw('COUNT(*) as total_nfc'))
            ->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID))
            ->groupBy('laptop_storage')
            ->get();
    }

    public function handleFilterLaptopRefreshBrand(Request $request, $slug)
    {
        $brandID = Brand::where('brand_slug', $slug)->value('brand_id');
        $query = LaptopDetailsModel::query();


        if ($request->filled('filter_laptop_gpu')) {
            $filterLaptopGPU = explode(',', $request->input('filter_laptop_gpu'));
            $query->whereIn('laptop_gpu_integrated', $filterLaptopGPU);
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

        return $query->select('laptop_display_refresh_rate', DB::raw('COUNT(*) as total_nfc'))
            ->whereHas('product', fn($q) => $q->where('brand_product_id', $brandID))
            ->groupBy('laptop_display_refresh_rate')
            ->get();
    }
}
