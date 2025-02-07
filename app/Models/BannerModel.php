<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerModel extends Model
{
    // use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id_phones_banner', 'name_banner', 'banner_image', 'status_banner'];
    protected $primaryKey = 'id_banner';
    protected $table = 'tbl_banner';

    public function product_banner()
    {
        return $this->belongsTo(Product::class, 'id_phones_banner', 'product_id');
    }
}
