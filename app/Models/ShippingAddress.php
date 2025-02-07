<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    public $timestamps = false;
    protected $fillable = ['fullname', 'order_phone', 'matp', 'maqh', 'xaid'];
    protected $primaryKey = 'id_shipping';
    protected $table = 'tbl_shipping_address';

    public function orders()
    {
        return $this->hasMany(OrderProduct::class, 'shipping_id', 'id_shipping');
    }
    public function province()
    {
        return $this->belongsTo(Province::class, 'matp', 'matp');
    }

    public function districts()
    {
        return $this->belongsTo(District::class, 'maqh', 'maqh');
    }

    public function wards()
    {
        return $this->belongsTo(Ward::class, 'xaid', 'xaid');
    }
}