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
    public function price()
    {
        return $this->hasOne(Price::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }


}
