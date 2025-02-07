<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CateActicleModel extends Model
{
    public $timestamps = false;
    protected $fillable = ['tenloaibaiviet', 'status_cate_post'];
    protected $primaryKey = 'id_loaibaiviet';
    protected $table = 'tbl_loaibaiviet';
}