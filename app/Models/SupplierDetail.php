<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierDetail extends Model
{
    use HasFactory;
    protected $primaryKey = ['company_ID', 'ingredient_ID'];
    protected $fillable = ['ingredient_ID', 'company_ID', 'ingredient_price'];
    public $incrementing = false;

    public function ingredient()
    {
        return $this->belongsTo(IngredientDetail::class,'ingredient_ID', 'ingredient_ID');
    }

    public function company()
    {
        return $this->belongsTo(CompanyDetail::class,'company_ID', 'company_ID');
    }
}
