<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function manufacturer()
    {
        return $this->hasOne(Manufacturer::class);
    }

}
