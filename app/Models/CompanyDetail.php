<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'company_ID';
    protected $fillable = [
        'company_name',
        'company_address'
    ];

    public function suppliers()
    {
        return $this->hasMany(SupplierDetail::class, 'company_ID', 'company_ID');
    }
}
