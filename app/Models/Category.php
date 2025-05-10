<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = ['category_name', 'cate_Slug', 'category_status'];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_categories';

    public function products()
    {
        return $this->belongsTo(Product::class, 'categories_product', 'category_id');
    }

    public function relationcate()
    {
        return $this->hasMany(RelationModel::class, 'id_cate', 'category_id');
    }

    public function cate()
    {
        return $this->hasMany(Brand::class, 'category_pro_id ', 'category_id');
    }
}
