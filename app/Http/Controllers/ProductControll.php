<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PhoneDetailsModel;
use Illuminate\Http\Request;

use App\Models\Brand;

use App\Models\Product;
use App\Models\Gallery;
use App\Models\LaptopDetailsModel;
use App\Models\SmartwatchModel;
use App\Models\TabletModel;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;

session_start();

class ProductControll extends Controller
{

    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('admin.dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function add_product()
    {
        $this->AuthLogin();
        $cate_product = Category::get();
        $brand_product = Brand::get();

        return view('admin.product.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }
    public function list_product()
    {
        $this->AuthLogin();
        $list_product = Product::with(['category', 'brand'])->orderBy('product_id', 'ASC')
            ->paginate(20);
        return view('admin.product.list_product')->with('products', $list_product);
    }

    public function edit_product($product_id)
    {
        $this->AuthLogin();
        $cate_product = Category::all();
        $brand_product = Brand::all();


        $product = Product::where('product_id', $product_id)->first();

        if ($product->categories_product_id == 1) {
            $detail_product = PhoneDetailsModel::where('product_id', $product_id)->first();
        }
        if ($product->categories_product_id == 2) {
            $detail_product = LaptopDetailsModel::where('product_id', $product_id)->first();
        }
        if ($product->categories_product_id == 3) {
            $detail_product = SmartwatchModel::where('product_id', $product_id)->first();
        }
        if ($product->categories_product_id == 4) {
            $detail_product = TabletModel::where('product_id', $product_id)->first();
        }


        return view('admin.product.edit_product')->with('products', $product)->with('cate_products', $cate_product)
            ->with('brand_products', $brand_product)->with('details', $detail_product);
    }

    public function inactive_product($product_id)
    {
        $this->AuthLogin();

        $product = Product::find($product_id);
        $product->product_status = 1;
        $product->save();

        Session::put('message_success', 'Hiển thị thành công!');
        return Redirect::to('list-product');
    }
    public function active_product($product_id)
    {
        $this->AuthLogin();
        $product = Product::find($product_id);
        $product->product_status = 0;
        $product->save();
        Session::put('message_success', 'Ẩn thành công!');
        return Redirect::to('list-product');
    }

    public function save_product(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $product = new Product;
        $product->product_code = $data['product_code'];
        $product->product_name = $data['product_name'];
        $product->product_name_slug = $data['product_name_slug'];
        $product->model_product = $data['model_product'];
        $product->sale_price = $data['sale_price'];
        $product->purchase_price = $data['purchase_price'];
        $product->old_price = $data['old_price'];
        $product->product_quantity = $data['product_quantity'];
        $product->categories_product_id = $data['categories_product_id'];
        $product->brand_product_id = $data['brand_product'];
        $product->release_date = $data['release_date'];
        $product->warranty_period = $data['warranty_period'];
        $product->product_status = $data['product_status'];
        $product->varian_product = $data['varian_product'];


        $get_image = $request->file('product_image');

        // xữ lý phần up hình ảnh lên mysql
        if ($get_image) {
            $new_image = time() . '_' . $get_image->getClientOriginalName();
            $get_image->move('uploads/product', $new_image);
            $product->product_image = $new_image;
        } else {
            $product->product_image = '';
        }
        $product->save();
        // lấy id của sản phẩm
        $id_product = $product->product_id;

        if ($data['categories_product_id'] == 1) {
            // Mã xử lý khi điều kiện đúng
            $productDetail = new PhoneDetailsModel();
            $productDetail->product_id = $id_product; // liên kết bằng khóa ngoại
            $productDetail->operating_system =  $data['operating_system'];
            $productDetail->screen_type = $data['screen_type'];
            $productDetail->screen_size = $data['screen_size'];
            $productDetail->resolution = $data['resolution'];
            $productDetail->refresh_rate = $data['refresh_rate'];
            $productDetail->ram = $data['ram'];
            $productDetail->storage = $data['storage'];
            $productDetail->expandable_storage = $data['expandable_storage'];
            $productDetail->battery_capacity = $data['battery_capacity'];
            $productDetail->fast_charging = $data['fast_charging'];
            $productDetail->wireless_charging = $data['wireless_charging'];
            $productDetail->camera_main = $data['camera_main'];
            $productDetail->camera_main_features = $data['camera_main_features'];
            $productDetail->camera_front = $data['camera_front'];
            $productDetail->camera_front_features = $data['camera_front_features'];
            $productDetail->NFC = $data['connect_nfc'];
            $productDetail->cpu = $data['cpu'];
            $productDetail->gpu = $data['gpu'];
            $productDetail->water_resistance = $data['water_resistance'];
            $productDetail->weight = $data['weight'];
            $productDetail->dimensions = $data['dimensions'];
            $productDetail->sim_type = $data['sim_type'];
            $productDetail->connectivity = $data['connectivity'];
            $productDetail->biometrics = $data['biometrics'];
            $productDetail->color = $data['color'];
            $productDetail->charging_port = $data['charging_port'];
            $productDetail->other_connections = $data['other_connections'];
            $productDetail->wifi_technology = $data['wifi_technology'];
            $productDetail->save();
        }
        if ($data['categories_product_id'] == 2) {
            $productDetail = new LaptopDetailsModel();
            $productDetail->product_id = $id_product; // liên kết bằng khóa ngoại
            $productDetail->laptop_operating_system = $data['laptop_operating_system'];
            $productDetail->laptop_screen_size = $data['laptop_screen_size'];
            $productDetail->laptop_screen_type = $data['laptop_screen_type'];
            $productDetail->laptop_resolution = $data['laptop_resolution'];
            $productDetail->laptop_refresh_rate = $data['laptop_refresh_rate'];
            $productDetail->laptop_cpu = $data['laptop_cpu'];
            $productDetail->laptop_ram = $data['laptop_ram'];
            $productDetail->laptop_storage = $data['laptop_storage'];
            $productDetail->laptop_storage_type = $data['laptop_storage_type'];
            $productDetail->laptop_expandable_storage = $data['laptop_expandable_storage'];
            $productDetail->laptop_gpu = $data['laptop_gpu'];
            $productDetail->laptop_battery_capacity = $data['laptop_battery_capacity'];
            $productDetail->laptop_weight = $data['laptop_weight'];
            $productDetail->laptop_connectivity = $data['laptop_connectivity'];
            $productDetail->laptop_port_type = $data['laptop_port_type'];
            $productDetail->laptop_biometrics = $data['laptop_biometrics'];

            $productDetail->save();
        }
        if ($data['categories_product_id'] == 3) {
            $productDetail = new SmartwatchModel();
            $productDetail->product_id = $id_product; // liên kết bằng khóa ngoại
            $productDetail->watch_operating_system = $data['watch_operating_system'];
            $productDetail->watch_screen_size = $data['watch_screen_size'];
            $productDetail->watch_screen_type = $data['watch_screen_type'];
            $productDetail->watch_resolution = $data['watch_resolution'];
            $productDetail->watch_battery_life = $data['watch_battery_life'];
            $productDetail->watch_charging_time = $data['watch_charging_time'];
            $productDetail->watch_health_sensors = $data['watch_health_sensors'];
            $productDetail->watch_gps = $data['watch_gps'];
            $productDetail->watch_waterproof_rating = $data['watch_waterproof_rating'];
            $productDetail->watch_connectivity = $data['watch_connectivity'];
            $productDetail->watch_compatibility = $data['watch_compatibility'];
            $productDetail->watch_weight = $data['watch_weight'];
            $productDetail->watch_strap_material = $data['watch_strap_material'];
            $productDetail->watch_biometric_unlock = $data['watch_biometric_unlock'];
            $productDetail->save();
        }
        if ($data['categories_product_id'] == 4) {
            // Mã xử lý khi điều kiện đúng
            $productDetail = new TabletModel();
            $productDetail->product_id = $id_product; // liên kết bằng khóa ngoại
            $productDetail->tablet_operating_system = $data['tablet_operating_system'];
            $productDetail->tablet_screen_size = $data['tablet_screen_size'];
            $productDetail->tablet_screen_type = $data['tablet_screen_type'];
            $productDetail->tablet_resolution = $data['tablet_resolution'];
            $productDetail->tablet_refresh_rate = $data['tablet_refresh_rate'];
            $productDetail->tablet_cpu = $data['tablet_cpu'];
            $productDetail->tablet_ram = $data['tablet_ram'];
            $productDetail->tablet_storage = $data['tablet_storage'];
            $productDetail->tablet_expandable_storage = $data['tablet_expandable_storage'];
            $productDetail->tablet_battery_capacity = $data['tablet_battery_capacity'];
            $productDetail->tablet_fast_charging = $data['tablet_fast_charging'];
            $productDetail->tablet_camera_rear = $data['tablet_camera_rear'];
            $productDetail->tablet_camera_front = $data['tablet_camera_front'];
            $productDetail->tablet_speakers = $data['tablet_speakers'];
            $productDetail->tablet_charging_port = $data['tablet_charging_port'];
            $productDetail->tablet_connectivity = $data['tablet_connectivity'];
            $productDetail->tablet_dimensions = $data['tablet_dimensions'];
            $productDetail->tablet_weight = $data['tablet_weight'];
            $productDetail->tablet_water_resistance = $data['tablet_water_resistance'];
            $productDetail->tablet_stylus_support = $data['tablet_stylus_support'];
            $productDetail->tablet_accessories = $data['tablet_accessories'];
            $productDetail->save();
        }


        Session::put('message_success', 'Thêm thành công!');
        return Redirect::to('list-product');
    }


    public function update_product(Request $request, $product_id)
    {
        $this->AuthLogin();

        $data = $request->all();
        $product = Product::find($product_id);

        $product->product_code = $data['product_code'];
        $product->product_name = $data['product_name'];
        $product->product_name_slug = $data['product_name_slug'];
        $product->model_product = $data['model_product'];
        $product->sale_price = $data['sale_price'];
        $product->purchase_price = $data['purchase_price'];
        $product->old_price = $data['old_price'];
        $product->product_quantity = $data['product_quantity'];
        $product->categories_product_id = $data['categories_product_id'];
        $product->brand_product_id = $data['brand_product'];
        $product->release_date = $data['release_date'];
        $product->warranty_period = $data['warranty_period'];
        $product->varian_product = $data['varian_product'];


        $get_image = $request->file('product_image');

        // xữ lý phần up hình ảnh lên mysql
        if ($get_image) {
            $new_image = time() . '_' . $get_image->getClientOriginalName();
            $get_image->move('uploads/product', $new_image);
            $product->product_image = $new_image;
        } else {
            $product->product_image = '';
        }
        $product->save();
        // lấy id của sản phẩm
        $id_product = $product->product_id;

        if ($data['categories_product_id'] == 1) {
            // Mã xử lý khi điều kiện đúng
            $productDetail = new PhoneDetailsModel();
            $productDetail->product_id = $id_product; // liên kết bằng khóa ngoại
            $productDetail->operating_system =  $data['operating_system'];
            $productDetail->screen_type = $data['screen_type'];
            $productDetail->screen_size = $data['screen_size'];
            $productDetail->resolution = $data['resolution'];
            $productDetail->refresh_rate = $data['refresh_rate'];
            $productDetail->ram = $data['ram'];
            $productDetail->storage = $data['storage'];
            $productDetail->NFC = $data['connect_nfc'];
            $productDetail->expandable_storage = $data['expandable_storage'];
            $productDetail->battery_capacity = $data['battery_capacity'];
            $productDetail->fast_charging = $data['fast_charging'];
            $productDetail->wireless_charging = $data['wireless_charging'];
            $productDetail->camera_main = $data['camera_main'];
            $productDetail->camera_main_features = $data['camera_main_features'];
            $productDetail->camera_front = $data['camera_front'];
            $productDetail->camera_front_features = $data['camera_front_features'];
            $productDetail->cpu = $data['cpu'];
            $productDetail->gpu = $data['gpu'];
            $productDetail->water_resistance = $data['water_resistance'];
            $productDetail->weight = $data['weight'];
            $productDetail->dimensions = $data['dimensions'];
            $productDetail->sim_type = $data['sim_type'];
            $productDetail->connectivity = $data['connectivity'];
            $productDetail->biometrics = $data['biometrics'];
            $productDetail->color = $data['color'];
            $productDetail->charging_port = $data['charging_port'];
            $productDetail->other_connections = $data['other_connections'];
            $productDetail->wifi_technology = $data['wifi_technology'];
            $productDetail->save();
        }
        if ($data['categories_product_id'] == 2) {
            $productDetail = new LaptopDetailsModel();
            $productDetail->product_id = $id_product; // liên kết bằng khóa ngoại
            $productDetail->laptop_operating_system = $data['laptop_operating_system'];
            $productDetail->laptop_screen_size = $data['laptop_screen_size'];
            $productDetail->laptop_screen_type = $data['laptop_screen_type'];
            $productDetail->laptop_resolution = $data['laptop_resolution'];
            $productDetail->laptop_refresh_rate = $data['laptop_refresh_rate'];
            $productDetail->laptop_cpu = $data['laptop_cpu'];
            $productDetail->laptop_ram = $data['laptop_ram'];
            $productDetail->laptop_storage = $data['laptop_storage'];
            $productDetail->laptop_storage_type = $data['laptop_storage_type'];
            $productDetail->laptop_expandable_storage = $data['laptop_expandable_storage'];
            $productDetail->laptop_gpu = $data['laptop_gpu'];
            $productDetail->laptop_battery_capacity = $data['laptop_battery_capacity'];
            $productDetail->laptop_weight = $data['laptop_weight'];
            $productDetail->laptop_connectivity = $data['laptop_connectivity'];
            $productDetail->laptop_port_type = $data['laptop_port_type'];
            $productDetail->laptop_biometrics = $data['laptop_biometrics'];

            $productDetail->save();
        }
        if ($data['categories_product_id'] == 3) {
            $productDetail = new SmartwatchModel();
            $productDetail->product_id = $id_product; // liên kết bằng khóa ngoại
            $productDetail->watch_operating_system = $data['watch_operating_system'];
            $productDetail->watch_screen_size = $data['watch_screen_size'];
            $productDetail->watch_screen_type = $data['watch_screen_type'];
            $productDetail->watch_resolution = $data['watch_resolution'];
            $productDetail->watch_battery_life = $data['watch_battery_life'];
            $productDetail->watch_charging_time = $data['watch_charging_time'];
            $productDetail->watch_health_sensors = $data['watch_health_sensors'];
            $productDetail->watch_gps = $data['watch_gps'];
            $productDetail->watch_waterproof_rating = $data['watch_waterproof_rating'];
            $productDetail->watch_connectivity = $data['watch_connectivity'];
            $productDetail->watch_compatibility = $data['watch_compatibility'];
            $productDetail->watch_weight = $data['watch_weight'];
            $productDetail->watch_strap_material = $data['watch_strap_material'];
            $productDetail->watch_biometric_unlock = $data['watch_biometric_unlock'];
            $productDetail->save();
        }
        if ($data['categories_product_id'] == 4) {
            // Mã xử lý khi điều kiện đúng
            $productDetail = new TabletModel();
            $productDetail->product_id = $id_product; // liên kết bằng khóa ngoại
            $productDetail->tablet_operating_system = $data['tablet_operating_system'];
            $productDetail->tablet_screen_size = $data['tablet_screen_size'];
            $productDetail->tablet_screen_type = $data['tablet_screen_type'];
            $productDetail->tablet_resolution = $data['tablet_resolution'];
            $productDetail->tablet_refresh_rate = $data['tablet_refresh_rate'];
            $productDetail->tablet_cpu = $data['tablet_cpu'];
            $productDetail->tablet_ram = $data['tablet_ram'];
            $productDetail->tablet_storage = $data['tablet_storage'];
            $productDetail->tablet_expandable_storage = $data['tablet_expandable_storage'];
            $productDetail->tablet_battery_capacity = $data['tablet_battery_capacity'];
            $productDetail->tablet_fast_charging = $data['tablet_fast_charging'];
            $productDetail->tablet_camera_rear = $data['tablet_camera_rear'];
            $productDetail->tablet_camera_front = $data['tablet_camera_front'];
            $productDetail->tablet_speakers = $data['tablet_speakers'];
            $productDetail->tablet_charging_port = $data['tablet_charging_port'];
            $productDetail->tablet_connectivity = $data['tablet_connectivity'];
            $productDetail->tablet_dimensions = $data['tablet_dimensions'];
            $productDetail->tablet_weight = $data['tablet_weight'];
            $productDetail->tablet_water_resistance = $data['tablet_water_resistance'];
            $productDetail->tablet_stylus_support = $data['tablet_stylus_support'];
            $productDetail->tablet_accessories = $data['tablet_accessories'];
            $productDetail->save();
        }

        Session::put('message_success', 'Cập nhật thành công!');
        return Redirect::to('list-product');
    }

    public function delete_product($product_id)
    {
        $this->AuthLogin();
        $product = Product::find($product_id);


        if ($product) {
            $old_image = $product->product_image;
            // Đường dẫn tới tập tin ảnh
            if (!empty($old_image)) {
                $product_image_path = 'uploads/product/' . $old_image;
                // Kiểm tra xem tập tin ảnh có tồn tại không và xóa nó
                if (file_exists($product_image_path)) {
                    unlink($product_image_path);
                }
            }

            // Xóa dữ liệu sản phẩm từ cơ sở dữ liệu
            Product::where('product_id', $product_id)->delete();
            Session::put('message_success', 'Xóa thành công!');
        }

        return Redirect::to('list-product');
    }



    // USER FAVORITE

}
