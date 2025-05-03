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
        'operating_system',
        'screen_size',
        'screen_type',
        'resolution',
        'refresh_rate',
        'laptop_cpu',
        'laptop_ram',
        'laptop_storage',
        'storage_type',
        'expandable_storage',
        'laptop_gpu',
        'battery_capacity',
        'weight',
        'connectivity',
        'port_type',
        'warranty_period',
        'color',
        'biometrics',
    ];

    /**
     * Mối quan hệ với bảng sản phẩm
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}