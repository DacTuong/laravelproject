<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    public $timestamps = false;
    protected $fillable = ['name_coupon', 'coupon_code', 'coupon_qty', 'coupon_type', 'discount_amount', 'customer_id', 'start_date', 'end_date', 'coupon_status'];
    protected $primaryKey = 'id_coupon';
    protected $table = 'tbl_coupons';
}
