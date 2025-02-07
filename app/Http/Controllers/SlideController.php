<?php

namespace App\Http\Controllers;

use App\Models\BannerModel;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SlideController extends Controller
{
    public function new_slide()
    {
        $get_product = Product::all();
        return view('admin.slide.new_slider')->with('products', $get_product);
    }
    public function save_slide(Request $request)
    {
        $data = $request->all();
        $save_slide = new BannerModel();
        $save_slide->id_phones_banner = $data['product_id'];
        $save_slide->name_banner = $data['banner_name'];
        $save_slide->status_banner = 1;

        $get_image = $request->file('banner_image');

        // xữ lý phần up hình ảnh lên mysql
        if ($get_image) {
            $new_image = time() . '_' . $get_image->getClientOriginalName();
            $get_image->move('uploads/slide', $new_image);
            $save_slide->banner_image = $new_image;
        } else {
            $save_slide->banner_image = '';
        }

        $save_slide->save();
        return Redirect::to('list-banner');
    }

    public function list_banner()
    {
        $banners = BannerModel::all();
        return view('admin.slide.list_banner')->with('banners', $banners);
    }

    public function inactive_banner($id_banner)
    {
        $banner = BannerModel::find($id_banner);
        $banner->status_banner = 1;
        $banner->save();

        return Redirect::to('list-banner');
    }
    public function active_banner($id_banner)
    {

        $banner = BannerModel::find($id_banner);
        $banner->status_banner = 2;
        $banner->save();

        return Redirect::to('list-banner');
    }

    // usser


}
