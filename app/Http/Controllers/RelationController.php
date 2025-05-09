<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    //
    public function list_relation()
    {
        return view('admin.relation.relation_cate_brand.list_relation');
    }

    public function add_relation()
    {
        $categories = Category::all();
        return view(
            'admin.relation.relation_cate_brand.add_relation_cate_brand',
            compact('categories')
        );
    }
}
