<?php

namespace App\DTO;

class PetDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $pet_name,
        public int $pat_category_id
    ) {
    }
}
