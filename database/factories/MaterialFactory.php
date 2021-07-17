<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Material;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Material::class;

    /**
     * Define the model's default state.
     *
     * @param $factory
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>rand(1,count(User::all())),
            'name'=>$this->faker->name,
            'description'=>$this->faker->text,
            'serial'=>$this->faker->ean8(),
            'cost_price'=>rand(50,100),
            'selling_price'=>rand(100,150),
            'group_id'=>rand(1,count(Group::all())),
            'is_visible'=>$this->faker->boolean,
            'is_available'=>$this->faker->boolean,
            'not'=>$this->faker->text,
        ];
    }
}
