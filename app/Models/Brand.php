<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false;
    protected $fillable = ['brand_name', 'brand_status'];
    protected $primaryKey = 'brand_id';
    protected $table = 'tbl_phone_brands';
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_product_id', 'brand_id');
    }
}
