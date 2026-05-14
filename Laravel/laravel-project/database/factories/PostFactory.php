<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Post::class;

    public function definition(): array
    {
        $t=fake()->sentence(); //storing this into a variable t so that we don't have to write it again and again
        return [
            'image'=>fake()->imageUrl(),
            'title'=>$t,
            'slug'=>\Illuminate\Support\Str::slug($t),
            'content'=>fake()->paragraph(5),
            'category_id'=> Category::inRandomOrder()->first()?->id, // fake()->numberBetween(1,10) :-u can use this too but id till 10 might not exist 
            'user_id'=> 1,
            'published_at'=>fake()->optional()->dateTime(),


        ];
    }
}
