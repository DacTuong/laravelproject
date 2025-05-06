<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmartwatchModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_smartwatch_detail';

    protected $primaryKey = 'id_smartwatch_detail ';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'operating_system',
        'screen_size',
        'screen_type',
        'resolution',
        'battery_life',
        'charging_time',
        'health_sensors',
        'gps',
        'waterproof_rating',
        'connectivity',
        'compatibility',
        'weight',
        'connectivity',
        'strap_material',
        'biometric_unlock',
    ];

    /**
     * Mối quan hệ với bảng sản phẩm
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
