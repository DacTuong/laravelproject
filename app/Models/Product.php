<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'brand', // Thương hiệu sản phẩm
        'product_code', // Mã sản phẩm
        'product_name', // Tên sản phẩm
        'product_image', // Hình ảnh sản phẩm
        'model_product',
        'purchase_price', // Giá nhập hàng
        'old_price', // Giá bán củ
        'sale_price', // Giá bán
        'product_quantity', // Số lượng sản phẩm trong kho
        'categories_product_id', // ID của danh mục sản phẩm
        'brand_product_id', // ID của thương hiệu sản phẩm
        'release_date', // Ngày ra mắt sản phẩm
        'operating_system', // Hệ điều hành của sản phẩm
        'screen_type', // Loại màn hình
        'screen_size', // Kích thước màn hình
        'resolution', // Độ phân giải
        'refresh_rate', // Tần số quét màn hình
        'ram', // Dung lượng RAM
        'storage', // Dung lượng lưu trữ
        'expandable_storage', // Hỗ trợ bộ nhớ ngoài (true/false)
        'battery_capacity', // Dung lượng pin
        'fast_charging', // Hỗ trợ sạc nhanh (true/false)
        'wireless_charging', // Hỗ trợ sạc không dây (true/false)
        'camera_main', // Camera chính
        'camera_main_features', // Các tính năng của camera chính
        'camera_front', // Camera trước
        'camera_front_features', // Các tính năng của camera trước
        'cpu', // CPU (chip xử lý)
        'gpu', // GPU (chip đồ họa)
        'water_resistance', // Khả năng chống nước
        'weight', // Trọng lượng
        'dimensions', // Kích thước sản phẩm
        'sim_type', // Loại SIM hỗ trợ
        'connectivity', // Các kết nối khác (Wi-Fi, Bluetooth, etc.)
        'biometrics', // Tính năng sinh trắc học (vân tay, nhận diện khuôn mặt)
        'color', // Màu sắc sản phẩm
        'charging_port', // Cổng sạc
        'other_connections', // Các kết nối khác (nếu có)
        'wifi_technology', // Công nghệ Wi-Fi
        'warranty_period', // Thời gian bảo hành
        'sold',
        'product_status', // Trạng thái sản phẩm (Còn hàng/hết hàng)
        'varian_product',
    ];

    protected $primaryKey = 'product_id';
    protected $table = 'tbl_phones';

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_product_id', 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_product_id', 'brand_id');
    }
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'id_sanpham_gallery', 'product_id');
    }

    public function product_favorite()
    {
        return $this->belongsTo(FavoriteModel::class, 'favorite_phone_id', 'product_id');
    }

    public function product_banner()
    {
        return $this->hasMany(BannerModel::class, 'id_phones_banner', 'product_id');
    }

    public function phone()
    {
        return $this->hasMany(OrderDetail::class, 'order_phone_id', 'product_id');
    }
}
