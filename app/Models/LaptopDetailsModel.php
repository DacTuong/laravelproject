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
        'laptop_screen_size',
        'laptop_screen_type',
        'laptop_resolution',
        'laptop_refresh_rate',
        'laptop_cpu',
        'laptop_ram',
        'laptop_storage',
        'laptop_storage_type',
        'laptop_expandable_storage',
        'laptop_gpu',
        'laptop_battery_capacity',
        'laptop_weight',
        'laptop_connectivity',
        'laptop_port_type',
        'laptop_biometrics',
    ];

    /**
     * Mối quan hệ với bảng sản phẩm
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
