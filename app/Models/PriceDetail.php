<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceDetail extends Model
{
    use HasFactory;
    protected $primaryKey = "price_ID";
    protected $fillable = [
        'dish_ID',
        'price_type',
        'value',
    ];

    public function dish() {
        return $this->belongsTo(DishDetail::class, 'dish_ID');
    }
}
