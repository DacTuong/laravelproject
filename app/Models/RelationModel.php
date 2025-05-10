<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationModel extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id_brand', 'id_cate'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_brand_category';

    public function cate()
    {
        return $this->belongsTo(Category::class, 'id_cate', 'category_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_brand', 'brand_id');
    }
}
