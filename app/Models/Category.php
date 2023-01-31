<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;
    // Name of table and what fields we want to work with
    protected $table = "categories";
    protected $fillable = ['name'];

    // Connects a one-to-many relationship to product table
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
