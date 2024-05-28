<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'dish_ID',
        'overhead_price',
        'labor_price',
        'margin_price',
    ];

    public function dish() {
        return $this->hasOne(DishDetail::class, 'dish_ID');
    }
}
