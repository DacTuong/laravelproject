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
        'watch_operating_system',
        'watch_screen_size',
        'watch_screen_type',
        'watch_resolution',
        'watch_face_design',
        'wrist_size_range',
        'watch_battery_life',
        'watch_charging_time',
        'watch_health_sensors',
        'watch_gps',
        'watch_waterproof_rating',
        'watch_connectivity',
        'watch_compatibility',
        'watch_weight',
        'watch_connectivity',
        'watch_strap_material',
        'watch_biometric_unlock',
    ];

    /**
     * Mối quan hệ với bảng sản phẩm
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
