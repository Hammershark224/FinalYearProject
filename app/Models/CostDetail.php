<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'cost_ID';
    protected $fillable = [
        'cost_type',
        'value',
    ];
}
