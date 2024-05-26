<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'overhead_cost',
        'labor_cost',
        'margin_cost',
    ];
}
