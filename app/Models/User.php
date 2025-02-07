<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    protected $fillable = ['name_user', 'email_user', 'password_user', 'status_user', 'phone_user'];
    protected $primaryKey = 'id_user';
    protected $table = 'tbl_user';

    public function reviews_name()
    {
        return $this->hasMany(ReviewModel::class, 'id_user_review', 'id_user');
    }
    public function user_favorite()
    {
        return $this->hasMany(User::class, 'favorite_user_id', 'id_user');
    }

    public function cmt_name()
    {
        return $this->hasMany(CommentModel::class, 'id_user_comment', 'id_user');
    }
}