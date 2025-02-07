<?php

namespace App\Http\Controllers;

use App\Models\ActicleModel;
use App\Models\CateActicleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Models\Brand;

use App\Models\Category;

session_start();
class ActicleControll extends Controller
{

    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            Redirect::to('admin.dashboard');
        } else {
            return Redirect::to('admincp')->send();
        }
    }


    public function add_post()
    {
        return view('admin.post.add_post');
    }

    public function save_post(Request $request)
    {
        $new_post = new ActicleModel();
        // $data = $request->all();
        $new_post->name_article = $request->post_name;
        $new_post->content_article = $request->content_post;
        $new_post->status_article = 1;

        $get_image = $request->file('post_image');

        // xữ lý phần up hình ảnh lên mysql
        if ($get_image) {
            $new_image = time() . '_' . $get_image->getClientOriginalName();
            $get_image->move('uploads/post', $new_image);
            $new_post->image_article = $new_image;
        } else {
            $new_post->image_article = '';
        }
        // echo $new_image;
        $new_post->save();
        return Redirect::to('all-post');
    }


    public function inactive_post($id_post)
    {


        $post = ActicleModel::find($id_post);
        $post->status_article = 1;
        $post->save();

        return Redirect::to('all-post');
    }
    public function active_post($id_post)
    {

        $post = ActicleModel::find($id_post);
        $post->status_article = 2;
        $post->save();

        return Redirect::to('all-post');
    }



    public function all_post()
    {
        $posts = ActicleModel::all();
        return view('admin.post.all_post')->with('all_post', $posts);
    }


    // USER

    public function list_post()
    {
        $brand = Brand::get();
        $category = Category::get();

        $posts = ActicleModel::where('status_article', 1)->get();
        return view('user.view_post.view_list_post')
            ->with('brands', $brand)
            ->with('categorys', $category)
            ->with('posts', $posts)
        ;
    }
}
