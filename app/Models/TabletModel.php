<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabletModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_tablets';

    protected $primaryKey = 'tablet_id';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'tablet_operating_system',
        'tablet_screen_size',
        'tablet_screen_type',
        'tablet_resolution',
        'tablet_refresh_rate',
        'tablet_cpu',
        'tablet_ram',
        'tablet_storage',
        'tablet_expandable_storage',
        'tablet_battery_capacity',
        'tablet_fast_charging',
        'tablet_camera_rear',
        'tablet_camera_rear_recording',
        'tablet_camera_rear_feature',
        'tablet_camera_front',
        'tablet_camera_front_feature',
        'tablet_charging_port',
        'tablet_connectivity',
        'tablet_dimensions',
        'tablet_weight',
        'tablet_water_resistance',
        'tablet_color'
    ];

    /**
     * Mối quan hệ với bảng sản phẩm
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}