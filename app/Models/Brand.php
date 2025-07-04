<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Brand extends Model
{
    public $timestamps = false;
    protected $fillable = ['brand_name', 'brand_slug',  'category_pro_id ', 'brand_status'];
    protected $primaryKey = 'brand_id';
    protected $table = 'tbl_brands';

    public function relationbrand()
    {
        return $this->hasMany(RelationModel::class, 'id_brand', 'brand_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_product_id', 'brand_id');
    }
    public function cate()
    {
        return $this->belongsTo(Category::class, 'category_pro_id ', 'category_id');
    }
}
