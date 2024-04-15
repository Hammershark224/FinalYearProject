<?php

namespace App\Imports;

use App\Models\IngredientDetail;
use App\Models\SupplierDetail;
use Maatwebsite\Excel\Concerns\ToModel;

class IngredientsImport implements ToModel
{
    private $companyId;

    public function __construct($companyId)
    {
        $this->companyId = $companyId;
    }

    public function model(array $row)
    {
        // Find the corresponding IngredientDetail
        $ingredientDetail = IngredientDetail::where('ingredient_name', $row[0])
                                             ->where('ingredient_weight', $row[1])
                                             ->first();
        
        // Check if the IngredientDetail exists
        if ($ingredientDetail) {
            // Create a new SupplierDetail with the foreign keys of the found IngredientDetail
            return new SupplierDetail([
                'company_ID' => $this->companyId,
                'ingredient_ID' => $ingredientDetail->ingredient_ID,
                'ingredient_price' => $row[2],
            ]);
        } else {
            // Handle the case where the IngredientDetail doesn't exist
            // You may throw an exception, log an error, or handle it based on your requirement
            // For now, I'll return null to skip this row
            return null;
        }
    }
}

