<?php

namespace Database\Factories;

use App\Models\PhoneBrand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Phone>
 */
class PhoneFactory extends Factory
{
    public function definition(): array
    {
        return [
            'number' => $this->faker->phoneNumber(),
            'phone_brand_id' => PhoneBrand::query()->get()->random()->id,
        ];
    }
}