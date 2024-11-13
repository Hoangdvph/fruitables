<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'price',
        'price_sale',
        'weight',
        'origin',
        'quality',
        'image',
        'description',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    
}
