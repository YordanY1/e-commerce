<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function attributes()
    {
        return $this->hasOne(ProductAttribute::class);
    }

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

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->average('rating');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}
