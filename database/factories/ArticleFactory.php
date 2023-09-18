<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\DocBlock\TagFactory;

class ArticleFactory extends Factory


{

    protected $model = Article::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;

        return [
            'category_id' => Category::factory(),
            'tag_id' => Tag::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'image' => '',
            'description' => $this->faker->paragraphs(5, true),
        ];
    }
}