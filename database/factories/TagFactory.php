<?php

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tag; 
use Illuminate\Support\Str;

class TagFactory extends Factory
{
    
    protected $model = Tag::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->word;
        return [
            'name' => $name, 
            'slug' => Str::slug($name),
            'description' => $this->faker->text(),
        ];
    }
}
