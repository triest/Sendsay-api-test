<?php

namespace App\Models\Pet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    public static ?string $confirmation_token;

    public static ?string $email;

    public static ?string $name;

    public static ?string $pet_name;


    protected $fillable = ['name', 'email'];

    public function petCategory()
    {
        return $this->belongsTo(PetCategory::class);
    }
}
