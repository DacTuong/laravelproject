<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaptopDetailsModel extends Model
{
    use HasFactory;


    protected $table = 'tbl_laptop_detail';

    protected $primaryKey = 'id_laptop_detail';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'laptop_operating_system',
        'laptop_display_size',
        'laptop_display_quantity',
        'laptop_display_panel_type',
        'laptop_display_touch_support', // Lưu ý có thể sai chính tả, nên sửa lại là laptop_display_touch_support
        'laptop_display_type',
        'laptop_display_resolution',
        'laptop_display_refresh_rate',
        'laptop_display_technology',
        'laptop_cpu',
        'laptop_cpu_model',
        'laptop_cpu_core',
        'laptop_cpu_threads',
        'laptop_cpu_base_clock',
        'laptop_cpu_max_clock',
        'laptop_cpu_cache',
        'laptop_ram',
        'laptop_ram_type',
        'laptop_ram_speed',
        'laptop_ram_upgrade_slots',
        'laptop_storage',
        'laptop_storage_type',
        'laptop_expandable_storage',
        'laptop_gpu_integrated',
        'laptop_gpu_dedicated',
        'laptop_audio_technology',
        'laptop_battery_capacity',
        'laptop_dimensions',
        'laptop_weight',
        'laptop_connectivity',
        'laptop_port_type',
        'laptop_keyboard_type',
        'laptop_keyboard_backlight',
        'laptop_touchpad_type',
        'laptop_color',
    ];

    /**
     * Mối quan hệ với bảng sản phẩm
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
