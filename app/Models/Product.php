<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'product_code',
        'product_name',
        'product_name_slug',
        'product_image',
        'model_product',
        'purchase_price',
        'old_price',
        'sale_price',
        'product_quantity',
        'categories_product_id',
        'brand_product_id',
        'release_date',
        'warranty_period',
        'sold',
        'product_status',
        'varian_product',
    ];

    protected $primaryKey = 'product_id';
    protected $table = 'tbl_products';

    public function detail_phone()
    {
        return $this->hasOne(PhoneDetailsModel::class, 'product_id', 'product_id');
    }

    public function detail_laptop()
    {
        return $this->hasOne(LaptopDetailsModel::class, 'product_id', 'product_id');
    }
    public function tablet()
    {
        return $this->hasOne(TabletModel::class, 'product_id', 'product_id');
    }
    public function smartwatch()
    {
        return $this->hasOne(SmartwatchModel::class, 'product_id', 'product_id');
    }
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
