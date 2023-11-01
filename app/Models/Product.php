<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = ['brand_id', 'category_id', 'name', 'price', 'quantity', 'specs', 'description', 'image', 'sale_id', 'status'];

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function sale()
    {
        return $this->hasOne(Sale::class, 'id', 'sale_id');
    }
}
