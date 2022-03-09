<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\company;
use Illuminate\Support\Str;
use App\Models\User as user;
use Database\Factories\UserFactory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\company>
 */
class companyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = company::class;
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail(),
            'tel' => $this->faker->numerify('0##-###-####'),
        ];
    }
    public function addUsers(){
       $companies = company::factory()->has(User::factory()->Admin())->has(User::factory()->User()->count(3))->make();
        // return $this->state(function (array $attributes) {
        //     return ['company_id' => companyFactory::new(),];
        // });

    }
}
