<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment';

    protected $fillable = ['user_id', 'product_id', 'content', 'reply_id'];

    public function account()
    {
        return $this->hasOne(Account::class, 'id', 'user_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function commentParent()
    {
        return $this->hasOne(Product::class, 'id', 'reply_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'reply_id', 'id')->orderBy('created_at', 'desc');
    }
}
