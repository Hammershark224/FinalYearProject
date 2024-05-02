<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuDetail extends Model
{
    use HasFactory;
    protected $primaryKey = "menu_ID";
    protected $fillable = ['dish_ID','menu_price'];

    public function dish()
    {
        return $this->belongsTo(DishDetail::class, 'dish_ID');
    }
}
