<?php

namespace Database\Seeders;

use App\Models\Pet\PetCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayNames = ['кот','собака','грызун','рыбки','другое'];

        foreach ($arrayNames as $name){
            $petCategory = new PetCategory();
            $petCategory->name = $name;
            $petCategory->save();
        }
    }
}
