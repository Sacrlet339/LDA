<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\company as com;
use App\Models\User as user;
use Database\Factories\companyFactory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'firstname' => $this->faker->firstName($gender = 'male'|'female'),
            'lastname' => $this->faker->lastName(),
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->companyEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            // 'type' =>  'User',
            'company_id' => $this->faker->numerify('0###'),
        ];

    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }


    public function Admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'Admin',
            ];
        });
    }
    public function User()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'User',
            ];
        });
    }
    public function compnay()
    {
        return $this->state(function (array $attributes) {
            return [
                'email' => $this->faker->unique()->companyEmail(),
                'company_id' => companyFactory::new(),
            ];
        });
    }


}


