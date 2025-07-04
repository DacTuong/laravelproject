<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryBrandController extends Controller
{
    public function showCategoryBrandPhone(Request $request, $brand)
    {
        return view('category_brand.phone_brand');
    }
}
