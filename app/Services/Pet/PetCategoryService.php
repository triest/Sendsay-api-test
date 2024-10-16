<?php

namespace App\Services\Pet;

use App\Models\Pet\PetCategory;

class PetCategoryService
{
    public function index()
    {
        $petCategory = PetCategory::query()->orderBy('name')->get();
        return $petCategory;
    }
}
