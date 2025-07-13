<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteModel extends Model
{
    public $timestamps = true;
    protected $fillable = ['favorite_product_id', 'favorite_user_id'];
    protected $primaryKey = 'id_favorite';
    protected $table = 'tbl_favorite';
    // Quan hệ với model User
    public function user_favorite()
    {
        return $this->belongsTo(User::class, 'favorite_user_id', 'id_user');
    }
    public function product_favorite()
    {
        return $this->belongsTo(Product::class, 'favorite_product_id', 'product_id');
    }
}
