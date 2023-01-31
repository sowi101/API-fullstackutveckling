<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // Name of table and what fields we want to work with
    protected $table = "products";
    protected $fillable = ['article', 'name', 'description', 'price', 'amount', 'category_id', 'brand_id'];

    // Connects a many-to-one relationship to categories table
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Connects a many-to-one relationship to brands table
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
