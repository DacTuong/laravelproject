<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SantisticalModel extends Model
{
    public $timestamps = false;
    protected $fillable = ['order_date', 'total_price_orders', 'profit', 'quantity_sale_products', 'total_orders'];
    protected $primaryKey = 'id_santistical';
    protected $table = 'tbl_santisticals';
}
