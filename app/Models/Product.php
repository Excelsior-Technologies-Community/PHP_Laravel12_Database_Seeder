<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'price',
        'stock',
        'featured',
        'status',
        'image',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
