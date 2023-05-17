<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $table = 'order';

    protected $fillable = ['user_id', 'name', 'phone_number', 'ward_id', 'address', 'pay_method', 'note', 'status'];
}
