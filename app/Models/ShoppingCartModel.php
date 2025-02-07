<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCartModel extends Model
{
    public $timestamps = false;
    protected $fillable = ['id_user_cart', 'id_phone_cart',  'name_phone', 'quantity_add', 'price', '', 'total_price'];
    protected $primaryKey = 'id_cart';
    protected $table = 'tbl_shopping_cart';
}
