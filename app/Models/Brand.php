<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    // Name of table and what fields we want to work with
    protected $table = "brands";
    protected $fillable = ['name'];

    // Connects a one-to-many relationship to products table
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
