<?php

namespace App\Imports;

use App\Models\IngredientDetail;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class IngredientsImport implements ToModel
{
    public function model(array $row)
    {
        return new IngredientDetail([
            'ingredient_name' => $row[0],
            'ingredient_weight' => $row[1],
            'ingredient_price' => ($row[2]),
        ]);
    }
}
