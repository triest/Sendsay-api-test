<?php

namespace App\Services\Pet;

use App\Http\Requests\StorePetRequest;
use App\Models\Pet\Pet;
use App\Models\Pet\PetCategory;
use Nette\Schema\ValidationException;

class PetService
{
    public function store(StorePetRequest $inputDate){

        $inputDate = $inputDate->validated();

        $petCategory = PetCategory::query()->where('id',$inputDate['pat_category_id'])->first();

        if(!$petCategory){
            throw \Exception('pet category not found');
        }

        $pet = new Pet();

        $pet->name = $inputDate['name'];
        $pet->pet_name = $inputDate['pet_name'];

        $pet->petCategory()->associate($petCategory);

        $pet->email = $inputDate['email'];

        $pet->save();


    }
}
