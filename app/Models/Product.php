<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Релация към Manufacturer
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    // Релация към ProductAttribute
    public function attributes()
    {
        return $this->hasOne(ProductAttribute::class);
    }

    // Релация към Price
    public function prices()
    {
        return $this->hasOne(Price::class);
    }

    // Релация към Categories (many-to-many)
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
