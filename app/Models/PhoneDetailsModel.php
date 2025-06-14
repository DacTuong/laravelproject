<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneDetailsModel extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'product_id',
        'operating_system',
        'screen_type',
        'screen_size',
        'resolution',
        'refresh_rate',
        'ram',
        'storage',
        'NFC',
        'expandable_storage',
        'battery_capacity',
        'fast_charging',
        'wireless_charging',
        'camera_main',
        'camera_main_features',
        'camera_front',
        'camera_front_features',
        'cpu',
        'gpu',
        'water_resistance',
        'weight',
        'dimensions',
        'sim_type',
        'connectivity',
        'biometrics',
        'color',
        'charging_port',
        'other_connections',
        'wifi_technology',
    ];

    protected $primaryKey = 'id_phone_detail';
    protected $table = 'tbl_phone_detail';
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
