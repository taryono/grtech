<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => Str::random(10).'@grtechc.com.my',
            'logo' => null,
            'website' => 'grtech.com.my',
            'deleted_at'=> null
        ];
    } 
}
