<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'location',
        'type',
        'serial_number',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Связь с продуктами
    public function products()
    {
        return $this->belongsToMany(Product::class, 'device_product')
                    ->withPivot('quantity', 'position')
                    ->withTimestamps();
    }
}
