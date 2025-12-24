<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'price',
        'quantity',
        'is_archived',
        'description'
    ];

    protected $casts = [
        'is_archived' => 'boolean',
        'price' => 'decimal:2'
    ];

    // Связь с устройствами
    
    public function devices()
    {
        return $this->belongsToMany(Device::class, 'device_product')
                    ->withPivot('product_id')
                    ->withTimestamps();
    }

    // Scope для архивных продуктов
    public function scopeArchived($query)
    {
        return $query->where('is_archived', true);
    }

}
