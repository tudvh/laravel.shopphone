<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    
    protected $table = 'account';

    protected $fillable = ['last_name', 'first_name', 'gender', 'phone_number', 'email', 'username', 'password', 'ward_id', 'address', 'role', 'status'];
}
