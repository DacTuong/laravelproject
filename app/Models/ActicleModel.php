<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActicleModel extends Model
{
    public $timestamps = false;
    protected $fillable = ['image_article', 'name_article', 'image_acticle', 'content_article', 'status_article', 'views'];
    protected $primaryKey = 'id_article';
    protected $table = 'tbl_articles';
}
