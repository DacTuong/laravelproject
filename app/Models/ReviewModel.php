<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewModel extends Model
{
    // use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id_phone_review ', 'id_user_review ',  'review_text', 'rating', 'created_at', 'updated_at'];
    protected $primaryKey = 'id_review ';
    protected $table = 'tbl_reviews';

    public function name_customer()
    {
        return $this->belongsTo(User::class, 'id_user_review', 'id_user');
    }
    public function phone_review()
    {
        return $this->belongsTo(User::class, 'id_phone_review', 'product_id');
    }
}
