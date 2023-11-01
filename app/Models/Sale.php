<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sale';

    protected $fillable = ['name', 'discount', 'discount_unit', 'status'];

    public function products()
    {
        return $this->hasMany(Product::class, 'sale_id', 'id');
    }
}
