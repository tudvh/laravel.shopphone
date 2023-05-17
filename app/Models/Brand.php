<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Brand extends Model
{
    use HasFactory;
    
    protected $table = 'brand';

    protected $fillable = ['name', 'image', 'status'];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_id', 'id');
    }
}
