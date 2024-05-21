<!-- resources/views/livewire/search-ingredients.blade.php -->
<div>
    <input type="text" wire:model="query" placeholder="Search ingredients..." class="form-control mb-3">
    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ingredient Name</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ingredient Weight</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ingredients as $ingredient)
                <tr>
                    <td>
                        <div class="align-middle text-center text-sm">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $ingredient->ingredient_name }}</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="align-middle text-center text-sm">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $ingredient->ingredient_weight }}</h6>
                            </div>
                        </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <a href="{{ route('ingredient.delete', $ingredient->ingredient_ID) }}" class="btn btn-danger" onclick="return confirm('Confirm to delete?')">DELETE</a>
                    </td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
</div>
