<?php

namespace App\Livewire;

use App\Models\IngredientDetail;
use Livewire\Component;

class SearchIngredients extends Component
{
    public $query = '';
    public $ingredients = [];

    public function mount()
    {
        $this->ingredients = IngredientDetail::all();
    }

    public function updatedQuery()
    {
        $this->ingredients = IngredientDetail::where('ingredient_name', 'like', '%' . $this->query . '%')->get();
    }

    public function render()
    {
        return view('livewire.search-ingredients', [
            'ingredients' => $this->ingredients,
        ]);
    }
}
