<?php

namespace LucaLongo\LaravelContacts\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use LucaLongo\LaravelContacts\Models\Contact;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'label' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'mobile' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'website' => $this->faker->url(),
            'facebook' => 'https://facebook.com/'.$this->faker->userName(),
            'x' => 'https://x.com/@'.$this->faker->userName(),
            'linkedin' => 'https://linkedin.com/'.$this->faker->userName(),
            'push_token' => $this->faker->uuid(),
        ];
    }

    public function contactable(Model $model): Factory
    {
        return $this->state(function (array $attributes) use ($model) {
            return [
                'contactable_type' => $model::class,
                'contactable_id' => $model->getKey(),
            ];
        });
    }

    public function meta(array $meta): Factory
    {
        return $this->state(function (array $attributes) use ($meta) {
            return ['meta' => $meta];
        });
    }
}
