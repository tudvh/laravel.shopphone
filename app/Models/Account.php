<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use HasFactory;

    protected $table = 'account';

    protected $fillable = ['last_name', 'first_name', 'gender', 'phone_number', 'email', 'username', 'password', 'ward_id', 'address', 'role', 'status'];

    protected $hidden = ['remember_token', 'password'];

    public function ward()
    {
        return $this->hasOne(Ward::class, 'id', 'ward_id');
    }
}
