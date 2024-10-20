<?php

namespace App\Services\Pet;

use App\DTO\PetDto;
use App\Jobs\ConfirmationSubscribeJob;
use App\Jobs\SendDataToSandSayJob;
use App\Models\Pet\Pet;
use App\Models\Pet\PetCategory;
use App\Services\SandayService\SendsayService;
use Illuminate\Support\Str;


class PetService
{
    /**
     * @throws \Exception
     */
    public function store(PetDto $inputDate, string $ip = null): Pet
    {
        $petCategory = PetCategory::query()->where('id', $inputDate->pat_category_id)->first();

        if (!$petCategory) {
            throw new \Exception('pet category not found');
        };

        $pet = new Pet();

        $pet->name = $inputDate->name;
        $pet->pet_name = $inputDate->pet_name;

        $pet->petCategory()->associate($petCategory);

        $pet->email = $inputDate->email;

        $pet->save();

        SendDataToSandSayJob::dispatch($pet->email, id: $pet->id, ip: $ip)->delay(1);

        $this->sendConfirmationEmail($pet);

        return $pet;
    }

    public function sendConfirmationEmail(Pet $pet): void
    {
        $pet->confirmation_token = Str::random(40) . '_' . $pet->id;

        $pet->save();

        ConfirmationSubscribeJob::dispatch($pet->email, $pet->confirmation_token)->delay(1);
    }

    public function confirmation(string $token): bool
    {
        $pet = Pet::query()->where('confirmation_token', $token)->first();

        if (!$pet) {
            return false;
        }

        $pet->confirm = true;

        $pet->confirmation_token = null;

        $pet->save();

        return true;
    }
}
